<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <title>ورود</title>
    <link rel="apple-touch-icon" href="{{asset('')}}app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('')}}app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/extensions/toastr.css">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/colors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/custom-rtl.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/plugins/extensions/toastr.min.css">
    <!-- END: Page CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="1-column">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <div class="text-center mb-1">
                                    <img src="{{asset('')}}app-assets/images/logo/logo.png" alt="irPay">
                                </div>
                                <div class="font-large-1  text-center">
                                    ورود اعضا
                                </div>
                            </div>
                            <div class="card-content">

                                <div class="card-body p-0 p-md-2 ">
                                    <form method="POST" autocomplete="off" id="loginform" class="form-horizontal needs-validation" action="" novalidate>
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control round text-center numbers ltr-dir" required="required"
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
                                            <input type="password" class="form-control round text-center ltr-dir" id="Password"
                                                   placeholder="رمز عبور" minlength="6" name="Password" required="required">
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
                                                    <input type="checkbox" id="remember" name="remember" class="chk-remember" {{ old('remember') ? 'checked' : ''}}>
                                                    <label for="remember"> مرا بخاطر بسپار</label>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="{{route("forget")}}" class="card-link">رمز عبور را فراموش کردید؟</a></div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-red col-12 mr-1 mb-1 g-recaptcha"
                                                    data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"
                                                    data-callback="onSubmitloginform">ورود</button>
                                        </div>

                                    </form>
                                </div>

                                <p class="text-center card-subtitle text-muted text-right font-small-3 mx-2 my-1"><span>حساب کاربری ندارید؟ <a href="{{route("register")}}" class="card-link">ثبت نام</a></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('')}}app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('')}}app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>

<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{asset('')}}app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/js/core/app.js" type="text/javascript"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
{!! NoCaptcha::renderJs() !!}

<script>
    function onSubmitloginform(){
        if($("#mobile:invalid").length==1 | $("#Password:invalid").length==1)
            $('form').addClass('was-validated');
        else
            $('form').submit();
    }
</script>
@if(Session::has('Success'))
    <script>
        toastr.success("{{ Session::get('Success') }}", "انجام شد!", {
            positionClass: "toast-top-center",
            progressBar: !0,
            timeOut:6000,closeButton:!0
        })
    </script>
@endif
@if(Session::has('Error'))
    <script>
        toastr.error("{{ Session::get('Error') }}", "خطا!", {
            positionClass: "toast-top-center",
            progressBar: !0,
            timeOut:10000,closeButton:!0
        })
    </script>
@endif
@if(Session::has('Info'))
    <script>
        toastr.info("{{ Session::get('Info') }}", "در دست بررسی!", {
            positionClass: "toast-top-center",
            opacity:1,
            progressBar: !0,
            timeOut:6000,closeButton:!0
        })
    </script>
@endif
<!-- END: Page JS-->

</body>
<!-- END: Body-->
</html>