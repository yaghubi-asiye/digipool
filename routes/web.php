<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Auth::routes();
Route:: group(['namespace' => 'User'], function () {

    //introduction
    Route::get('ref/{id}', 'RegisterController@ref');

    //login
    Route::get('login', 'LoginController@index')->name('login');
    Route::post('login', 'LoginController@login');

    //Two-Factor Authentication
    Route::get('sms2fa', 'LoginController@sms2faIndex')->name('sms2fa');
    Route::post('sms2fa', 'LoginController@sms2fa');
    Route::post('sms2fa/resend', 'LoginController@sms2faResend')->name('sms2faResend');

    Route::get('google2fa', 'LoginController@google2faIndex')->name('google2fa');
    Route::post('google2fa', 'LoginController@google2fa');


    //forget
    Route::get('ForgetPassword', 'LoginController@ForgetIndex')->name('forget');
    Route::post('ForgetPassword', 'LoginController@Forget');

    Route::get('ForgetPassword/ConfirmPassword', 'LoginController@ConfirmPasswordIndex')->name('ConfirmPassword');
    Route::post('ForgetPassword/ConfirmPassword', 'LoginController@ConfirmPassword');

    Route::post('ForgetPassword/resend', 'LoginController@resendForget')->name('ReSendSmsForget');


    //Register
    Route::get('/register', 'RegisterController@index')->name('register');
    Route::post('/register', 'RegisterController@RegisterMobile');
    Route::post('register/resend', 'RegisterController@reSendSms')->name('ResendSmsRegister');

    Route::get('register/profile', 'RegisterController@ProfileIndex')->name('RegisterProfile');
    Route::post('register/profile', 'RegisterController@Profile');

});





// Route:: group(['namespace' => 'User', 'middleware' => ['auth','access','notification']], function () {
Route:: group(['namespace' => 'User', 'middleware' => ['auth']], function () {

    Route::post('logout', 'LoginController@logout');
    //firebase
        Route::post('token', 'DashboardController@insert_token');
        Route::get('send', 'DashboardController@send');

    //profile
    //profile
        Route::get('profile', 'ProfileController@index');

        Route::get('profile/location', 'ProfileController@address');
        Route::post('profile/address-ownership', 'ProfileController@address_ownership');

        Route::get('profile/identification', function () {return view('user.profile.national-card');});
        Route::post('profile/national-card', 'ProfileController@national_card');

        Route::get('profile/selfie', function () {return view('user.profile.selfe');});
        Route::post('profile/selfi-image', 'ProfileController@selfi_image');
        //Route::post('profile/mobile-ownership', 'ProfileController@send_otp_finotech')->name('mobileOwnership');
        //Route::post('profile/mobile-ownership/resend', 'ProfileController@resend_otp_finotech')->name('ResendFinotech');
        //Route::post('profile/image-fish', 'ProfileController@img_fish');
        //Route::post('profile/national-card', 'ProfileController@national_card');

        Route::post('cities', 'ProfileController@get_cities');

        Route::get('profile/password', function () {
            return view('user.profile.password');
        });
        Route::post('profile/password', 'ProfileController@edit_password');

        Route::get('profile/two-factor-authentication', 'ProfileController@twofa');
        Route::post('profile/two-factor-authentication/sms', 'ProfileController@twofa_sms');
        Route::post('profile/two-factor-authentication/google', 'ProfileController@twofa_google');

        Route::get('profile/financial', 'ProfileController@financialIndex');
        Route::post('profile/financial', 'ProfileController@financial');


    //ticket
        Route::get('ticket', 'TicketController@index');
        Route::post('ticket', 'TicketController@insert');

        Route::get('ticket/{id}', 'TicketController@singleIndex');
        Route::post('ticket/{id}', 'TicketController@single');




    //dashboard
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::post('/dashboard/redirect', 'DashboardController@redirectForm');
        Route::post('/stock', 'DashboardController@check_stock');
        Route::post('/RemoveNotification', 'DashboardController@RemoveNotification');



    /*

    Route::get('mastercard', function () {
        return view('user.others.mastercard-buy');
    });
    Route::get('visacard', function () {
        return view('user.others.mastercard-buy');
    });
   */
});



