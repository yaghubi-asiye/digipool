<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <title>ثبت اطلاعات</title>
    <link rel="apple-touch-icon" href="{{asset('')}}app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('')}}app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
          rel="stylesheet">

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
    <link rel="stylesheet" type="text/css"
          href="{{asset('')}}app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/plugins/extensions/toastr.min.css">
    <!-- END: Page CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page blank-page" data-open="click"
      data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="1-column">
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
                            <div class="card-header border-0">
                                <div class="font-medium-1  text-center">
                                    اطلاعات فردی شما
                                </div>
                            </div>
                            <div class="card-content">

                                <div class="card-body p-0 p-md-2 ">
                                    <form method="POST" autocomplete="off" class="form-horizontal needs-validation"
                                          novalidate action="" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <fieldset class="col-12 col-md-6 form-group">
                                                <input type="text" name="name" class="form-control round text-center "
                                                       placeholder="نام" value="{{isset($user->name)?$user->name:''}}"
                                                       required/>
                                                <div class="invalid-feedback">نام را درج کنید</div>
                                            </fieldset>
                                            <fieldset class="col-12 col-md-6 form-group">
                                                <input type="text" name="family" class="form-control round text-center "
                                                       placeholder="نام خانوادگی"
                                                       value="{{isset($user->family)?$user->family:''}}"
                                                       required/>
                                                <div class="invalid-feedback">فامیل را درج کنید</div>
                                            </fieldset>
                                        </div>
                                        <fieldset class="form-group">
                                            <input type="email" name="email"
                                                   class="form-control round text-center ltr-dir"
                                                   placeholder="ایمیل" value="{{isset($user->email)?$user->email:''}}"
                                                   required/>
                                            <div class="invalid-feedback">ایمیل را بدرستی درج کنید</div>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="text" name="codemeli"
                                                   class="form-control round numbers text-center ltr-dir"
                                                   value="{{isset($user->code_meli)?$user->code_meli:''}}"
                                                   maxlength="11" minlength="9" placeholder="کد ملی" required/>
                                            <div class="invalid-feedback">کد ملی را بدرستی درج کنید</div>
                                        </fieldset>

                                        <fieldset class="form-group">
                                            <input type="password" name="password" id="password"
                                                   class="form-control round text-center ltr-dir"
                                                   placeholder="کلمه عبور" minlength="6" required/>
                                            <div class="invalid-feedback">کلمه عبور را بیش از 6 کاراکتر درج کنید</div>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="password" name="retype_password" id="retype_password"
                                                   class="form-control round text-center ltr-dir"
                                                   placeholder="تکرار کلمه عبور" minlength="6" required/>
                                            <div class="invalid-feedback">کلمه عبور را بیش از 6 کاراکتر درج کنید</div>
                                        </fieldset>
                                        <div class="row">
                                            <fieldset class="col-12 col-md-6 form-group">
                                                <a href="{{asset('')}}app-assets/images/sample-1.jpg" target="_blank">
                                                    <img src="{{asset('')}}app-assets/images/sample-1.jpg?"
                                                         class="w-100 round">
                                                </a>
                                                <div class="upload-demo">
                                                    <div class="title mb-1 text-left">تصویر کارت ملی
                                                        <br>
                                                        <small>(باید با کیفیت و واضح باشد)</small>
                                                    </div>
                                                    <div class="custom-file round">
                                                        <input type="file" id="img_codemeli" name="img_codemeli"
                                                               class="custom-file-input" accept="image/*" required/>
                                                        <label class="custom-file-label" for="img_codemeli">انتخاب
                                                            فایل</label>
                                                        <div class="invalid-feedback">تصویر کارت ملی را درج
                                                            کنید(jpg,png)
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="col-12 col-md-6 form-group">
                                                <a href="{{asset('')}}app-assets/images/sample-2.jpg" target="_blank">
                                                    <img src="{{asset('')}}app-assets/images/sample-2.jpg?"
                                                         class="w-100 round">
                                                </a>
                                                <div class="upload-demo">
                                                    <div class="title mb-1 text-left">ارسال سلفی با در دست داشتن کاغذ
                                                        <br>
                                                        <small>(آدرس سایت، شماره همراه، کد ملی، تاریخ)</small>
                                                    </div>
                                                    <div class="custom-file round">
                                                        <input type="file" id="img_shenasname" name="img_shenasname"
                                                               class="custom-file-input" accept="image/*" required>
                                                        <label class="custom-file-label" for="img_shenasname">انتخاب
                                                            فایل</label>

                                                        <div class="invalid-feedback">تصویر شناسنامه را درج
                                                            کنید(jpg,png)
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="d-flex mb-1 p-0">
                                            <input type="text" name="phone" id="phone"
                                                   value="{{isset($user->phone)?$user->phone:''}}"
                                                   class="form-control numbers text-center round ltr-dir mr-1 w-75"
                                                   placeholder="تلفن 02123456789" maxlength="11" minlength="11"
                                                   required/>
                                            <button type="button"
                                                    class="btn btn-bg-gradient-x-orange-yellow round w-25 calling p-0"
                                                    onclick="verify_tell()"><span>تایید تلفن </span></button>
                                        </div>

                                        <fieldset class="verify_phone" style="display: none">
                                            <input type="text" name="verify_phone" id="verify_phone"
                                                   class="form-control numbers round text-center mb-1 ltr-dir"
                                                   placeholder="کد پنج رقمی تماس" maxlength="5" minlength="5" required/>
                                        </fieldset>

                                        <div class="box_address w-100">
                                            <div class="row">
                                                <fieldset class="col-12 col-md-6 form-group">
                                                    <select class="text-center ostan form-control round" name="ostan"
                                                            id="Province" required>
                                                        <option value='' disabled selected>استان را انتخاب کنید</option>
                                                        @foreach($ostan as $ostan)
                                                            <option value='{{$ostan->id}}'>{{$ostan->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">استان خود را انتخاب کنید</div>
                                                </fieldset>
                                                <fieldset class="col-12 col-md-6 form-group">
                                                    <select class="text-center city form-control round"
                                                            name="city" id="city" required>
                                                    </select>
                                                    <div class="invalid-feedback">شهر خود را انتخاب کنید</div>
                                                </fieldset>
                                            </div>
                                            <fieldset class="form-group">
                                                <input type="text" name="address"
                                                       value="{{isset($user->address)?$user->address:''}}"
                                                       class="form-control text-center round" placeholder="آدرس" required/>
                                                <div class="invalid-feedback">آدرس را بدرستی درج کنید</div>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <input type="text" name="codeposti"
                                                       value="{{isset($user->code_posti)?$user->code_posti:''}}"
                                                       class="form-control text-center ltr-dir round"
                                                       placeholder="کد پستی" minlength="9" required/>
                                                <div class="invalid-feedback">کد پستی را بدرستی درج کنید</div>
                                            </fieldset>


                                        </div>

                                        <div class="progress mt-2 mb-0 w-100" style="display: none">
                                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated"
                                                 role="progressbar"
                                                 aria-valuemax="100" style="width:0%">
                                                0%
                                            </div>
                                        </div>
                                        <div class="w-100 text-center wait mb-2" style="display: none">
                                            <small>نسبت به حجم تصاویر آپلودی، ممکن است تا چند دقیقه فراید ثبت نام طول
                                                بکشد و لطفا شکیبا باشید!
                                            </small>
                                        </div>


                                        <div class="form-group text-center">
                                            <button type="submit"
                                                    class="btn round btn-block btn-glow btn-bg-gradient-x-purple-red col-12 mr-1 mb-1">
                                                ثبت نام
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>
</div>
<!-- END: Content-->

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">شرایط و قوانین</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="text-justify p-2 text-14">
                    <li>آی آر پی از ارائه خدمات به اشخاص با هویت پنهان معذور است.</li>
                    <li>خدمات وب سایت آی آر پی مستقل از هر گروه و سازمان می باشد و تابع قوانین جمهوری اسلامی ایران می
                        باشد و از هر گونه خدمات به وب سایت های غیرقانونی خودداری می نماید.
                    </li>
                    <li>خرید و یا فروش به سایت قطعی بوده و پس از ثبت و پرداخت سفارش دو طرف ملزم به دریافت و پرداخت وجه
                        با قیمت ثبت شده در سیستم می باشند و پس از پرداخت امکان کنسل کردن سفارش از سوی خریدار میسر نمی
                        باشد مگر با توافق وب سایت.
                    </li>
                    <li>در صورت هرگونه تخلف از سوی کاربر اعم از استفاده از حساب های بانکی هکی ,مشخص نبودن منبع
                        پول,پولشویی … که قصد فریب وب سایت را دارد, سایت حق خود می داند حساب کاربر را معلق و به مراجع
                        ذیصلاح اطلاع دهد.
                    </li>
                    <li>واریز وجه به حساب سایت توسط شخص ثالث طبق قوانین بانک مرکزي ممنوع میباشد، لذا واریز کننده وجه
                        تومانی و درخواست کننده سفارش باید یکسان باشند. معادل تومانی در هنگام واریز وجه به حساب سایت باید
                        از حساب شخص متقاضی (کاربر عضو و احراز شده در سایت) حواله شود و در صورت نقدي بودن وجه واریزي،
                        باید در فیش مربوطه نام واریز کننده، همان نام کاربر احراز شده در سایت باشد. بدیهی است در غیر این
                        صورت به درخواست حواله مذکور ترتیب اثر داده نخواهد شد
                    </li>
                    <li>قرار دادن حساب کاربری خود در اختیار اشخاص دیگر درصورت محرز شدن , موجب اخراج کاربر از سایت می شود
                        و عواقب ناشی این امر بر عهده کاربر می باشد.
                    </li>
                    <li>در صورت ثبت نادرست حساب گیرنده و یا عدم اطمینان از سمت گیرنده , سایت هیچ گونه مسئولیتی را در این
                        راستا نمی پذیرد. پس از اتمام خرید محصول , محل و مکان و زمان و نحوه استفاده از محصول بر عهده
                        کاربر می باشد.
                    </li>
                    <li>قوانین در موارد زیادی و بسته به شرایط و قوانین جمهوری اسلامی ممکن است تغییر کند و وب سایت اطلاع
                        رسانی در موراد تغییر می نماید و کاربر موظف به مطالعه آن ها در زمان خرید می باشد.
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">شرایط را میپذیرم</button>
            </div>
        </div>
    </div>
</div>


<!-- BEGIN: Vendor JS-->
<script src="{{asset('')}}app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('')}}app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/jquery.form.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/extensions/sweetalert2.all.js" type="text/javascript"></script>

<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{asset('')}}app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/js/core/app.js?v=1.0.0" type="text/javascript"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<script>
    $(document).ready(function () {
        'use strict';
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    if ($('#phone:valid').length == 1 && ($('#verify_phone:invalid') || $('#verify_phone').val() == '')) {
                        toastr.warning("باید تلفن خود را تایید کنید", "نکته!", {
                            positionClass: "toast-bottom-right",
                            progressBar: !0,
                        })
                    }

                }

                form.classList.add('was-validated');
            }, false);
        });
    });

    setTimeout(function () {
        $('#exampleModal').modal('show');
    }, 1000)

    $(".dropify").change(function () {

        if ($(this).is(":valid")) {
            $(this).parent().next().css('display', 'none');
            $(this).parent().css('border-color', '#E5E5E5');
        }
    });


    /*
    $('#checkbox').on("ifChanged",function () {
        if ($(this).is(':checked')) {
            $('.box_address').slideDown();
            $('.box_address input,.box_address select').removeAttr('disabled');
            $('.box_address input,.box_address select').attr('required', 'required');
        } else {
            $('.box_address').slideUp();
            $('.box_address input,.box_address select').attr('disabled', 'disabled');
            $('.box_address input,.box_address select').removeAttr('required');
        }
    });
     */

    $(".ostan").on("change", function () {
        if ($("#Province").find(":selected").val() != '') {
            var id = $("#Province").find(":selected").val();
            $.post("<?=asset('');?>cities",
                {
                    id: id,
                    _token: "{{ csrf_token() }}",
                },
                function (data) {
                    $("#city").html('<option value="" disabled selected hidden>شهر را انتخاب کنید</option>');
                    $.each(data, function (k, v) {
                        $("#city").append(new Option(v.name, v.id));
                    });
                });
        } else
            $("#City").html('');
    });


    $(document).ready(function () {
        // bind 'myForm' and provide a simple callback function
        var bar = $('.progress-bar');
        var percent = $('.progress-bar');

        $('form').ajaxForm({
            beforeSend: function (xhr, opts) {

                if ($('#phone').val().substr(0, 2) >= 9) {
                    swal({
                        type: 'error',
                        title: "خطا",
                        html: 'تلفن را بدرستی درج کنید',
                        confirmButtonText: "تایید",
                    })
                    xhr.abort();
                    return false;
                }

                if ($('#password').val() != $('#retype_password').val()) {
                    swal({
                        type: 'error',
                        title: "خطا",
                        html: 'پسورد های درج شده یکسان نیستند',
                        confirmButtonText: "تایید",
                    })
                    xhr.abort();
                    return false;
                }

                $('.box-button').attr('disabled', 'disabled');
                $('form').addClass('disable-block');

                $('.progress').fadeIn();
                $('.wait').fadeIn();
                var percentVal = '0%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var percentVal = percentComplete - 5 + '%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            complete: function (data) {

                data = data.responseJSON;
                $('form').removeClass('disable-block');
                if (data.status == true) {
                    window.location.replace("{{route('cardbank')}}");
                } else {
                    swal({
                        type: 'error',
                        title: "خطا",
                        html: data.message,
                        confirmButtonText: "تایید",
                    });
                    $('.progress').fadeOut();
                    $('.wait').fadeOut();
                }
                $('.box-button').removeAttr('disabled');
            }
        });
    });

    function verify_tell() {
        if ($('#phone').val() == '' || $('#phone').val().substr(0, 2) >= 9 || $('#phone').val().length != 11) {
            swal({
                type: 'error',
                title: "خطا",
                html: 'تلفن را بدرستی درج کنید',
                confirmButtonText: "تایید",
            });
        } else {
            $(".calling span").html('<span class="spinner-grow" role="status"></span><span class="font-small-1"> در حال تماس</span>');
            $(".calling").attr('disabled', 'disabled');
            $('#phone').attr('readonly', 'readonly');

            $.post("{{asset('')}}register/phone",
                {
                    _token: "{{ csrf_token() }}",
                    phone: $('#phone').val()
                },
                function (data) {
                    if (data.status == true) {

                        $('#phone').attr('readonly', 'readonly');
                        $('.verify_phone').slideDown();

                        $(".calling span").html(100);
                        $(".calling").attr('disabled', 'disabled');

                        var sec = 99;
                        var timer = setInterval(function () {
                            $(".calling span").text(sec--);
                            if (sec == 0) {
                                $(".calling span").html('ارسال مجدد');
                                $(".calling").removeAttr('disabled');
                                $('#phone').removeAttr('readonly');
                                clearInterval(timer);
                            }
                        }, 1000);

                        toastr.success(data.message, "انجام شد!", {
                            positionClass: "toast-bottom-center",
                            progressBar: !0,
                        })

                    } else {
                        $(".calling span").html('ارسال مجدد');
                        $(".calling").removeAttr('disabled');
                        $('#phone').removeAttr('readonly');
                        $('.verify_phone').slideUp();
                        clearInterval(timer);
                        swal("خطا", data.message, "error");
                    }
                });

        }
    }

    $('.ostan').val("{{isset($user->id_province)?$user->id_province:''}}");
    $('.ostan').change();
    setTimeout(function () {
        $('#city').val("{{isset($user->id_city)?$user->id_city:''}}");
    }, 2000);
</script>
@if(Session::has('Success'))
    <script>
        toastr.success("{{ Session::get('Success') }}", "انجام شد!", {
            positionClass: "toast-top-center",
            progressBar: !0,
            timeOut: 6000, closeButton: !0
        })
    </script>
@endif
@if(Session::has('Error'))
    <script>
        toastr.error("{{ Session::get('Error') }}", "خطا!", {
            positionClass: "toast-top-center",
            progressBar: !0,
            timeOut: 10000, closeButton: !0
        })
    </script>
@endif
@if(Session::has('Info'))
    <script>
        toastr.info("{{ Session::get('Info') }}", "در دست بررسی!", {
            positionClass: "toast-top-center",
            opacity: 1,
            progressBar: !0,
            timeOut: 6000, closeButton: !0
        })
    </script>
@endif
<!-- END: Page JS-->

</body>
<!-- END: Body-->
</html>
