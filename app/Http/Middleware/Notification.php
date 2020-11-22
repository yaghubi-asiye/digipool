<?php



namespace App\Http\Middleware;
use Auth;
use Morilog\Jalali;

use Closure;



class Notification

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next){

        $user = Auth::user();

        if(Auth::guard('admin')->check()){
            $CountUserPending = \App\User::where('card_meli_confirm',2)->orWhere('address_confirm',2)->orWhere('shenasname_confirm',2)->count();
            config(['notification.CountUserPending' => $CountUserPending]);
            if($CountUserPending>0){
                $User = \App\User::select('name','family','updated_at')->where('card_meli_confirm',2)->orWhere('address_confirm',2)->orWhere('shenasname_confirm',2)->orderBy('updated_at')->first();
                config(['notification.TimeUser' => Jalali\Jalalian::forge($User->updated_at)->ago() ]);
                config(['notification.NameUser' => $User->name.' '.$User->family]);
                config(['notification.SortUser' => strtotime($User->updated_at)]);
            }

            $CountFinances = \App\UserFinance::whereNull('payment')->where('status','!=','رد شده')->whereNotNull('id_cardbank')->count();
            config(['notification.CountFinances' => $CountFinances]);
            if($CountFinances>0){
                $Finance = \App\UserFinance::select('amount','created_at')->where('status','!=','رد شده')->whereNull('payment')->whereNotNull('id_cardbank')->orderBy('created_at')->first();
                config(['notification.FinanceTime' => Jalali\Jalalian::forge($Finance->created_at)->ago() ]);
                config(['notification.FinanceAmount' => 'مبلغ: '.number_format($Finance->amount).' تومان ']);
                config(['notification.SortFinance' => strtotime($Finance->created_at)]);
            }

            $CountOrders = \App\Orders::whereIn('status',['در حال پردازش','در حال بررسی پرداخت','در دست اقدام'])->count();
            config(['notification.CountOrders' => $CountOrders]);
            if($CountOrders>0){
                $Order = \App\Orders::select('id','created_at')->whereIn('status',['در حال پردازش','در حال بررسی پرداخت','در دست اقدام'])->orderBy('created_at')->first();
                $functions = new \App\functions;
                $detail = $functions->get_order_detail($Order->id);
                config(['notification.TimeOrder' => Jalali\Jalalian::forge($Order->created_at)->ago() ]);
                config(['notification.SubjectOrder' => $detail->type .' '. $detail->title]);
                config(['notification.SortOrder' => strtotime($Order->created_at)]);
            }

            $CountCardBank = \App\CardBank::where('confirm',0)->count();
            config(['notification.CountCardBank' => $CountCardBank]);
            if($CountCardBank>0){
                $CardBank = \App\CardBank::select('id','created_at','card_number','bank_name')->where('confirm',0)->orderBy('created_at')->first();
                config(['notification.TimeCardBank' => Jalali\Jalalian::forge($CardBank->created_at)->ago() ]);
                config(['notification.SubjectCard' => $CardBank->card_number .' '. $CardBank->bank_name]);
                config(['notification.SortCard' => strtotime($CardBank->created_at)]);
            }


            $CountTicket = \App\Ticket::where('seen_admin',0)->count();
            config(['notification.CountTicket' => $CountTicket]);
            if($CountTicket>0){
                $Ticket = \App\Ticket::where('seen_admin',0)->orderBy('updated_at')->first();
                config(['notification.TimeTicket' => Jalali\Jalalian::forge($Ticket->updated_at)->ago() ]);
                config(['notification.SubjectTicket' => $Ticket->title]);
                config(['notification.SortTicket' => strtotime($Ticket->updated_at)]);
            }



        }else{ // اگر کاربر عادی بود

            $CountTicket = \App\Ticket::where('id_user',Auth::user()->id)->where('seen_user',0)->count();
            config(['notification.CountTicket' => $CountTicket]);
            if($CountTicket>0){
                $Ticket = \App\Ticket::where('seen_user',0)->orderBy('updated_at')->first();
                config(['notification.TimeTicket' => Jalali\Jalalian::forge($Ticket->updated_at)->ago() ]);
                config(['notification.SubjectTicket' => $Ticket->title]);
                config(['notification.SortTicket' => strtotime($Ticket->updated_at)]);
            }

            $url = str_replace(asset(''),'',url()->current());

            $Cookie = \Cookie::get('NTime');
            $Cookie = json_decode($Cookie);
            if(!isset($Cookie))
                $Cookie = (object) array();

            if(!isset($Cookie->order))
                $Cookie->order = time();

            $CountOrdersSellPaymentCard = \App\Orders::where('id_user',Auth::user()->id)->where('type','sell')->whereNotNull('payment')->whereNotNull('id_cardbank')->where('updated_at','>',date('Y-m-d H:i:s',$Cookie->order))->count();
            config(['notification.CountOrdersSellPaymentCard' => $CountOrdersSellPaymentCard]);
            if($CountOrdersSellPaymentCard>0){
                $Order = \App\Orders::select('id','updated_at')->where('type','sell')->whereNotNull('payment')->whereNotNull('id_cardbank')->where('updated_at','>',date('Y-m-d H:i:s',$Cookie->order))->first();
                $functions = new \App\functions;
                $detail = $functions->get_order_detail($Order->id);
                config(['notification.TimeOrdersSellPaymentCard' => Jalali\Jalalian::forge($Order->updated_at)->ago() ]);
                config(['notification.SubjectOrdersSellPaymentCard' => $detail->type .' '. $detail->title]);
                config(['notification.SortOrdersSellPaymentCard' => strtotime($Order->updated_at)]);
            }

            if(!isset($Cookie->wallet))
                $Cookie->wallet = time();

            $CountWallet = \App\UserFinance::where('id_user',Auth::user()->id)->whereNotNull('payment')->whereNotNull('id_cardbank')->where('updated_at','>',date('Y-m-d H:i:s',$Cookie->wallet))->count();
            config(['notification.CountWallet' => $CountWallet]);
            if($CountWallet>0){
                $Finance = \App\UserFinance::where('id_user',Auth::user()->id)->select('amount','updated_at')->whereNotNull('payment')->whereNotNull('id_cardbank')->where('updated_at','>',date('Y-m-d H:i:s',$Cookie->wallet))->first();
                config(['notification.TimeWallet' => Jalali\Jalalian::forge($Finance->updated_at)->ago() ]);
                config(['notification.SubjectWallet' => 'برداشت از کیف پول و واریز آن به حساب شما به مبلغ '.number_format($Finance->amount).' تومان ']);
                config(['notification.SortWallet' => strtotime($Finance->updated_at)]);
            }


            if(!isset($Cookie->invitation))
                $Cookie->invitation = time();

            $CountInvitation = \App\User::where('invitationID',Auth::user()->id)->where('created_at','>',date('Y-m-d H:i:s',$Cookie->invitation))->count();
            config(['notification.CountInvitation' => $CountInvitation]);
            if($CountInvitation>0){
                $user = \App\User::select('name','family','created_at')->whereNotNull('invitationID')->where('created_at','>',date('Y-m-d H:i:s',$Cookie->invitation))->first();
                config(['notification.TimeInvitation' => Jalali\Jalalian::forge($user->created_at)->ago() ]);
                config(['notification.SubjectInvitation' => 'کاربری با نام '.$user->name.' '.$user->family.' توسط شما با موفقیت معرفی شد ']);
                config(['notification.SortInvitation' => strtotime($user->created_at)]);
            }

            $CountInvitationFinance = \App\UserInvitation::where('id_user',Auth::user()->id)->where('created_at','>',date('Y-m-d H:i:s',$Cookie->invitation))->count();
            config(['notification.CountInvitationFinance' => $CountInvitationFinance]);
            if($CountInvitationFinance>0){
                $Finance = \App\UserInvitation::select('amount','created_at')->where('id_user',Auth::user()->id)->where('created_at','>',date('Y-m-d H:i:s',$Cookie->invitation))->first();
                config(['notification.TimeInvitationFinance' => Jalali\Jalalian::forge($Finance->created_at)->ago() ]);
                config(['notification.SubjectInvitationFinance' => 'پورسانت شما به میلغ '.number_format($Finance->amount).' تومان به کیف پول شما اضافه شد.']);
                config(['notification.SortInvitationFinance' => strtotime($Finance->created_at)]);
            }





            if($url=='orders'){
                if(isset($Cookie)){
                    $Cookie->order = time();
                }
                else{
                    $Cookie = array('order'=>time());
                }
            }
            if($url=='wallet'){
                if(isset($Cookie)){
                    $Cookie->wallet = time();
                }
                else{
                    $Cookie = array('wallet'=>time());
                }
            }
            if($url=='invitation'){
                if(isset($Cookie)){
                    $Cookie->invitation = time();
                }
                else{
                    $Cookie = array('invitation'=>time());
                }
            }

            if($url== url()->current()){//if dashboard
                //requestPermission Notification
                if (isset($Cookie->requestPermission)){
                    if (date('Y-m-d H:i:s', $Cookie->requestPermission) < date('Y-m-d H:i:s', strtotime('-1 week'))) {
                        Auth::user()->requestPermission = true;
                        $Cookie->requestPermission = time();
                    }else
                        Auth::user()->requestPermission = 0;
                }else{
                    Auth::user()->requestPermission = true;
                    $Cookie->requestPermission = time();
                }
            }

            //popup
            $popup = \App\Settings::where('name','popup')->first();
            $popup = json_decode($popup->value);
            $file = '../../sorg.ir/'.$popup->url;
            $current = '';
            if( file_exists($file))
                $current = file_get_contents($file);
            if($popup->show == true && $current != ''){
                if(isset($Cookie->popup)){
                    if (date('Y-m-d H:i:s', $Cookie->popup) < date('Y-m-d H:i:s', strtotime('-'.$popup->perDay.'day'))){
                        config(['popup' => $current]);
                        $Cookie->popup = time();
                    }else{

                    }
                }else{
                    config(['popup' => $current]);
                    $Cookie->popup = time();
                }
            }

            \Cookie::queue('NTime', json_encode($Cookie), 43200);
        }

        return $next($request);


    }

}

