@extends('user.login.master')
@section('title', 'فراموشی رمز عبور')

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
                                <form method="POST" autocomplete="off" class="form-horizontal needs-validation" action="" novalidate>
                                    @csrf
                                    <p class="text-center">جهت بازیابی رمز موبایل خود را درج کنید</p>

                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control round text-center numbers ltr-dir" required
                                               id="username" placeholder=" شماره همراه 09123456789" name="mobile" maxlength="11" minlength="11"/>
                                        <div class="form-control-position">
                                            <i class="ft-user"></i>
                                        </div>
                                        <div class="invalid-feedback">
                                            شماره موبایل را بدرستی درج کنید
                                        </div>
                                    </fieldset>


                                    <div class="box_code text-center mb-1" style="display:none ;">
                                        <fieldset class="form-group form-group position-relative has-icon-left">
                                            <input type="text" class="form-control round ltr-dir text-center numbers" id="code"
                                                   maxlength="5" minlength="5" name="code" placeholder="کد 5 رقمی احراز هویت" >
                                            <div class="form-control-position">
                                                <i class="ft-hash"></i>
                                            </div>
                                            <div class="invalid-feedback">
                                                کد 5 رقمی را بدرستی درج کنید
                                            </div>
                                        </fieldset>

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
                                        <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1 g-recaptcha"
                                                id="BtnRegister" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"  onclick="ElementBlock($(this))"
                                                data-callback="onSubmitform">ارسال کد فعالسازی</button>
                                    </div>

                                </form>
                            </div>

                            <p class="text-center card-subtitle text-muted text-right font-small-3"><span>قبلا ثبت نام کرده اید؟ <a href="{{route('login')}}" class="card-link">ورود</a></span></p>
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
        $(document).ready(function () {
            $('form').ajaxForm({
                beforeSend: function() {

                },
                uploadProgress: function(event, position, total, percentComplete) {
                },
                complete: function(data) {
                    data = data.responseJSON;
                    if (data.status == true) {
                        if(data.redirect != null){
                            location.href = (data.redirect);
                            return false
                        }
                        Swal.fire({
                            type: 'success',
                            title: "انجام شد",
                            html: data.message,
                            confirmButtonText: "تایید",
                        }).then(function () {
                        });
                        $('.box_code').slideDown();
                        $('#mobile').attr('readonly','readonly');
                        $('#code').attr('required','required');
                        $('form button').html('تایید کد');
                        timerResend()

                    } else {
                        Swal.fire({
                            type: 'error',
                            title: "خطا",
                            html: data.message,
                            confirmButtonText: "تایید",
                        })
                    }
                    ElementUnBlock('#BtnRegister');
                }
            });


        });

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
