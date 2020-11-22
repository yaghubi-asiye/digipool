
<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <title>فراموشی رمز عبور</title>
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
        <div class="content-body mt-5 mb-5">
            <section class="flexbox-container" style="height: auto">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <div class="text-center mb-1">
                                    <img src="{{asset('')}}app-assets/images/logo/logo.png" alt="irPay logo">
                                </div>
                                <div class="font-large-1  text-center">
                                   فراموشی رمز عبور
                                </div>
                            </div>
                            <div class="card-content">

                                <div class="card-body p-0 p-md-2 ">
                                    <form method="POST" autocomplete="off" id="form_mobile" class="form-horizontal needs-validation" action="" novalidate>
                                        @csrf
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


                                        <div class="text-center mb-2 box_code" style="display: none;">

                                            <div class="form-group">
                                                <input type="text" class="form-control text-center round numbers ltr-dir" id="code" placeholder="کد پنج رقمی" name="code" maxlength="5" minlength="5">
                                                <div class="invalid-feedback">
                                                    کد را بدرستی درج کنید
                                                </div>
                                            </div>

                                            <div>
                                                <a class="btn btn-bg-gradient-x-orange-yellow round btn-sm" id="makingdifferenttimer"
                                                   style="display: none;" onclick="resend()"> ارسال مجدد
                                                </a>
                                            </div>

                                            <div id="mdtimer" class="mt-3">
                                                <b></b>
                                                <div class="text-17"><b> 00:<span>59</span></b></div>
                                            </div>
                                        </div>


                                        <div class="form-group text-center">
                                            <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-red col-12 mr-1 mb-1">ارسال کد فعالسازی</button>
                                        </div>

                                    </form>
                                </div>

                                <p class="text-center card-subtitle text-muted text-right font-small-3 mx-2 my-1"><span>قبلا ثبت نام کرده اید؟ <a href="{{route('login')}}" class="card-link">ورود</a></span></p>
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
<script src="{{asset('')}}app-assets/vendors/js/jquery.form.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/extensions/sweetalert2.all.js" type="text/javascript"></script>

<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{asset('')}}app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/js/core/app.js" type="text/javascript"></script>
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
                }

                form.classList.add('was-validated');
            }, false);
        });
    });

    $(document).ready(function () {


        $('#form_mobile').ajaxForm({
            beforeSend: function() {
                $('form button').html('<span class="spinner-grow" role="status"></span> لطفا صبر کنید');
            },
            uploadProgress: function(event, position, total, percentComplete) {
            },
            complete: function(data) {
                data = data.responseJSON;
                if (data.status == true) {
                    swal({
                        type: 'success',
                        title: "انجام شد",
                        html: data.message,
                        confirmButtonText: "تایید",
                    }).then(function () {

                        $('.box_code').slideDown();
                        $('#mobile').attr('readonly','readonly');
                        $('#code').attr('required','required');
                        $('form button').html('تایید کد');
                        var sec = 58;
                        var timer = setInterval(function () {
                            $("#mdtimer span").text(sec--);
                            if (sec == 0) {
                                $("#makingdifferenttimer").delay(1000).fadeIn(1000);
                                $("#mdtimer").delay(600).fadeOut();
                                clearInterval(timer);
                            }
                        }, 1000);

                        $('form').attr('action','{{route("ChcekCodeForget")}}');
                        $('form').attr('id','form_code');
                        form_code();

                    });
                } else {
                    swal({
                        type: 'error',
                        title: "خطا",
                        html: data.message,
                        confirmButtonText: "تایید",
                    })
                    $('form button').html('ارسال کد فعال سازی');

                }
            }
        });


        function form_code(){
            $('#form_code').ajaxForm({
                beforeSend: function() {
                    $('form button').html('<span class="spinner-grow" role="status"></span> لطفا صبر کنید');
                },
                uploadProgress: function(event, position, total, percentComplete) {
                },
                complete: function(data) {
                    data = data.responseJSON;
                    if (data.status == true) {
                        location.href = "{{route('ConfirmPassword')}}";
                    } else {
                        swal({
                            type: 'error',
                            title: "خطا",
                            html: data.message,
                            confirmButtonText: "تایید",
                        })
                        $('form button').html('تایید کد');

                    }
                }
            });
        }
    });

    function resend() {
        $("#makingdifferenttimer").html('<span class="spinner-grow" role="status"></span> لطفا صبر کنید');
        $("#makingdifferenttimer").attr('onclick','');
        $(".box-button").attr('disabled','disabled');
        $.post("{{route("ReSendSmsForget")}}",
            {
                _token: "{{ csrf_token() }}"
            },
            function(data){
                if(data.status == true){
                    toastr.success(data.message, "انجام شد!", {
                        positionClass: "toast-bottom-center",
                        progressBar: !0,
                    })

                    $("#makingdifferenttimer").delay(600).fadeOut();
                    $("#mdtimer").delay(1000).fadeIn();
                    $("#mdtimer span").text('59');
                    $(".box-button").removeAttr('disabled');
                    var sec = 58
                    var timer = setInterval(function () {
                        $("#mdtimer span").text(sec--);
                        if (sec == 0) {
                            $("#makingdifferenttimer").html('ارسال مجدد');
                            $("#makingdifferenttimer").attr('onclick','resend()');
                            $("#makingdifferenttimer").delay(1000).fadeIn(1000);
                            $("#mdtimer").delay(600).fadeOut();
                            clearInterval(timer);
                        }
                    }, 1000);


                }
                else{
                    $("#makingdifferenttimer").html('ارسال مجدد');
                    $("#makingdifferenttimer").attr('onclick','resend()');
                    $(".box-button").removeAttr('disabled');
                    swal("خطا",   data.message  , "error");
                }
            });
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

