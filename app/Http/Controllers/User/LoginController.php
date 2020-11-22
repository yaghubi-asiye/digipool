<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\functions;
use App\User;
use Session;
use PragmaRX\Google2FAQRCode\Google2FA;

class LoginController extends Controller
{
    function index()
    {
        if (Auth::check())
            return redirect()->route('dashboard');
        else {
            return view('user/auth/login');
        }

    }

    function logout()
    {
        auth('')->logout();
        session()->flash('Success', 'شما با موفقیت خارج شدید .');
        return redirect('login')->withCookie(\Cookie::forget('NTime'));

    }

    function login(Request $request)
    {
        // Auth::loginUsingId(1);

        $validator = \Validator::make($request->all(), [
            'mobile' => 'required|numeric|digits:11|mobile',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        if (!$validator->fails()):
            $mobile = $request->mobile;
            $user = User::Where("mobile", $mobile)->first();
            if ($user) {
                if (\Hash::check($request->input('password'), $user->password)) {
                    if ($user->access == 0) {
                        $request->session()->flash('Error', 'دسترسی اکانت شما بسته شده است و با پشتیبانی ارتباط برقرار کنید.');
                    } elseif ($user->access == 1) {

                        session()->put("mobile", $request->mobile);
                        session()->put("password", $request->password);
                        session()->put("remember", $request->remember);

                        if ($user->sms2fa == 1) {

                            $randstring = rand(10000, 99999);
                            Session::put("verify_code", $randstring);
							try{
								$Kavenegar = \Kavenegar::VerifyLookup($mobile,$randstring,null,null,'verify');
								$request->session()->flash('Success', 'کد ورود برای شما پیامک شد.');
                                return redirect()->route('sms2fa');
							}
							catch (\Exception $ex){
								$request->session()->flash('Error', 'ارسال پیامک برای ورود دو مرحله ای امکان پذیر نیست.');
                                return redirect()->back();
							}

                        } elseif ($user->google2fa != "") {
                            Session::put("google2fa", true);
                            return redirect()->route('google2fa');
                        } else {
                            if (isset($request->remember))
                                Auth::loginUsingId($user->id, true);
                            else
                                Auth::loginUsingId($user->id);
                            return redirect()->route('dashboard');
                            $request->session()->flash('Success', 'ورود با موفقیت انجام شد.');
                        }

                    }
                } else {
                    $request->session()->flash('Error', 'اطلاعات وارد شده موجود نمی باشد، کوچک و بزرگ بودن حروف خود را چک کنید.');
                }
            } else {
                $request->session()->flash('Error', 'اطلاعات وارد شده موجود نمی باشد، کوچک و بزرگ بودن حروف خود را چک کنید.');
            }
        else:
            $request->session()->flash('Error', $validator->errors()->first());
        endif;
        return redirect()->back();
    }   


    function sms2faIndex()
    {
        if (Auth::check())
            return redirect()->route('dashboard');
        elseif (Session::has('mobile') && Session::has('password') && Session::has('verify_code')) {
            return view('user.auth.sms2fa');
        } else
            return redirect()->route('login');
    }

    function sms2fa(Request $request)
    {
        if (Auth::check())
            return redirect()->route('dashboard');
        elseif (Session::has('mobile') && Session::has('password') && Session::has('verify_code')) {

            $user = User::Where("mobile", Session::get('mobile'))->first();
            if (Session::get('verify_code') == $request->code && $user && \Hash::check(Session::get('password'), $user->password)) {

                Session()->forget('mobile');
                Session()->forget('password');
                Session()->forget('verify_code');

                if (Session::has('remember'))
                    Auth::loginUsingId($user->id, true);
                else
                    Auth::loginUsingId($user->id);

                $request->session()->flash('Success', 'ورود با موفقیت انجام شد.');
                return redirect()->route('dashboard');
            } else {
                $request->session()->flash('Error', 'کد درج شده اشتباه است!');
                return redirect()->back();
            }
        } else
            return redirect()->route('login');
    }



    function google2faIndex()
    {
        if (Auth::check())
            return redirect()->route('dashboard');
        elseif (Session::has('mobile') && Session::has('password') && Session::has('google2fa')) {
            return view('user.auth.google2fa');
        } else
            return redirect()->route('login');
    }

    function google2fa(Request $request)
    {
        if (Auth::check())
            return redirect()->route('dashboard');
        elseif (Session::has('mobile') && Session::has('password') && Session::has('google2fa')) {

            $google2fa = new Google2FA();

            $user = User::Where("mobile", Session::get('mobile'))->first();
            $valid = $google2fa->verifyKey($user->google2fa, $request->code);

            if ($valid == 1 && $user && \Hash::check(Session::get('password'), $user->password)) {

                Session()->forget('mobile');
                Session()->forget('password');
                Session()->forget('google2fa');

                if (Session::has('remember'))
                    Auth::loginUsingId($user->id, true);
                else
                    Auth::loginUsingId($user->id);
                $request->session()->flash('Success', 'ورود با موفقیت انجام شد.');
                return redirect()->route('dashboard');
            } else {
                $request->session()->flash('Error', 'کد درج شده اشتباه است!' . $request->code);
                return redirect()->back();
            }
        } else
            return redirect()->route('login');
    }


    function ForgetIndex()
    {
        if (Auth::check())
            return redirect()->route('dashboard');
        else {
            Session()->forget('mobile');
            Session()->forget('verify_code');
            return view('user.auth.forget');
        }
    }


    function Forget(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'mobile' => 'required|numeric|digits:11|mobile',
            'code' => 'nullable|numeric|digits:5',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if (!$validator->fails()):
            $mobile = $request->mobile;
            $user = User::where("mobile", $mobile)->count();
            if ($user == 0):
                $result = array('status' => false, 'message' => 'کاربری با این شماره موبایل ثبت نام نکرده است.');
                return response()->json((object)$result);
            endif;

            if(!isset($request->code) || $request->code == ''){
                Session::put("mobile", $mobile);
                if(Session::has("verify_code"))
                    $randstring = Session::get("verify_code");
                else
                    $randstring = rand(10000, 99999);
                Session::put("verify_code", $randstring);

                try{
                    \Kavenegar::VerifyLookup($mobile,$randstring,null,null,'verify');
                    $result = array('status'=> true , 'message'=>  'پیامک با موفقیت ارسال گردید و لطفا کد را درج کنید' );
                }
                catch (\Exception $ex){
                    $result = array('status'=> false , 'message'=>  'ارسال پیامک امکان پذیر نیست' );
                }

            }

            else if(Session::get("mobile") == $mobile && Session::has("verify_code")){
                if(Session::get("verify_code") == $request->code){
                    Session::put("verified", $request->code);
                    $result = array('status'=> true , 'message'=>  'success','redirect'=> route('ConfirmPassword'));
                }else
                    $result = array('status'=> false , 'message'=>  'کد درج شده اشتباه است!' );
            }else
                $result = array('status'=> false , 'message'=>  'داده ها با یکدیگر همخوانی ندارد');

        else:
            $result = array('status'=> false , 'message'=> $validator->errors()->first() );
        endif;
        return response()->json((object)$result);
    }


    function ConfirmPasswordIndex()
    {
        if (Session::has('mobile') && Session::has('verified') && Session::has('verify_code')){
            return view('user.auth.forget-confirm-password');
        }
        else
            return redirect(route('ForgetPassword'));
    }

    function ConfirmPassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'g-recaptcha-response' => 'required|captcha'

        ]);
        if ($validator->fails() != 1):

            if (Session::has('mobile') && Session::has('verified') && Session::has('verify_code')) {
                $mobile = session()->get("mobile");
                $user = User::where("mobile", $mobile)->first();
                $user->password = bcrypt($request->input("password"));
                $user->google2fa = null;
                $user->sms2fa = 0;
                $user->save();

                Session()->forget('mobile');
                Session()->forget('verify_code');

                $result = array('status' => true, 'message' => 'رمز عبور شما با موفقیت تغییر پیدا کرد .','redirect'=> route('login'));
            } else {
                $result = array('status' => false, 'message' => 'اطلاعات درج شده صحیح نیست');
            }

        else:
            $result = array('status' => false, 'message' => $validator->errors()->first());
        endif;
        return response()->json($result);
    }

    function resendForget()
    {
		try{
			$Kavenegar = \Kavenegar::VerifyLookup(Session::get('mobile'),Session::get('verify_code'),null,null,'verify');
			$result = array('status' => true, 'message' => 'با موفقیت ارسال شد');
		}
		catch (\Exception $ex){
		   $result = array('status' => false, 'message' => 'ارسال پیامک امکان پذیر نیست.');
		}
        return response()->json($result);
    }

}
