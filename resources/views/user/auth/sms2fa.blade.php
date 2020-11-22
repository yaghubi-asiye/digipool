@extends('user.login.master')
@section('title', 'ورود دو مرحله ای')

@section('content')
    <div class="content-body">
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                    @if(Session::has('Error'))
                        <div class="alert alert-card alert-danger w-100" role="alert">
                            {{ Session::get('Error') }}
                        </div>
                    @endif
                    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                        <div class="card-header border-0">
                            <div class="text-center mb-1">
                                <img src="{{asset('')}}app-assets/images/logo/logo.png" width="30%" alt="{{env('APP_NAME_FARSI')}} logo">
                            </div>
                        </div>
                        <div class="card-content mt-1 mt-md-0">

                            <div class="card-body p-0 p-md-2 ">
                                <form method="POST" autocomplete="off" id="form_mobile" class="form-horizontal needs-validation" action="" novalidate>
                                    @csrf
                                    <p class="text-center"> ورود دو مرحله ای از طریق پیامک</p>
                                    <fieldset class="form-group form-group position-relative has-icon-left">
                                        <input type="text" class="form-control round ltr-dir text-center numbers" id="code"
                                               maxlength="5" minlength="5" name="code" placeholder="کد 5 رقمی احراز هویت" required>
                                        <div class="form-control-position">
                                            <i class="ft-hash"></i>
                                        </div>
                                        <div class="invalid-feedback">
                                            کد 5 رقمی را بدرستی درج کنید
                                        </div>
                                    </fieldset>

                                    <div class="box_code text-center mb-1" >
                                        <div>
                                            <a class="text-info text-17" id="makingdifferenttimer"
                                               style="display: none;" onclick="resend()"><i class="ft-navigation"></i> ارسال مجدد
                                            </a>
                                        </div>

                                        <div id="mdtimer" class="">
                                            <b></b>
                                            <div class="text-17"><b><span>59</span></b></div>
                                        </div>
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 g-recaptcha" id="BtnRegister"
                                                data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" onclick="ElementBlock($(this))"
                                                data-callback="onSubmitform">ورود</button>
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
    <script>
        function onSubmitform() {
            if ($("form:invalid").length == 1){
                $('form').addClass('was-validated');
                ElementUnBlock('form button');
            }
            else
                $('form').submit();
        }

        timerResend();

        function resend() {
            ElementBlock('#makingdifferenttimer');
            $.post("{{Route('ReSendSmsForget')}}",{_token: "{{csrf_token()}}"},
                function(data){
                    if(data.status == true){
                        toastr.success(data.message, "انجام شد!", {
                            positionClass: "toast-bottom-center",
                            progressBar: !0,
                        });

                    }else{
                        toastr.error(data.message, "خطا!", {
                            positionClass: "toast-bottom-center",
                            progressBar: !0,
                        })
                    }
                    timerResend();
                    ElementUnBlock('#makingdifferenttimer');
                });
        }
    </script>
@stop

