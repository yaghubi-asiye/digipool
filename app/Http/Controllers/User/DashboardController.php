<?php
 
namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali;
use DB;
use Session;
use Auth;
use App\Settings;
use SoapClient;

class DashboardController extends Controller
{
    public function index(){
       //$stock = self::perfectmoney_balances();
    //return response()->json($stock);
        $result = (object)array();
        $result->CountBuy = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->
                                        whereRaw('(type = "buy" or type = "charge")')->count();
        $result->CountSell = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->
                                        whereRaw('(type = "sell")')->count();
        $result->TotalAmount = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->sum('amount');
        $Finances = \App\UserFinance::select('stock','created_at')->where('id_user',Auth::user()->id)->orderBy('id','desc')->limit(10)->get()->reverse();
        $result->ChartFinance = $Finances;
        $result->CountFinance = \App\UserFinance::where('id_user',Auth::user()->id)->count();
        $result->CountFinanceIncrement = \App\UserFinance::where('id_user',Auth::user()->id)->where('type','واریز')->count();
        $result->CountFinanceDecrement = \App\UserFinance::where('id_user',Auth::user()->id)->where('type','برداشت')->count();
        $result->CountTicket = \App\Ticket::where('id_user',Auth::user()->id)->count();
        $result->CountInvitation = User::where('invitationID',Auth::user()->id)->count();
        $dateString = Jalali\Jalalian::forge('now')->format('Y-m-01');
        $FristDayMonth = Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $dateString)->format('Y-m-d');
        $dateString =  Jalali\Jalalian::forge('now')->addMonths(1)->format('Y-m-01');
        $LastDayMonth = Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $dateString)->format('Y-m-d');
        $result->Month = Jalali\Jalalian::forge('now')->format('F');
        $result->CountBuyMonth = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->
                                            whereRaw('(type = "buy" or type = "charge") and created_at > ? and created_at < ?',[$FristDayMonth,$LastDayMonth])->sum('amount');
        $result->CountSellMonth = $Orders = \App\Orders::where('id_user',Auth::user()->id)->where('status','!=','معلق')->where('status','!=','معلق,عودت')->
                                            whereRaw('(type = "sell") and created_at > ? and created_at < ?',[$FristDayMonth,$LastDayMonth])->sum('amount');
        $result->SumOrderDay = \App\Orders::where('id_user', Auth::user()->id)->where('created_at', '>', date('Y-m-d'))
            ->where('created_at', '<', date('Y-m-d',strtotime("+1 days")))
            ->whereIn('type', ['buy','charge'])->whereIn('status',['پرداخت شده','در حال بررسی پرداخت','در دست اقدام','در حال پردازش'])->sum('amount');
        $result->SumOrderDay = \App\Orders::where('id_user', Auth::user()->id)->where('created_at', '>', date('Y-m-d'))
            ->where('created_at', '<', date('Y-m-d',strtotime("+1 days")))
            ->whereIn('type', ['buy','buy-product'])->whereIn('status',['پرداخت شده','در دست اقدام','در حال پردازش','در حال بررسی پرداخت','در حال انتقال ارز'])->sum('amount');
        $orderDay = \App\Orders::where('id_user', Auth::user()->id)->where('created_at', '>', date('Y-m-d'))
            ->where('created_at', '<', date('Y-m-d',strtotime("+1 days")))
            ->whereIn('type', ['buy','buy-product'])->whereIn('status',['پرداخت شده','در حال بررسی پرداخت','در دست اقدام','در حال پردازش'])->get();

        $functions = new \App\functions;
        foreach ($orderDay as $order){
            $detail = $functions->get_order_detail($order->id);
            if (!$detail->amount_dollar){
                $result->SumOrderDay = $result->SumOrderDay - $order->amount;
            }
        }


        $result->notification = \App\Notification::where('head_fix',1)->orwhere('head_close',1)->orderBy('id','desc')->get();

        $Cookie = json_decode(\Cookie::get('alertID'));
        if(isset($Cookie))
            foreach ($result->notification as $key=>$notification){
                if(in_array($notification->id,$Cookie))
                    unset($result->notification[$key]);
            }

        $result->Currencys = (object)array('PSVouchers','PerfectMoney');


        return view('user.dashboard',['result'=>$result]);
    }

    public function check_stock(){
        $result = (object)array();

        //$GateApi = new \App\GateApi;
        //$response = $GateApi->get_balances();

        //perfectmoney
        // $api = Settings::where('name','stock_perfectmoney_api')->first()->value;
        // if($api == 'off')
        //     $result->stock_PerfectMoney = Settings::where('name','stock_perfectmoney')->first()->value;
        // else{
        //     $stock = $this->perfectmoney_balances();
        //     $perfectmoney = Settings::where('name', 'perfectmoney_Payer_Account')->first()['value'];
        //     isset($stock['data'][$perfectmoney]) ? $result->stock_PerfectMoney = $stock['data'][$perfectmoney].'$' : '';
        // }

        $fee_PerfectMoney = app('App\Http\Controllers\User\PerfectMoneyController')->price();
        $result->fee_buy_PerfectMoney = number_format($fee_PerfectMoney->buy);
        $result->fee_sell_PerfectMoney = number_format($fee_PerfectMoney->sell);
        return response()->json($result);


        //PSVouchers  asiye commented
        // $api = Settings::where('name','stock_psvouchers_api')->first()->value;
        // if($api == 'off')
        //     $result->stock_PSVouchers = Settings::where('name','stock_psvouchers')->first()->value;
        // else{
        //     $stock_PSVouchers = app('App\Http\Controllers\User\PSVoucherController')->GetBalance();
        //     isset($stock_PSVouchers) && is_numeric($stock_PSVouchers) ? $result->stock_PSVouchers = round($stock_PSVouchers,2).'$' : '';
        // }

        // $fee_PSVouchers = app('App\Http\Controllers\User\PSVoucherController')->price();
        // $result->fee_buy_PSVouchers = number_format($fee_PSVouchers->buy);
        // $result->fee_sell_PSVouchers = number_format($fee_PSVouchers->sell);





        /*
         *
         *  //paypal
        $api = Settings::where('name','stock_paypal_api')->first()->value;
        if($api == 'off')
            $result->stock_paypal = Settings::where('name','stock_paypal')->first()->value;
        else{

        }


        $api = Settings::where('name','stock_skrill_api')->first()->value;
        if($api == 'off')
            $result->stock_skrill = Settings::where('name','stock_skrill')->first()->value;
        else{

        }


        $api = Settings::where('name','stock_webmoney_api')->first()->value;
        if($api == 'off')
            $result->stock_webmoney = Settings::where('name','stock_skrill')->first()->value;
        else{

        }

        $api = Settings::where('name','stock_bitcoin_api')->first()->value;
        if($api == 'off')
            $result->stock_bitcoin = Settings::where('name','stock_bitcoin')->first()->value;
        else{
            $result->stock_bitcoin = round($response['available']['BTC'] , 4).'BTC';
        }


        $api = Settings::where('name','stock_tether_api')->first()->value;
        if($api == 'off')
            $result->stock_ripple = Settings::where('name','stock_tether')->first()->value;
        else{
            $result->stock_ripple = round($response['available']['USDT'] , 4).'USDT';
        }

        $api = Settings::where('name','stock_ethereum_api')->first()->value;
        if($api == 'off')
            $result->stock_ethereum = Settings::where('name','stock_ethereum')->first()->value;
        else{
            $result->stock_ethereum = round($response['available']['ETH'] , 4).'ETH';
        }
        */

    }




    public function RemoveNotification(Request $request){
        $Cookie = \Cookie::get('alertID');
        $Cookie = json_decode($Cookie);
        if(isset($Cookie)){
            if(!in_array($request->id,$Cookie))
                array_push($Cookie,$request->id);
        }
        else
            $Cookie = array($request->id);
        \Cookie::queue('alertID', json_encode($Cookie), 600000);
    }



    public function perfectmoney_balances()
    {
        $AccountID = Settings::where('name', 'perfectmoney_AccountID')->first()['value'];
        $Password = Settings::where('name', 'perfectmoney_Password')->first()['value'];
        $ssl_fix = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]];
        // trying to open URL to process PerfectMoney Spend request
        $url = file_get_contents('https://perfectmoney.com/acct/balance.asp?AccountID=' . $AccountID . '&PassPhrase=' . $Password , false, stream_context_create($ssl_fix));
        if(!$url){
            return ['status' => 'error', 'message' => 'Connection error'];
        }
        // searching for hidden fields
        if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $url, $result, PREG_SET_ORDER))
        {
            return ['status' => 'error', 'message' => 'Invalid output'];
        }
        // putting data to array (return error, if have any)
        $data = [];
        foreach($result as $item)
        {
            if($item[1] == 'ERROR')
            {
                return ['status' => 'error', 'message' => $item[2]];
            }
            else
            {
                $data['data'][$item[1]] = $item[2];
            }
        }

        $data['status'] = 'success';

        return $data;

    }

    public function insert_token(Request $request){
        if($request->token != Auth::user()->firebase_token){
            $user = User::find(Auth::user()->id);
            $user->firebase_token = $request->token;
            $user->save();
        }

        define('API_ACCESS_KEY', env('FirebaseToken'));

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $curlUrl = "https://iid.googleapis.com/iid/v1:batchAdd";
        $mypush = array("to"=>"/topics/all", "registration_tokens"=>array($request->token));
        $myjson = json_encode($mypush);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curlUrl);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, True);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myjson);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

    }


    protected function redirectForm(Request $request){
        //dd($request);
        if($request->mySelect1=='PerfectMoney')
            $request->mySelect1 = 'perfectmoney';
        if($request->mySelect2=='PerfectMoney')
            $request->mySelect2 = 'perfectmoney';

        if($request->mySelect1 == 'rial'){
            $amount = str_replace(',','',$request->myText1);
            return redirect($request->mySelect2.'?amount='.$amount);
        }else{
            $dollar = $request->myText1;
            return redirect($request->mySelect1.'/sell?amount='.$dollar);
        }
        return redirect()->back();
        //return response()->json($request);
    }


    public function send(){

        dd();
        /*
        $data = array('date'=>'20 مرداد 1398', 'title'=>'عنوان', 'body'=>'body');

        //return view('emails.notification',$data);

        $email='yones.saeedi1@gmail.com';
        $mail = \Mail::send('emails.notification', $data, function($message) use ($email)
        {
            $message->to($email, Auth::user()->name .' '.Auth::user()->family)->subject('اطلاعیه از طرف آی آر پی');
        });
        return response()->json($mail);
        */

        define('API_ACCESS_KEY', env('FirebaseToken'));

        $fcmFields = array(
            //'registration_ids' => $registrationIDs,
            //'to' => "e5cQfMwMFYc:APA91bH-tBo1TivabHq1u8Xrb6oz7rfWwsj_EVQ7KYDdHCbQ65L68AGIaPHXXL4z7PHALT2EbQjVN5LLQVzw4JkS1x5gs2aELhbHMQ7XPt1akWC9Znmp2WGTGXJlrQZf1CLIHCBqMhSn",
            'to' => "/topics/all",
            //'priority' => 'high',
            //"data" => array(),
            "notification" => array('click_action' => asset(''),
                'title' => 'عنوان',
                'body' => 'متن',
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
        return $res;
        curl_close( $ch );

    }


}

