<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\functions;
use App\User;
use DB;
use Image;
use PragmaRX\Google2FAQRCode\Google2FA;
use App\CardBank;

class ProfileController extends Controller
{
    function index()
    {
        $ostan = \App\provinces::all();
        if (Auth::user()->id_province) {
            $province = \App\provinces::find(Auth::user()->id_province);
            $cities = $province->cities()->select('id', 'title')->get();
        }
        $data["ostan"] = $ostan;
        $data["city"] = isset($cities) ? $cities : array();
        return view('user.profile.profile',$data);
    }

    function send_otp_finotech(Request $request){
        $validator = \Validator::make($request->all(), [
            'code_meli' => 'required|numeric',
            'FatherName' => 'required',
            'DateBirth' => 'required',
            'phone' => 'required|digits:11|phone',
            'verify_phone' => 'nullable|numeric|digits:4',
        ]);
        if ($validator->fails() != 1 && Auth::user()->code_meli_confirm == 0 || Auth::user()->code_meli_confirm == 3):

            if (!isset($request->verify_phone) || !Session::has('verify_phone')){

                session()->put("phone", $request->phone);
                $randstring = rand(1000, 9999);
                session()->put("verify_phone", $randstring);

                try{
                    \Kavenegar::VerifyLookup($request->phone,$randstring,null,null,'verify');
                    $result = array('status' => true, 'message' => 'تماس با شما در حال برقرای است');
                }
                catch (\Exception $ex){
                    $result = array('status' => false, 'message' => 'امکان برقرای تماس با شماره درج شده نیست');
                }

            }else{


                if ($request->verify_phone == session()->get('verify_phone') && $request->phone == session()->get('phone')) {
                    $user = User::find(Auth::user()->id);
                    $user->code_meli = $request->code_meli;
                    $user->phone = $request->phone;
                    $user->date_birth = $request->DateBirth;
                    $user->father_name = $request->FatherName;
                    $user->code_meli_confirm = 2;

                    $user->save();
                    $result = array('status' => true, 'message' => 'اطلاعات شما با موفقیت ذخیره شد و در انتظار بررسی قرار گرفت!');
                }else
                        $result = array('status' => false, 'message' => 'کد تایید تلفن صحیح نمی باشد','refresh'=>false);

            }
        else:
            $result = array('status' => false, 'message' => $validator->errors()->first(),'refresh'=>false);
        endif;
        return response()->json($result);
    }



    function resend_otp_finotech(Request $request){
        $validator = \Validator::make($request->all(), [
            'code_meli' => 'required|numeric',
        ]);
        if ($validator->fails() != 1 && (isset(Auth::user()->code_meli) || Auth::user()->code_meli == '')):
            try{
                \Kavenegar::VerifyLookup(session()->get('phone'),session()->get('verify_phone'),null,null,'verify');
                $result = array('status' => true, 'message' => 'تماس با شما در حال برقرای است');
            }
            catch (\Exception $ex){
                $result = array('status' => false, 'message' => 'امکان برقرای تماس با شماره درج شده نیست');
            }
        else:
            $result = array('status' => false, 'message' => 'داده های درج شده درست نیست');
        endif;
        return response()->json($result);
    }


    function address()
    {
        $ostan = \App\provinces::all();
        if (Auth::user()->id_province) {
            $province = \App\provinces::find(Auth::user()->id_province);
            $cities = $province->cities()->select('id', 'title')->get();
        }
        $data["ostan"] = $ostan;
        $data["city"] = isset($cities) ? $cities : array();
        return view('user.profile.address',$data);
    }

    function address_ownership(Request $request){
        $functions = new functions;
        $request->phone = $functions->ta_latin_num($request->phone);
        $request->verify_phone = $functions->ta_latin_num($request->verify_phone);

        $validator = \Validator::make($request->all(), [
            'address' => 'required|farsi',
            'ostan' => 'required|numeric',
            'city' => 'required|numeric',
            'phone' => 'required|numeric|phone|digits:11',
            'verify_phone' => 'nullable|numeric|digits:4',
            'code_posti' => 'required|numeric',
        ]);
        if ($validator->fails() != 1 && (Auth::user()->address_confirm == 3 || Auth::user()->address_confirm == 0) ):

            if (!isset($request->verify_phone) || $request->verify_phone==''){
                $randstring = rand(1000, 9999);
                Session::put("verify_phone", $randstring);
                Session::put("phone", $request->phone);

                try{
                    \Kavenegar::VerifyLookup($request->phone,$randstring,null,null,'verify');
                    $result = array('status'=> true , 'message'=> 'تماس با شما در حال برقرای است'.'<br><small>'.'ممکن است کمی تاخیر داشته باشد(حداکثر 2 دقیقه)'.'</small>');
                }
                catch (\Exception $ex){
                    $result = array('status'=> false , 'message'=>  $ex->getMessage() );
                }

            }else{
                if(Session::get("phone") != $request->phone || $request->verify_phone != Session::get("verify_phone")){
                    $result = array('status' => false, 'message' => 'کد تایید تلفن صحیح نمیباشد');
                    return response()->json($result);
                }
                $user = User::find(Auth::user()->id);
                $user->id_province = $request->ostan;
                $user->id_city = $request->city;
                $user->address = $request->address;
                $user->code_posti = $request->code_posti;
                $user->address_confirm = 2;
                $user->phone = $request->phone;
                $user->save();
                $result = array('status' => true, 'message' => 'تمامی اطلاعات با موفقیت ثبت شد و در دست بررسی قرار گرفت!');

            }
        else:
            $result = array('status' => false, 'message' => $validator->errors()->first());
        endif;
        return response()->json($result);
    }


    function national_card(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'img_codemeli' => 'required|mimes:jpg,jpeg,png',
        ]);
        if ($validator->fails() != 1):

            $user = User::find(Auth::user()->id);
            $img_old = $user->card_meli_img;

            $file = $request->file('img_codemeli');
            $extension = $file->getClientOriginalExtension();
            $just_name = str_replace(" ", "-", pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $just_name_hash = str_replace("/", "",bcrypt($just_name  .time().'meli'));
            $name = $just_name_hash.'.'.$extension;

            $Image = Image::make($file);
            if ($Image->width() > 2500) {
                $Image->resize(2500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if ($Image->height() > 3000) {
                $Image->resize(null, 3000, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }


            $directory = 'uploads/Users/'.$user->created_at->year.'/'.$user->created_at->month.'/'. $user->id;
            $file_path = $directory . '/'. $name;
            if (!file_exists(($file_path))) {
                \File::makeDirectory($directory, $mode = 0777, true, true);
                if ($Image->save(($directory . '/'. $name))) {
                    $user->card_meli_img = $directory . '/' .$name;
                }
            } else {
                if ($Image->save(($directory . '/' . $just_name_hash.time() . '.' . $extension))) {
                    $user->card_meli_img = $directory . '/' .$just_name_hash.time() . '.' . $extension;
                }
            }
            $user->card_meli_confirm = 2;
            $user->save();

            if (file_exists(($img_old)))
                unlink($img_old);
            $result = array('status' => true, 'message' => 'تصویر با موفقیت ثبت شد و در انتظار بررسی قرار گرفت');

        else:
            $result = array('status' => false, 'message' => 'داده های درج شده درست نیست');
        endif;
        return response()->json($result);
    }

    function selfi_image(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'img_selfi' => 'required|mimes:jpg,jpeg,png',
        ]);
        if ($validator->fails() != 1):

            $user = User::find(Auth::user()->id);
            $img_old = $user->shenasname_img;

            $file = $request->file('img_selfi');
            $extension = $file->getClientOriginalExtension();
            $just_name = str_replace(" ", "-", pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $just_name_hash = str_replace("/", "",bcrypt($just_name  .time().'selfi'));
            $name = $just_name_hash.'.'.$extension;

            $Image = Image::make($file);
            /*
            if ($Image->width() > 1500) {
                $Image->resize(1500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if ($Image->height() > 2000) {
                $Image->resize(null, 2000, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }*/


            $directory = 'uploads/Users/'.$user->created_at->year.'/'.$user->created_at->month.'/'. $user->id;
            $file_path = $directory . '/'. $name;
            if (!file_exists(($file_path))) {
                \File::makeDirectory($directory, $mode = 0777, true, true);
                if ($Image->save(($directory . '/'. $name))) {
                    $user->shenasname_img = $directory . '/' .$name;
                }
            } else {
                if ($Image->save(($directory . '/' . $just_name_hash.time() . '.' . $extension))) {
                    $user->shenasname_img = $directory . '/' .$just_name_hash.time() . '.' . $extension;
                }
            }
            $user->shenasname_confirm = 2;
            $user->save();

            if (file_exists(($img_old)))
                unlink($img_old);
            $result = array('status' => true, 'message' => 'تصویر با موفقیت ثبت شد و در انتظار بررسی قرار گرفت');

        else:
            $result = array('status' => false, 'message' => 'داده های درج شده درست نیست');
        endif;
        return response()->json($result);
    }

    function edit_password(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'old_password' => 'required|min:6',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        if ($validator->fails() != 1):

            if (\Hash::check($request->input('old_password'), Auth::user()->password)) {
                if($request->password == $request->password_confirmation){
                    $user = User::find(Auth::user()->id);
                    $user->password = bcrypt($request->password);
                    $user->save();
                    auth('')->logout();
                    $result = array('status' => true, 'message' => 'رمز عبور با موفقیت ویرایش شد.');
                }else
                    $result = array('status' => false, 'message' => 'رمز جدید و تکرار با یکدیگر برابر نیستند.');
            }else
                $result = array('status' => false, 'message' => 'رمز فعلی اشتباه است.');

        else:
            $result = array('status' => false, 'message' => 'داده های ارسالی اشتباه است.');
        endif;
        return response()->json($result);

    }

    function twofa()
    {
        $data = array();
        if (Auth::user()->google2fa == null){

            $google2fa = new Google2FA();
            if(session()->has("secret"))
                $secret = session()->get("secret");
            else{
                $secret = $google2fa->generateSecretKey();
                session()->put("secret", $secret);
            }
            $data['goole2fa']['secret'] = $secret;
            $inlineUrl = $google2fa->getQRCodeInline(
                env('APP_NAME'),
                'mobile:'.Auth::user()->mobile,
                $secret
            );
            $data['goole2fa']['inlineUrl'] = $inlineUrl;

        }
        return view('user.profile.profile-2fa',$data);
    }

    function twofa_sms(Request $request)
    {
        if($request->sms==1){
            $user = User::find(Auth::user()->id);
            $user->sms2fa = 1;
            $user->google2fa = null;
            $user->save();
            $result = array('status' => true, 'message' => 'ورود دو مرحله ای از طریق پیامک با موفقیت فعال شد!');
        }
        else{
            $user = User::find(Auth::user()->id);
            $user->sms2fa = 0;
            $user->save();
            $result = array('status' => true, 'message' => 'ورود دو مرحله ای غیر فعال شد!');
        }
        return response()->json($result);
    }

    function twofa_google(Request $request)
    {
        $google2fa = new Google2FA();
        if(isset(Auth::user()->google2fa)){
            $valid = $google2fa->verifyKey(Auth::user()->google2fa, $request->code);
            if($valid==1){
                $user = User::find(Auth::user()->id);
                $user->google2fa = null;
                $user->save();
                $result = array('status' => true, 'message' => 'ورود دو مرحله ای غیر فعال شد!');
            }else{
                $result = array('status' => false, 'message' => 'کد اشتباه است!');
            }
        }
        else{
            $valid = $google2fa->verifyKey(Session::get("secret"), $request->code);
            if($valid==1){
                $user = User::find(Auth::user()->id);
                $user->google2fa = Session::get("secret");
                $user->sms2fa = 0;
                $user->save();
                $result = array('status' => true, 'message' => 'ورود دو مرحله ای از طریق گوگل با موفقیت فعال شد!');
            }else{
                $result = array('status' => false, 'message' => 'کد اشتباه است!');
            }
        }
        return response()->json($result);
    }


    function financialIndex()
    {
        $cards = CardBank::where('id_user',Auth::user()->id)->orderBy('id','desc')->get();
        foreach ($cards as $card){
            $card->card_number = self::formatCreditCard($card->card_number);
        }
        $data['card'] = $cards;

        return view('user.profile.financial',$data);
    }
    function financial(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'bank_name' => 'required',
            'card_number' => 'required|numeric',
            'account_number' => 'nullable|numeric',
            'iban' => 'nullable|numeric',
            'card_image' => 'required|mimes:jpg,jpeg,png',
        ], [
            'bank_name.required' => 'نام بانک را وارد نمایید',
            'name_family.required' => 'نام صاحب حساب را وارد نمایید',
            'card_number.required' => 'شماره کارت را وارد نمایید',
            'account_number.required' => 'شماره حساب را وارد نمایید',
            'iban.required' => 'شناسه شبا را وارد نمایید',
            'card_image.required' => 'تصویر کارت را وارد نمایید'
        ]);

        if ($validator->fails()) {
            $result = array('status' => false, 'message' => $validator->errors()->first());
            return response()->json($result);
        }

        DB::beginTransaction();
        try {
            $bank = new \App\CardBank;
            $bank->id_user = Auth::id();
            $bank->bank_name = $request->bank_name;
            $bank->card_number = $request->card_number;
            $bank->account_number = $request->account_number;
            $bank->shaba = $request->iban;

            $bank->save();


            //save image
            $file = $request->file('card_image');
            $extension = $file->getClientOriginalExtension();
            $just_name = str_replace(" ", "-", pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $just_name_hash = str_replace("/", "",bcrypt($just_name  .time().'meli'));
            $name = $just_name_hash.'.'.$extension;
            $Image = Image::make($file);
            if ($Image->width() > 1000) {
                $Image->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if ($Image->width() > 2000) {
                $Image->resize(null, 2000, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }


            $directory = 'uploads/Users/'.Auth::user()->created_at->year.'/'.Auth::user()->created_at->month.'/'. Auth::user()->id;
            $file_path = $directory.'/CardBank/'.$name;
            if (!file_exists(($file_path))) {
                \File::makeDirectory($directory.'/CardBank/', $mode = 0777, true, true);
                if ($Image->save(($directory.'/CardBank/'. $name))) {
                    $bank->card_image = $directory.'/CardBank/'.$name;
                }
            } else {
                if ($Image->save(($directory.'/CardBank/' . $just_name_hash.time() . '.' . $extension))) {
                    $bank->card_image = $directory.'/CardBank/' . $just_name_hash.time() . '.' . $extension;
                }
            }
            //end save image
            $bank->save();
            DB::commit();

            $result = array('status' => true, 'message' => 'کارت بانکی شما با موفقیت ثبت شد');

        } catch (\Exception $e) {
            DB::rollback();
            $result = array('status' => false, 'message' => 'عملیات دچار مشکل شد' . $e);
        }
        return response()->json($result);
    }


    function FormatCreditCard($cc)
    {
        // Clean out extra data that might be in the cc
        $cc = str_replace(array('-',' '),'',$cc);
        // Get the CC Length
        $cc_length = strlen($cc);
        // Initialize the new credit card to contian the last four digits
        $newCreditCard = substr($cc,-4);
        // Walk backwards through the credit card number and add a dash after every fourth digit
        for($i=$cc_length-5;$i>=0;$i--){
            // If on the fourth character add a dash
            if((($i+1)-$cc_length)%4 == 0){
                $newCreditCard = '-'.$newCreditCard;
            }
            // Add the current character to the new credit card
            $newCreditCard = $cc[$i].$newCreditCard;
        }
        // Return the formatted credit card number
        return $newCreditCard;
    }


    function get_cities(Request $request)
    {
        $province = \App\provinces::find($request->id);
        $cities = $province->cities()->select('id','title as name')->get();
        return response()->json($cities);
    }
}
