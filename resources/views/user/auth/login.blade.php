@extends('user.login.master')
@section('title', 'ورود')

@section('content')
    <div id="particles-js" style="position: absolute;width: 100%;height: 100vh"></div>
    <div class="content-body" >
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                    @if(Session::has('Error'))
                        <div class="alert alert-card alert-danger alert-dismissible w-100" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ Session::get('Error') }}
                        </div>
                    @endif

                    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                        <div class="card-header border-0 pb-0">
                            <div class="text-center">
                                <img src="{{asset('')}}app-assets/images/logo/logo.png" width="30%" alt="{{env('APP_NAME_FARSI')}} logo">
                            </div>
                        </div>
                        <div class="card-content mt-1 mt-md-0">
                            <div class="card-body p-0 p-md-2 ">
                                <p class="mb-1 text-center font-small-2">شماره موبایل و رمز عبور خود را درج کنید</p>
                                <form method="POST" autocomplete="off" id="loginform"
                                      class="form-horizontal needs-validation" action="" novalidate>
                                    @csrf

                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control round text-center numbers ltr-dir"
                                               required="required"
                                               name="mobile" id="mobile" placeholder="09123456789"
                                               maxlength="11" minlength="11"/>
                                        <div class="form-control-position">
                                            <i class="ft-user"></i>
                                        </div>
                                        <div class="invalid-feedback">
                                            شماره موبایل را بدرستی درج کنید
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control round text-center ltr-dir"
                                               id="Password"
                                               placeholder="رمز عبور" minlength="6" name="password" required="required">
                                        <div class="form-control-position">
                                            <i class="ft-lock"></i>
                                        </div>
                                        <div class="invalid-feedback">
                                            رمز عبور را درج کنید(حداقل 6 کاراکتر)
                                        </div>
                                    </fieldset>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-12 text-center text-sm-left">
                                            <fieldset>
                                                <input type="checkbox" id="remember" name="remember"
                                                       class="chk-remember" {{ old('remember') ? 'checked' : ''}}>
                                                <label for="remember"> مرا بخاطر بسپار</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a
                                                    href="{{route("forget")}}" class="card-link">رمز عبور را فراموش
                                                کردید؟</a></div>
                                    </div>
                                    <div class="form-group text-center">
                                    <!-- g-recaptcha -->
                                        <button type="submit"
                                                class="btn round btn-block btn-glow btn-dark col-12 mr-1 mb-1 g-recaptcha"
                                                data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" onclick="ElementBlock($(this))" id="BtnRegister"
                                                 
                                                data-callback="onSubmitloginform">ورود
                                        </button>
                                    </div> 

                                </form>
                            </div>

                            <p class="text-center card-subtitle text-muted text-right font-small-3"><span>حساب کاربری ندارید؟ <a
                                            href="{{route("register")}}" class="card-link">ثبت نام</a></span></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@stop

@section('script')
    <script>
        particlesJS.load('particles-js', '{{asset('')}}app-assets/vendors/particles.json', function() {
            console.log('callback - particles.js config loaded');
        });

        function onSubmitloginform() {
            if ($("#mobile:invalid").length == 1 | $("#Password:invalid").length == 1){
                ElementUnBlock('form button');
                $('form').addClass('was-validated');
            }
            else
                $('form').submit();
        }
    </script>
@stop