
<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <title>تایید موبایل</title>
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

        <section class="design-process-section" id="process-tab">

            <div class="col-12">
                <!-- design process steps-->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs process-model more-icon-preocess" role="tablist">
                    <li role="presentation" class="visited"><i class="la la-mobile" aria-hidden="true"></i>
                        <p>ثبت موبایل</p>
                    </li>
                    <li role="presentation" class="active"><i class="ft-check-circle" aria-hidden="true"></i>
                        <p>تایید موبایل</p>
                    </li>
                    <li role="presentation"><i class="ft-user-plus" aria-hidden="true"></i>
                        <p>درج اطلاعات</p>
                    </li>
                    <li role="presentation"><i class="ft-credit-card" aria-hidden="true"></i>
                        <p>حساب بانکی</p>
                    </li>
                </ul>

            </div>
        </section>
        <div class="content-body">
            <section class="flexbox-container" style="height: auto">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <div class="text-center mb-1">
                                    <img src="{{asset('')}}app-assets/images/logo/logo.png" alt="irPay logo">
                                </div>
                                <div class="font-large-1  text-center">
                                    احراز هویت موبایل
                                </div>
                            </div>
                            <div class="card-content">

                                <div class="card-body p-0 p-md-2 ">
                                    <form method="POST" autocomplete="off" id="loginform" class="form-horizontal needs-validation" action="{{asset("")}}register/ConfirmMobile" novalidate>
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control round text-center numbers ltr-dir" required autofocus
                                                   id="ConfirmCode" maxlength="5" minlength="5" placeholder="کد پنج رقمی" name="ConfirmCode"/>
                                            <div class="form-control-position">
                                                <i class="ft-unlock"></i>
                                            </div>
                                            <div class="invalid-feedback">
                                                کد پنج رقمی را درج کنید
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative text-center has-icon-left">
                                            <div>
                                                <button type="button" class="btn btn-bg-gradient-x-orange-yellow round btn-sm"
                                                        style="display: none;" id="makingdifferenttimer" onclick="$('#resend').submit()"> ارسال مجدد</button>
                                            </div>
                                            <div id="mdtimer">
                                                <b></b>
                                                <div class="text-17"><b> 00:<span>59</span></b></div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-red col-12 mr-1 mb-1">تایید کد</button>
                                        </div>

                                    </form>
                                </div>
                                <form action="{{asset('')}}register/ReSendSms" method="post" id="resend" disabled="none">
                                    @csrf
                                    <button type="submit" style="display: none"> ارسال مجدد
                                    </button>
                                </form>
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
<script>
    jQuery(document).ready(function () {
        var sec = 58
        var timer = setInterval(function () {
            $("#mdtimer span").text(sec--);
            if (sec == 0) {
                $("#makingdifferenttimer").delay(1000).fadeIn(1000);
                $("#mdtimer").delay(600).fadeOut();
            }
        }, 1000);
    });
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
