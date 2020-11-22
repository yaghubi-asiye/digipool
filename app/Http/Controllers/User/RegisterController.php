<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\functions;
use App\User;
use Session;
use Image;
use DB;

class RegisterController extends Controller
{
    function index()
    {
        Session()->forget('verified');
        Session()->forget('verify_code');
        Session()->forget('mobile');

        if (Auth::check())
            return redirect()->route('dashboard');
        else
            return view('user.auth.register');

    }

    function RegisterMobile(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'mobile' => 'required|numeric|digits:11|mobile',
            'code' => 'nullable|numeric|digits:5',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if (!$validator->fails()):
            $mobile = $request->mobile;
            $user = User::where("mobile", $mobile)->count();
            if ($user > 0):
                $result = array('status'=> false , 'message'=>'این شماره موبایل قبلا ثبت شده است و میتوانید ورود نمایید و اگر رمز خود را فراموش کرده اید از قسمت ورود اقدام به بازیابی رمز کنید.');
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
                    $result = array('status'=> false , 'message'=>  $ex->getMessage() );
                }

            }

            else if(Session::get("mobile") == $mobile && Session::has("verify_code")){
                if(Session::get("verify_code") == $request->code){
                    Session::put("verified", $request->code);
                    $result = array('status'=> true , 'message'=>  'success','redirect'=> route('RegisterProfile'));
                }else
                    $result = array('status'=> false , 'message'=>  'کد درج شده اشتباه است!' );
            }else
                $result = array('status'=> false , 'message'=>  'داده ها با یکدیگر همخوانی ندارد');



        else:
            $result = array('status'=> false , 'message'=> $validator->errors()->first() );
        endif;
        return response()->json((object)$result);

    }


    function ProfileIndex()
    {
        if (Session::has('mobile') && Session::has('verified')) {
            return view('user/auth/profile');
        } else
            return redirect(route('register'));
    }


    function profile(Request $request)
    {
        if (Session::has('mobile') && Session::has('verified')) {

            $validator = \Validator::make($request->all(), [
                'name' => 'required|farsi',
                'family' => 'required|farsi',
                'email' => 'required|email',
                'codemeli' => 'required|numeric',
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6'
            ]);
            if ($validator->fails() != 1):

                DB::beginTransaction();
                try {

                    $user = User::where('mobile', Session::get("mobile"))->first();
                    if (isset($user)) {
                        $result = array('status'=> false , 'message'=>'این شماره موبایل قبلا ثبت شده است و میتوانید ورود نمایید و اگر رمز خود را فراموش کرده اید از قسمت ورود اقدام به بازیابی رمز کنید.');
                        return response()->json((object)$result);
                    }

                    $user_exist = User::where('code_meli', $request->codemeli)->first();
                    if (isset($user_exist)) {
                        $result = array('status' => 'false', 'message' => 'کد ملی وارد شده از قبل در سیستم وجود دارد');
                        return response()->json($result);
                    }

                    $user_exist = User::where('email', $request->email)->whereNotNull('email')->first();
                    if (isset($user_exist)) {
                        $result = array('status' => 'false', 'message' => 'ایمیل وارد شده از قبل در سیستم وجود دارد');
                        return response()->json($result);
                    }

                    $user = new User();
                    $user->name = $request->name;
                    $user->family = $request->family;
                    $user->password = bcrypt($request->password);
                    $user->mobile = Session::get("mobile");
                    $user->email = $request->email;
                    $user->code_meli = $request->codemeli;
                    $user->access = 1;
                    $user->register_ip = $request->ip();

                    $daily_buy = \App\Settings::where('name','daily_buy_register')->first()->value;;
                    $user->daily_buy = $daily_buy;

                    if(Session::has('refID') || \Cookie::get('refID') !== null){
                        if(\Cookie::get('refID')!== null)
                            $invitation = User::find(\Cookie::get('refID')-11006);
                        else
                            $invitation = User::find(Session::get('refID')-11006);
                        if(isset($invitation))
                            $user->invitationID = $invitation->id;
                    }

                    $user->save();


                    Auth::loginUsingId($user->id);

                    DB::commit();
                    $result = array('status' => true, 'message' => 'اطلاعات شما با موفقیت ثبت شد','redirect'=> route('dashboard'));

                } catch (\Exception $e) {
                    DB::rollback();
                    $result = array('status' => 'false', 'message' => 'عملیات دچار مشکل شد' . $e);
                }


            else:
                $result = array('status' => false, 'message' => $validator->errors()->first());
            endif;
            return response()->json($result);
        }
    }


    function ref(Request $request)
    {
        $user = User::find($request->id - 11006);
        if($user){
            Session::put('refID',$request->id);
            \Cookie::queue('refID', $request->id, 43800);
            return redirect(route('register'));
        }else
            abort(404);
    }




    function reSendSms(Request $request)
    {
        try{
            \Kavenegar::VerifyLookup(Session::get("mobile"), Session::get("verify_code"),null,null,'verify');
            $result = array('status'=> true , 'message'=>  'پیامک با موفقیت ارسال گردید و لطفا کد را درج کنید' );
        }
        catch (\Exception $ex){
            $result = array('status'=> false , 'message'=>  'ارسال پیامک امکان پذیر نیست' );
        }
        return response()->json($result);
    }

}






