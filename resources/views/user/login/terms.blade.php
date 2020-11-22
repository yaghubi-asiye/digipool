
<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <title>شرایط و قوانین</title>
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
                    <li role="presentation" class="visited"><i class="ft-check-circle" aria-hidden="true"></i>
                        <p>تایید موبایل</p>
                    </li>
                    <li role="presentation" class="active"><i class="ft-user-plus" aria-hidden="true"></i>
                        <p>درج اطلاعات</p>
                    </li>
                    <li role="presentation"><i class="ft-credit-card" aria-hidden="true"></i>
                        <p>حساب بانکی</p>
                    </li>
                </ul>

            </div>
        </section>

        <div class="content-body mb-4">

            <section class="flexbox-container" style="height: auto">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-5 col-md-6 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">

                            <div class="row text-center">
                                <div class="col-md-6 mb-3 text-center">
                                    <img src="{{asset('')}}app-assets/images/sample-1.jpg" width="100%">
                                    <small>نمونه تصویر کارت ملی</small>
                                </div>
                                <div class="col-md-6 mb-3 text-center">
                                    <img src="{{asset('')}}app-assets/images/sample-2.jpg" width="100%">
                                    <small>نمونه تصویر سلفی</small>
                                </div>
                            </div>

                            @if(Session::get('Reason'))
                                <div class=" alert alert-card alert-warning text-center" role="alert">
                                    "{{Session::get('Reason')}}"
                                </div>
                            @endif

                            <ul class="text-justify p-1 text-14">
                                <li>آی آر پی از ارائه خدمات به اشخاص با هویت پنهان معذور است.</li>
                                <li>خدمات وب سایت آی آر پی مستقل از هر گروه و سازمان می باشد و تابع قوانین جمهوری اسلامی ایران می باشد و از هر گونه خدمات به وب سایت های غیرقانونی خودداری می نماید.</li>
                                <li>خرید و یا فروش به سایت قطعی بوده و پس از ثبت و پرداخت سفارش دو طرف ملزم به دریافت و پرداخت وجه با قیمت ثبت شده در سیستم می باشند و پس از پرداخت امکان کنسل کردن سفارش از سوی خریدار میسر نمی باشد مگر با توافق وب سایت.</li>
                                <li>در صورت هرگونه تخلف از سوی کاربر اعم از استفاده از حساب های بانکی هکی ,مشخص نبودن منبع پول,پولشویی … که قصد فریب وب سایت را دارد, سایت حق خود می داند حساب کاربر را معلق و به مراجع ذیصلاح اطلاع دهد.</li>
                                <li>واریز وجه به حساب سایت توسط شخص ثالث طبق قوانین بانک مرکزي ممنوع میباشد، لذا واریز کننده وجه تومانی و درخواست کننده سفارش باید یکسان باشند. معادل تومانی در هنگام واریز وجه به حساب سایت باید از حساب شخص متقاضی (کاربر عضو و احراز شده در سایت) حواله شود و در صورت نقدي بودن وجه واریزي، باید در فیش مربوطه نام واریز کننده، همان نام کاربر احراز شده در سایت باشد. بدیهی است در غیر این صورت به درخواست حواله مذکور ترتیب اثر داده نخواهد شد</li>
                                <li>قرار دادن حساب کاربری خود در اختیار اشخاص دیگر درصورت محرز شدن , موجب اخراج کاربر از سایت می شود و عواقب ناشی این امر بر عهده کاربر می باشد.</li>
                                <li>در صورت ثبت نادرست حساب گیرنده و یا عدم اطمینان از سمت گیرنده , سایت هیچ گونه مسئولیتی را در این راستا نمی پذیرد. پس از اتمام خرید محصول , محل و مکان و زمان و نحوه استفاده از محصول بر عهده کاربر می باشد.</li>
                                <li>قوانین در موارد زیادی و بسته به شرایط و قوانین جمهوری اسلامی ممکن است تغییر کند و وب سایت اطلاع رسانی در موراد تغییر می نماید و کاربر موظف به مطالعه آن ها در زمان خرید می باشد.</li>
                            </ul>

                            <div class="text-center m-auto d-table">
                                <label class="checkbox checkbox-info">
                                    <input type="checkbox" name="checkbox" id="checkbox">
                                    <span>شرایط و قوانین آی آر پی را میپذیرم</span>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-group text-center mt-2">
                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-red col-12">متوجه شدم</button>
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
<script src="{{asset('')}}app-assets/vendors/js/extensions/sweetalert2.all.js" type="text/javascript"></script>


<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{asset('')}}app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/js/core/app.js" type="text/javascript"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->

<script>
    $('button').click(function () {
        if ($('#checkbox').is(':checked')) {
            window.location.replace("{{route('RegisterProfile')}}");
        } else {
            swal({
                type: 'warning',
                title: "خطا",
                html: 'تیک پذیرفتن شرایط را بزنید',
                confirmButtonText: "تایید",
            })
        }
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




</html>