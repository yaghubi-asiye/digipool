@extends('user.login.master')
@section('title', 'تغییر رمز')

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
                                    <p class="text-center">رمز عبور جدید خود را با دقت و همراه با اعداد و حروف درج نمایید</p>


                                    <div class="form-group">
                                        <input type="password" class="form-control text-center ltr-dir round" required id="password" placeholder="رمز عبور جدید" name="password"  minlength="6">
                                        <div class="invalid-feedback">
                                            پسورد جدید را درج کنید(حداقل 6 کاراکتر)
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control text-center ltr-dir round" required id="password_confirmation" placeholder="تکرار رمز عبور جدید" name="password_confirmation" minlength="6">
                                        <div class="invalid-feedback">
                                            تکرار پسورد را درج کنید
                                        </div>
                                    </div>


                                    <div class="form-group text-center">
                                        <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1 g-recaptcha"
                                                data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" onclick="ElementBlock($(this))"  id="BtnRegister"
                                                data-callback="onSubmitform">تغییر رمز</button>
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
        $(document).ready(function () {
            "use strict";

            $(document).ready(function () {
                $('form').ajaxForm({
                    beforeSend: function() {

                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                    },
                    complete: function(data) {
                        data = data.responseJSON;
                        if (data.status == true) {
                            Swal.fire({
                                type: 'success',
                                title: "انجام شد",
                                html: data.message,
                                confirmButtonText: "تایید",
                            }).then(function () {
                                if(data.redirect != null){
                                    location.href = (data.redirect);
                                    return false
                                }
                            });
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

        });
    </script>
@stop

