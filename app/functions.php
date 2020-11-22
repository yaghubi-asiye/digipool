<?php namespace App;

use Auth;
use SoapClient;
use DB;

class functions
{

	public function send_sms($mobile , $token , $template ) {

	 	$url='https://api.kavenegar.com/v1/'.env('KavehnegarKey').'/verify/lookup.json?receptor='.$mobile.'&token='.$token.'&template='.$template;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		//curl_setopt($ch,CURLOPT_POSTFIELDS);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$res = curl_exec($ch);
		$res = json_decode($res);
		$res = $res->return;
		return $res;
	}

	public function ta_latin_num($string) {
	  //arrays of persian and latin numbers
	  $persian_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
	  $latin_num = range(0, 9);

	  $string = str_replace($persian_num, $latin_num, $string);

	  return $string;
	}



    public function payment_order($id_order) {
        $payment_gateway = \App\Settings::where('name','payment_gateway')->first()->value;
        $order = Orders::where('id',$id_order)->where('id_user',Auth::user()->id)->whereNull('payment')->first();
        $CallbackURL = asset('')."$order->orders_model/$order->type/$order->id/callback"; //Required

        if($payment_gateway=='zibal'){
            $parameters = array(
                "merchant"=> env('ZibalToken'),//required
                "callbackUrl"=> $CallbackURL,//required
                "amount"=> $order->amount*10 ,//required
                "orderId"=> $order->id,//optional
                "mobile"=> Auth::user()->mobile,//optional for mpg
                "description"=> 'خرید '.$order->orders_model,//optional
            );

            $response = $this->postToZibal('request/lazy', $parameters);
            if ($response->result == 100)
            {
                Header('Location: https://gateway.zibal.ir/start/'.$response->trackId.'/direct');
                exit();
            }
            else{
                echo "errorCode: ".$response->result."<br>";
                echo "message: ".$response->message;
            }
        }
        else if($payment_gateway=='idpay'){
            $params = array(
                'order_id' => time(),
                'amount' => $order->amount*10,
                'name' => Auth::user()->name .' '. Auth::user()->family,
                'phone' => Auth::user()->mobile,
                'mail' => Auth::user()->email,
                'desc' => 'خرید '.$order->orders_model,
                'callback' => $CallbackURL,
            );
            $authorization = 'X-API-KEY: '.env('IdpayToken');
            $result = $this->Curl('https://api.idpay.ir/v1.1/payment',$params,$authorization);
            header("Location: $result->link");
            exit();
        }elseif($payment_gateway=='payping'){
            $params = array(
                'amount' => round( $order->amount),
                'returnUrl' => $CallbackURL,
                'payerIdentity' => Auth::user()->mobile,
                'payerName' => Auth::user()->name .' '. Auth::user()->family,
                'description' =>  'خرید '.$order->orders_model,
            );
            $authorization = "Authorization: Bearer ".env('PayPing_Token');
            $response = $this->Curl('https://api.payping.ir/v2/pay',$params,$authorization);
            if(isset($response->code)){
                $order->payment_tracking = $response->code;
                $order->save();
                Header('Location: https://api.payping.ir/v1/pay/gotoipg/'.$response->code);
                exit();
            }else{
                print_r($response);
            }
        }
    }


    public function payment_order_callback($id_order,$request = null) {
        $payment_gateway = \App\Settings::where('name','payment_gateway')->first()->value;
        $order = Orders::where('id',$id_order)->where('id_user',Auth::user()->id)->whereNull('payment')->first();
        if($payment_gateway=='zibal') {
            if ($request->success == 1) {
                $CheckCardBank = self::CheckCardBank($order->amount,$order->id,$request->cardNumber,'','mask');
                if($CheckCardBank == true) {
                    $parameters = array(
                        "merchant" => env("ZibalToken"),//required
                        "trackId" => $request->trackId,//required
                    );
                    $response = $this->postToZibal('v1/verify', $parameters);
                    if ($response->result == 100) {
                        $result = self::payment_success($order->id,$response->refNumber,'زیبال');
                    }else{
                        $result = array('status' => false, 'message' => "پرداخت با مشکل مواجه شد");
                    }
                }else {
                    $order->status = 'معلق,عودت';
                    $order->payment_gateway = 'درگاه زیبال';
                    $order->save();
                    $result = array('status' => false, 'message' => "کارتی که پرداخت کرده اید در پنل کاربری ثبت نشده است و مبلغ پرداخت شده حداکثر تا یک ساعت آینده به کارت پرداخت کننده به صورت اتوماتیک عودت میشود و تیکتی در این خصوص برای شما ثبت شده است که آن را بررسی و پیگیری نمایید.");
                }
            } else if ($request->success == 0) {
                $result = array('status' => false, 'message' => "پرداخت کنسل شد!");
            }
        }
        else if($payment_gateway=='idpay'){
            if($request->status == 10){
                $CheckCardBank = self::CheckCardBank($order->amount,$order->id,$request->card_no,$request->hashed_card_no,'hash');
                if($CheckCardBank == true) {
                    $params = array(
                        'id' =>  $request->id,
                        'order_id' => $request->order_id,
                    );
                    $authorization = 'X-API-KEY: '.env('IdpayToken');
                    $res = $this->Curl('https://api.idpay.ir/v1.1/payment/verify',$params,$authorization);
                    if(isset($res->status) && $res->status == 100){
                        $result = self::payment_success($order->id,$res->track_id,'آی دی پی');
                    }else
                        $result = array('status' => false, 'message' => "پرداخت با شکست مواجه شد!");
                }else{
                    $order->status = 'معلق,عودت';
                    $order->payment_gateway = 'درگاه آی دی پی';
                    $order->save();
                    $result = array('status' => false, 'message' => "کارتی که پرداخت کرده اید در پنل کاربری ثبت نشده است و مبلغ پرداخت شده حداکثر تا یک ساعت آینده به کارت پرداخت کننده به صورت اتوماتیک عودت میشود و تیکتی در این خصوص برای شما ثبت شده است که آن را بررسی و پیگیری نمایید.");
                }
            }else
                $result = array('status' => false, 'message' => "پرداخت کنسل شد!");

        }if($payment_gateway=='payping'){
            if($request->refid!=1) {
                $authorization = "Authorization: Bearer " . env('PayPing_Token');
                $functions = new \App\functions;
                $params = array(
                    'amount' => round($order->amount),
                    'refid' => $request->refid,
                );
                $CheckCardBank = self::CheckCardBank($order->amount,$order->id,$request->cardnumber,$request->cardhashpan,'mask');
                if($CheckCardBank == true) {
                    $response = $functions->Curl('https://api.payping.ir/v2/pay/verify',$params,$authorization);
                    if($response->statusCodeHttp == 200 && $response->amount == round($order->amount)){
                        $result = self::payment_success($order->id,$order->payment_tracking,'درگاه پی پینگ');
                    }else{
                        $result = array('status' => false, 'message' => json_encode($response));
                    }
                }else{
                    $order->status = 'معلق,عودت';
                    $order->payment_gateway = 'درگاه پی پینگ';
                    $order->save();
                    $result = array('status' => false, 'message' => "کارتی که پرداخت کرده اید در پنل کاربری ثبت نشده است و مبلغ پرداخت شده حداکثر تا یک ساعت آینده به کارت پرداخت کننده به صورت اتوماتیک عودت میشود و تیکتی در این خصوص برای شما ثبت شده است که آن را بررسی و پیگیری نمایید.");
                }

            }else{
                $result = array('status' => false, 'message' => "پرداخت کنسل شد!");
            }
        }

        return (object)$result;
    }
    private function payment_success($id_order,$trans_id,$nameGatway){
        $order = Orders::where('id',$id_order)->where('id_user',Auth::user()->id)->whereNull('payment')->first();
        //$CheckCardBank = self::CheckCardBank($CardNumber,$order->amount,$order->id);
        //if($CheckCardBank == true) {
        $order->payment = $order->amount;
        $order->status = 'پرداخت شده';
        $order->payment_gateway = $nameGatway;
        $order->payment_tracking = $trans_id;
        $order->save();
        //self::CheckInvitation($order->id);
        $result = array('status' => true, 'message' => "پرداخت با موفقیت انجام شد!",'RefID'=>$trans_id);
        //}
        return $result;
    }


    public function payment_wallet_order($id_order) {
	    if(isset(Auth::user()->id))
	        $user = \App\User::find(Auth::user()->id);
	    else
            $user =  \App\User::find(Orders::where('id',$id_order)->whereNull('payment')->first()->id_user);

        $order = Orders::where('id',$id_order)->where('id_user',$user->id)->whereNull('payment')->first();
        if($order->amount <= $user->wallet){
            DB::beginTransaction();
            try {
                \App\User::find($user->id)->decrement('wallet',$order->amount);

                $user_finance = new \App\UserFinance;
                $user_finance->type = 'برداشت';
                $user_finance->description = 'خرید '.$order->orders_model;
                $user_finance->id_user = $user->id;
                $user_finance->amount = $order->amount;
                $user_finance->stock = $user->wallet - $order->amount;
                $user_finance->id_order = $id_order;
                $user_finance->save();

                $order->payment = $order->amount;
                $order->status = 'پرداخت شده';
                $order->payment_gateway = 'کیف پول';
                $order->save();
                //self::CheckInvitation($order->id);
                DB::commit();
                $result = array('status' => true, 'message' => 'پرداخت با موفقیت انجام شد!');


            } catch (\Exception $e) {
                DB::rollback();
                $result = array('status' => false, 'message' => 'عملیات دچار مشکل شد'.$e);
            }
        }else
            $result = array('status' => false, 'message' => 'عملیات دچار مشکل شد');

        return (object)$result;
    }

    public function sell_wallet_order($id_order,$id_user = null) {
	    $id_user = isset(Auth::user()->id) ? Auth::user()->id : $id_user;
        $user = \App\User::find($id_user);

        $order = Orders::where('id',$id_order)->where('id_user',$user->id)->
                            where('type','sell')->whereNull('payment')->first();

        DB::beginTransaction();
        try {
            \App\User::find($user->id)->increment('wallet',$order->amount);

            $user_finance = new \App\UserFinance;
            $user_finance->type = 'واریز';
            $user_finance->description = 'فروش '.$order->orders_model;
            $user_finance->id_user = $user->id;
            $user_finance->amount = $order->amount;
            $user_finance->stock = $user->wallet + $order->amount;
            $user_finance->id_order = $id_order;
            $user_finance->save();

            $order->payment = $order->amount;
            $order->wallet = $order->amount;
            $order->status = 'پرداخت شده';
            $order->save();

            DB::commit();
            $result = array('status' => true, 'message' => 'پرداخت با موفقیت انجام شد!');


        } catch (\Exception $e) {
            DB::rollback();
            $result = array('status' => false, 'message' => 'عملیات دچار مشکل شد');
        }


        return (object)$result;
    }

    public function payment_order_BackStock($id_order) {
        if(isset(Auth::user()->id))
            $user = \App\User::find(Auth::user()->id);
        else
            $user = \App\User::find(Orders::where('id',$id_order)->first()->id_user);

        $order = Orders::where('id',$id_order)->where('id_user',$user->id)->
                            where('type','!=','sell')->whereNotNull('payment')->first();

        DB::beginTransaction();
        try {
            \App\User::find($user->id)->increment('wallet',$order->amount);

            $user_finance = new \App\UserFinance;
            $user_finance->type = 'واریز';
            $user_finance->description = 'برگشت خرید '.$order->orders_model;
            $user_finance->id_user = $user->id;
            $user_finance->amount = $order->amount;
            $user_finance->stock = ($user->wallet+$order->amount);
            $user_finance->id_order = $id_order;
            $user_finance->save();

            $invitation = \App\UserInvitation::where('id_order',$order->id)->first();
            if(isset($invitation)){
                \App\User::find($invitation->id_user)->decrement('wallet',$invitation->amount);
                $UserFinance = \App\UserFinance::where('description','پورسانت سفارش')->where('amount',$invitation->amount)->orderBy('id','desc')->first();
                $UserFinance->delete();
                $invitation->delete();
            }

            DB::commit();
            $result = array('status' => true, 'message' => 'پرداخت با موفقیت انجام شد!');


        } catch (\Exception $e) {
            DB::rollback();
            $result = array('status' => false, 'message' => 'عملیات دچار مشکل شد');
        }


        return (object)$result;
    }

    public function CheckCardBank($amount, $id_order, $maskCard, $HashCardNumber = null, $model, $id_user = null)
    {
        $id_user = isset(Auth::user()->id) ? Auth::user()->id : $id_user;

        $UserCardBank = \App\CardBank::select('card_number')->where('confirm','1')->where('id_user',Auth::user()->id)->get();
        if($model == 'mask'){
            foreach($UserCardBank as $card){
                $CardNumberFrist = substr($maskCard,0,6);
                $CardFrist = substr($card->card_number,0,6);
                $CardNumberLast = substr($maskCard,-4);
                $CardLast = substr($card->card_number,-4);
                if($CardNumberFrist == $CardFrist && $CardNumberLast == $CardLast)
                    return true;
            }
        }elseif($model == 'hash'){
            foreach($UserCardBank as $card){
                $hash = strtoupper(hash('sha256', $card->card_number));
                if($hash == $HashCardNumber)
                    return true;
            }
        }

        $ticket = new \App\Ticket;
        $ticket->title = 'عدم انجام سفارش';
        $ticket->unit = 'مالی';
        $ticket->seen_admin = 1;
        $ticket->status = 1;
        $ticket->id_order = $id_order;
        $ticket->id_user = $id_user;
        $ticket->save();

        $ticket_message = new \App\TicketMessage;
        $ticket_message->id_ticket = $ticket->id;
        $ticket_message->author = 'admin';
        $ticket_message->message = '        شما سفارشی به مبلغ '. number_format($amount) .'تومان را توسط کارت '.'<span dir="ltr">' .$maskCard .'</span>' .' انجام داده اید که هنوز این کارت در پنل کاربری ثبت یا تایید نشده است. مبلغ کسر شده حداکثر تا یک ساعت آینده به صورت اتوماتیک به کارت عودت میشود.

<a href="'.asset('profile/financial').'" class="typo_link text-warning">جهت افزودن کارت کلیک کنید</a>
        ';
        $ticket_message->save();
        return false;
    }

    public function CheckInvitation($id_order){
	    if(isset(Auth::user()->id))
	        $user = \App\User::find(Auth::user()->id);
	    else
            $user = \App\User::find(Orders::where('id',$id_order)->first()->id_user);

        $order = Orders::where('id',$id_order)->where('type','!=','sell')->whereNotNull('payment')->where('id_user',$user->id)->first();
        if($user->invitationID != '' && isset($user->invitationID)){
            $invitation_percent = \App\Settings::where('name','invitation_percent_'.$order->orders_model)->first();
            if(isset($invitation_percent)):
                $invitation_percent = $invitation_percent->value;
                DB::beginTransaction();
                try {
                    if($invitation_percent < 100)
                        $amount_percent = ($order->amount / 100)* $invitation_percent;
                    else
                        $amount_percent = $invitation_percent;

                    \App\User::find($user->invitationID)->increment('wallet',$amount_percent);

                    $invitationID =  \App\User::find($user->invitationID);

                    $user_finance = new \App\UserFinance;
                    $user_finance->type = 'واریز';
                    $user_finance->description = 'پورسانت سفارش';
                    $user_finance->id_user = $user->invitationID;
                    $user_finance->amount = $amount_percent;
                    $user_finance->stock = $invitationID->wallet + $amount_percent;
                    $user_finance->save();

                    $user_invitation = new \App\UserInvitation;
                    $user_invitation->id_user = $user->invitationID;
                    $user_invitation->id_invitation_user = $user->id;
                    $user_invitation->amount = $amount_percent;
                    $user_invitation->id_order = $order->id;
                    $user_invitation->save();

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    $result = array('status' => false, 'message' => 'عملیات دچار مشکل شد');
                }
            endif;
        }
    }


    public function get_order_detail($id_order)
    {
        $order = Orders::select('id', 'orders_model', 'type')->where('id', $id_order)->first();
        $result = (object)array();
        if ($order->orders_model == 'PSVouchers') {
            $result->title = 'ووچرز';
            $result->dollar = ' دلار ووچرز';
        } elseif ($order->orders_model == 'perfectmoney'){
            $result->title = 'پرفکت مانی';
            $result->dollar = ' دلار پرفکت مانی';
        }
        elseif ($order->orders_model == 'PMvoucher'){
            $result->title = 'ووچر پرفکت مانی';
            $result->dollar = ' دلار پرفکت مانی';
        }elseif($order->orders_model == 'bitcoin'){
            $result->title = 'بیت کوین';
            $result->dollar = 'BTC';
        }elseif($order->orders_model == 'ethereum'){
            $result->title = 'اتریوم';
            $result->dollar = 'ETH';
        }elseif($order->orders_model == 'ripple'){
            $result->title = 'ریپل';
            $result->dollar = 'XRP';
        }elseif($order->orders_model == 'tether'){
            $result->title = 'تتر';
            $result->dollar = 'USDT';
        }elseif($order->orders_model == 'paypal'){
            $result->title = 'پی پل';
            $result->dollar = ' دلار پی پل';
        }elseif($order->orders_model == 'skrill'){
            $result->title = 'اسکریل';
            $result->dollar = ' دلار اسکریل';
        }elseif($order->orders_model == 'webmoney'){
            $result->title = 'وب مانی';
            $result->dollar = ' دلار وب مانی';
        }

        if($order->type == 'sell')
            $result->type = 'فروش';
        elseif($order->type == 'buy')
            $result->type = 'خرید';
        elseif($order->type == 'charge')
            $result->type = 'شارژ';

        if ($result->type=='خرید' && ($result->title=='پرفکت مانی' | $result->title=='وب مانی' | $result->title=='اسکریل' | $result->title=='پی پل'))
            $result->type = 'خرید با';

        $orders_model = DB::table('orders_'.strtolower($order->orders_model))->where('id_order',$order->id)->first();
        $amount_dollar = isset($orders_model->amount_dollar) ? $orders_model->amount_dollar : '';
        $result->amount_dollar =  $amount_dollar;

        if($order->orders_model == 'webmoney' && isset($orders_model->paymer_code))
            $result->title = 'پیمر وب مانی';

        return $result;
    }


    public function send_notification($title, $message, $singleID , $data = array() ) {

	    if(count($data)==0)
            $data = array('id_user' => 1);

        if (!defined('API_ACCESS_KEY'))
            define('API_ACCESS_KEY', env('FirebaseToken'));

        $fcmFields = array(
            //'registration_ids' => $registrationIDs,
            'to' => $singleID,
            //'priority' => 'high',
            "data" => $data,
            "notification" => array('click_action' => asset(''),
                'title' => $title,
                'body' => $message,
                'icon' => asset('')."app-assets/images/icon.png",
            )
        );

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $res = curl_exec($ch);
        curl_close( $ch );
        return json_decode($res);
    }


    public function KavehnegarSend($mobile , $token , $template ) {
        $url='https://api.kavenegar.com/v1/'.env('KavehnegarKey').'/verify/lookup.json?receptor='.$mobile.'&token='.$token.'&template='.$template;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //curl_setopt($ch,CURLOPT_POSTFIELDS);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $res = curl_exec($ch);
        $res = json_decode($res);
        $res = $res->return;
        return $res;
    }

    public function KavehnegarSendTokens($mobile , $token = [] , $template ) {

	    if(count($token) == 1)
            $url='https://api.kavenegar.com/v1/'.env('KavehnegarKey').'/verify/lookup.json?receptor='.$mobile.'&token='.$token[0].'&template='.$template;
        elseif(count($token) == 2)
            $url='https://api.kavenegar.com/v1/'.env('KavehnegarKey').'/verify/lookup.json?receptor='.$mobile.'&token='.$token[0].'&token2='.$token[1].'&template='.$template;
        elseif(count($token) == 3)
            $url='https://api.kavenegar.com/v1/'.env('KavehnegarKey').'/verify/lookup.json?receptor='.$mobile.'&token='.$token[0].'&token2='.$token[1].'&token3='.$token[2].'&template='.$template;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //curl_setopt($ch,CURLOPT_POSTFIELDS);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $res = curl_exec($ch);
        $res = json_decode($res);
        $res = $res->return;
        return $res;
    }

    function CheckBeforeSell($model , $id_user = null){

        $id_user = isset(Auth::user()->id) ? Auth::user()->id : $id_user;
        $user = \App\User::find($id_user);
        $userData = json_decode($user->data);
        if(isset($userData->sellStatus) && $userData->sellStatus != 'true'){
            $result = (object)array('status' => false, 'message' => 'امکان فروش ارز برای شما وجود ندارد و لطفا با پشتیبانی تماس بگیرید!');
            return $result;
        }

        $disable_buy = Settings::where('name', $model.'_sell_status')->first()['value'];
        if ($disable_buy=='false') {
            $result = (object)array('status' => false, 'message' => 'فروش این ارز به ما موقتا غیر فعال است.');
            return $result;
        }

        $result = (object)array('status' => true, 'message' => "");
        return $result;
    }

    public function CheckBeforeBuy($amount,$buy_method = 0,$id_user = null,$model = null , $dollar = null){
        $id_user = isset(Auth::user()->id) ? Auth::user()->id : $id_user;
        $user = \App\User::find($id_user);

        $userData = json_decode($user->data);
        if(isset($userData->buyStatus) && $userData->buyStatus != 'true'){
            $result = (object)array('status' => false, 'message' => 'امکان خرید ارز برای شما وجود ندارد و لطفا با پشتیبانی تماس بگیرید!');
            return $result;
        }


        if($buy_method == 0 &&
            ($user->shenasname_confirm != 1 || $user->card_meli_confirm != 1 || $user->address_confirm != 1 )){
            $result = (object)array('status' => false, 'message' => 'برای خرید از طریق درگاه بانکی لازم است اطلاعات شما تکمیل گردد');
            return $result;
        }


        if($buy_method==0 && \App\CardBank::where('id_user',$id_user)->where('confirm',1)->count() <= 0){
            $result = (object)array('status' => false, 'message' => 'هنوز کارت بانکی تایید شده ای جهت پرداخت ندارید!'.'<br><a href="'.asset('').'profile/financial"> افزودن کارت کلیک کنید</a>');
            return $result;
        }

        $disable_buy_message = Settings::where('name', 'disable_buy_message')->first()['value'];
        if ($disable_buy_message!='') {
            $result = (object)array('status' => false, 'message' => $disable_buy_message);
            return $result;
        }

        $disable_buy = Settings::where('name', $model.'_buy_status')->first()['value'];
        if ($disable_buy=='false') {
            $result = (object)array('status' => false, 'message' => 'خرید این ارز موقتا غیر فعال است.');
            return $result;
        }

        if ($amount > 50000000) {
            $result = (object)array('status' => false, 'message' => "با توجه به محدودیت درگاه بانکی حداکثر مبلغ قابل پرداخت 50,000,000 تومان است.");
            return $result;
        }

        $sum_order_buy = Orders::where('id_user', $user->id)->where('created_at', '>', date('Y-m-d'))
            ->where('created_at', '<', date('Y-m-d',strtotime("+1 days")))
            ->whereIn('type', ['buy','buy-product'])->whereIn('status',['پرداخت شده','در دست اقدام','در حال پردازش','در حال بررسی پرداخت','در حال انتقال ارز'])->sum('amount');
        $orderDay = \App\Orders::where('id_user', Auth::user()->id)->where('created_at', '>', date('Y-m-d'))
            ->where('created_at', '<', date('Y-m-d',strtotime("+1 days")))
            ->whereIn('type', ['buy','buy-product'])->whereIn('status',['پرداخت شده','در حال بررسی پرداخت','در دست اقدام','در حال پردازش'])->get();

        $functions = new functions;
        foreach ($orderDay as $order){
            $detail = $functions->get_order_detail($order->id);
            if (!$detail->amount_dollar){
                $sum_order_buy = $sum_order_buy - $order->amount;
            }
        }
        if ($sum_order_buy+$amount > $user->daily_buy) {
            $result = (object)array('status' => false, 'message' => "مبلغ مورد نیاز از جمع خرید های امروز شما بیشتر است!");
            return $result;
        }

        $min_buy = Settings::where('name', 'min_buy')->first()['value'];
        if ($amount < $min_buy) {
            $result = (object)array('status' => false, 'message' => "حداقل مجاز مبلغ خرید " . number_format($min_buy) . " تومان میباشد");
            return $result;
        }

        if ($buy_method == 1 && $amount > $user->wallet) {
            $result = (object)array('status' => false, 'message' => 'مبلغ قابل پرداخت از موجودی شما بیشتر است<br><small>برای پرداخت <a href="' . asset('') . 'wallet">کیف پول</a> خود را شارژ کنید<small>');
            return $result;
        }


        //check stock before buy
        if($model == 'perfectmoney' || $model == 'PMvoucher'){
            $api = Settings::where('name','stock_perfectmoney_api')->first()->value;
            if($api == 'off')
                $stock_perfectmoney = str_replace([' ', '$'],'',Settings::where('name','stock_perfectmoney')->first()->value);
            else{
                $stock = app('App\Http\Controllers\User\DashboardController')->perfectmoney_balances();
                $perfectmoney = Settings::where('name', 'perfectmoney_Payer_Account')->first()['value'];
                isset($stock['data'][$perfectmoney]) ? $stock_perfectmoney = $stock['data'][$perfectmoney] : '';
            }
            if($stock_perfectmoney < $dollar){
                $result = (object)array('status' => false, 'message' => 'موجودی پرفکت مانی آی آر پی کمتر از درخواست شما میباشد.<br> موجودی: '.$stock_perfectmoney.'$');
                return $result;
            }
        }elseif($model == 'PSVouchers'){
            $api = Settings::where('name','stock_psvouchers_api')->first()->value;
            if($api == 'off')
                $stock_psvouchers = str_replace([' ', '$'],'',Settings::where('name','stock_psvouchers')->first()->value);
            else{
                $stock_psvouchers = app('App\Http\Controllers\User\PSVoucherController')->GetBalance();
                $stock_psvouchers = isset($stock_psvouchers) ? $stock_psvouchers = $stock_psvouchers : '';
            }
            if($stock_psvouchers < $dollar){
                $result = (object)array('status' => false, 'message' => 'موجودی پی اس ووچرز آی آر پی کمتر از درخواست شما میباشد.<br> موجودی: '.floor($stock_psvouchers).'$');
                return $result;
            }
        }elseif($model == 'bitcoin'){
            $GateApi = new \App\GateApi;
            $response = $GateApi->get_balances();
            $api = Settings::where('name','stock_bitcoin_api')->first()->value;
            if($api == 'off')
                $stock_bitcoin = str_replace([' ', 'BTC'],'',Settings::where('name','stock_bitcoin')->first()->value);
            else{
                $stock_bitcoin = round($response['available']['BTC'] , 4);
            }
            if($stock_bitcoin < $dollar){
                $result = (object)array('status' => false, 'message' => 'موجودی بیت کوین آی آر پی کمتر از درخواست شما میباشد.<br> موجودی: '.$stock_bitcoin.'BTC');
                return $result;
            }
        }elseif($model == 'ethereum'){
            $GateApi = new \App\GateApi;
            $response = $GateApi->get_balances();
            $api = Settings::where('name','stock_ethereum_api')->first()->value;
            if($api == 'off')
                $stock_ethereum = str_replace([' ', 'ETH'],'',Settings::where('name','stock_ethereum')->first()->value);
            else{
                $stock_ethereum = round($response['available']['ETH'] , 4);
            }
            if($stock_ethereum < $dollar){
                $result = (object)array('status' => false, 'message' => 'موجودی اتریوم آی آر پی کمتر از درخواست شما میباشد.<br> موجودی: '.$stock_ethereum.'ETH');
                return $result;
            }
        }elseif($model == 'ripple'){
            $GateApi = new \App\GateApi;
            $response = $GateApi->get_balances();
            $api = Settings::where('name','stock_ripple_api')->first()->value;
            if($api == 'off')
                $stock_ripple = str_replace([' ', 'XRP'],'',Settings::where('name','stock_ripple')->first()->value);
            else{
                $stock_ripple = round($response['available']['XRP'] , 4);
            }
            if($stock_ripple < $dollar){
                $result = (object)array('status' => false, 'message' => 'موجودی ریپل آی آر پی کمتر از درخواست شما میباشد.<br> موجودی: '.$stock_ripple.'XRP');
                return $result;
            }
        }elseif($model == 'tether'){
            $GateApi = new \App\GateApi;
            $response = $GateApi->get_balances();
            $api = Settings::where('name','stock_tether_api')->first()->value;
            if($api == 'off')
                $stock_tether = str_replace([' ', 'USDT'],'',Settings::where('name','stock_tether')->first()->value);
            else{
                $stock_tether = round($response['available']['USDT'] , 4);
            }
            if($stock_tether < $dollar){
                $result = (object)array('status' => false, 'message' => 'موجودی تتر آی آر پی کمتر از درخواست شما میباشد.<br> موجودی: '.$stock_tether.'USDT');
                return $result;
            }
        }


        $result = (object)array('status' => true, 'message' => "");
        return $result;

    }


    function postToZibal($path, $parameters)
    {
        $url = 'https://gateway.zibal.ir/'.$path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }


    function Curl($url,$params =[], $authorization = null,$method = 'POST'){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($params));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = json_decode( curl_exec($ch) );
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response->statusCodeHttp = $httpcode;
        //array_push($response,$httpcode);
        curl_close($ch);

        return $response;
    }


}
