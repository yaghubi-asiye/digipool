@extends('user.login.master')
@section('title', 'ورود دو مرحله ای')

@section('content')
    <div class="content-body">
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                        <div class="card-header border-0 pb-0">
                            <div class="text-center">
                                <img src="{{asset('')}}app-assets/images/logo/logo.png" width="30%" alt="{{env('APP_NAME_FARSI')}} logo">
                            </div>
                        </div>
                        <div class="card-content mt-1 mt-md-0">

                            <div class="card-body p-0 p-md-2 ">
                                <form method="POST" autocomplete="off" id="form_mobile" class="form-horizontal needs-validation" action="" novalidate>
                                    @csrf
                                    <p class="text-center">ورود دو مرحله ای از طریق گوگل</p>
                                    <fieldset class="form-group form-group position-relative has-icon-left">
                                        <input type="text" class="form-control round ltr-dir text-center numbers" id="code"
                                               maxlength="6" minlength="6" name="code" placeholder="کد 6 رقمی احراز هویت" required>
                                        <div class="form-control-position">
                                            <i class="ft-hash"></i>
                                        </div>
                                        <div class="invalid-feedback">
                                            کد 5 رقمی را بدرستی درج کنید
                                        </div>
                                    </fieldset>
                                    <p class="text-center">کدی که در اپلیکیشن Google Authenticator مشاهده میکنید را درج کنید</p>

                                    <div class="form-group text-center">
                                        <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-red col-12 mr-1 mb-1">ورود</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@stop

@section('script')

@stop

