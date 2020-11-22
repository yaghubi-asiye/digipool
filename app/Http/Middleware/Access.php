<?php



namespace App\Http\Middleware;
use Auth;

use Closure;



class Access

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next){

        if(Auth::guard('admin')->check()){
            $url = \Route::getFacadeRoot()->current()->uri();

            if(Auth::user()->sms2fa == 1 && Auth::user()->TwofaStatus != 'active') {
                if($url != 'ir-admin/sms2fa' && $url != 'ir-admin/sms2fa/resend'){
                    $randstring = rand(10000, 99999);
                    $functions = new \App\functions;
                    \Session::put("code", $randstring);
                    $send_sms = $functions->send_sms(Auth::user()->mobile, $randstring, 'VerifyMobile');
                    if ($send_sms->status == 200) {
                        $request->session()->flash('Success', 'کد ورود برای شما پیامک شد.');
                        return redirect()->route('A-sms2fa');
                    } else {
                        $request->session()->flash('Error', 'ارسال پیامک برای ورود دو مرحله ای امکان پذیر نیست.');
                        auth('admin')->logout();
                        return redirect()->back();
                    }
                }else{
                    return $next($request);
                }

            }elseif(Auth::user()->google2fa != "" && Auth::user()->TwofaStatus != 'active') {
                if($url != 'ir-admin/google2fa'){
                    \Session::put("google2fa", true);
                    return redirect()->route('A-google2fa');
                }else{
                    return $next($request);
                }

            }elseif((Auth::user()->TwofaStatus == 'active' || (Auth::user()->sms2fa ==0&&Auth::user()->google2fa == "")) && (\Request::route()->getName() == 'A-sms2fa' || \Request::route()->getName() == 'A-sms2fa')) {
                return redirect()->route('A-dashboard');
            }
            else{
                return $next($request);
            }


        }else{
		   $user = Auth::user();
		   $ip = $request->ip();
		   $IP_Access = \App\Settings::where('name','IP_Access')->first()['value'];
		   $IP_Iran = \App\Settings::where('name','IP_Iran')->first()['value'];

		   if($IP_Iran == 'on'){
               $ipinfo = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
               if($ipinfo->countryCode != 'IR'){
                   return \Response::view('errors.IpIran');
               }
           }

           // چرا این گذاشته شده
		//    if($IP_Access!='' && $IP_Access != $ip){
        //         return \Response::view('errors.IpAccess');
		//    }

		   if($user->access==1)
				return $next($request);
		   else{
               Auth::logout();
               return redirect('login');
		   }
       }

    }

}

