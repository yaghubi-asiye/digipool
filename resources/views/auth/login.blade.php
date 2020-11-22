<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>پنل ورود</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="apple-touch-icon" href="{{asset('')}}app-assets/images/icon.png">
    <link rel="icon" href="{{asset('')}}app-assets/images/icon.png">
    <link rel="stylesheet" href="{{asset('')}}assets/styles/css/themes/lite-purple.min.css?2">

    <!-- Custom styles for this template -->
    <link href="{{asset('')}}assets/login/login_files/styles.css" rel="stylesheet">

</head>

<body class="bg-hardlight">


<!-- Navigation -->
<nav class="container-fluid bg-white">
    <div class="row justify-content-center">
        <div class="p-4 text-center">
            <a href="https://irpay.in/">
                <img src="{{asset('')}}assets/login/login_files/logo-dark.png" width="100px"> </a>
        </div>
    </div>
</nav>

<div class="container-fluid">


    <!-- Page Heading/Breadcrumbs -->
    <h1 class="pt-md-5 pt-3 mb-3 mb-md-5 text-center text-17">پنل ورود</h1>

    <!-- Page Box -->
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-9 col-sm-9 col-11 box-container bg-white p-md-5 p-3 position-relative">
            <div class="content">


                <form method="POST" autocomplete="off" id="loginform" class="form-horizontal needs-validation" action="" novalidate>
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control text-center numbers ltr-dir" required="required"
                               class="new_input mobile justnumber" name="Username" placeholder="09123456789"
                               maxlength="11" minlength="11"/>
                        <div class="invalid-feedback">
                            شماره موبایل را بدرستی درج کنید
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control text-center ltr-dir" id="password"
                               placeholder="رمز عبور" name="Password" required="required">
                        <div class="invalid-feedback">
                            رمز عبور را درج کنید
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group form-check col-md-6 mt-4 d-none d-md-block">
                            <label class="checkbox checkbox-info">
                                <input type="checkbox" checked="" id="remember" name="remember">
                                <span>مرا به خاطر بسپار</span>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-group form-check col-md-6 mt-md-4 mb-md-4 p-0">
                            <div class="login_footer text-left text-md-left">
                                <a href="" class="typo_link text-info">رمز عبور خود را فراموش کرده اید؟</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 mt-md-2">
                        <button type="submit" class="btn btn-info w-70 position-absolute box-button checknumber"
                                style="border-radius: 0 0 25px 0px !important;">ورود
                        </button>
                        <a href="" class="btn btn-success w-30 position-absolute box-button"
                           style="margin-right: 70%;border-radius: 0 0 0px 25px !important;line-height: 35px;">ثبت نام</a>
                    </div>
                </form>

            </div>
            <div class="action">
            </div>
        </div>
    </div>

    <!-- Page Extra Links -->


</div>


<script src="{{asset('')}}assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="{{asset('')}}assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="{{asset('')}}assets/js/es5/script.min.js"></script>
<script>
    $(document).ready(function () {
        "use strict";
        var t = document.getElementsByClassName("needs-validation");
        Array.prototype.filter.call(t, function (t) {
            t.addEventListener("submit", function (e) {
                !1 === t.checkValidity() && (e.preventDefault(), e.stopPropagation()), t.classList.add("was-validated")
            }, !1)
        })
    });
    $(".numbers").keypress(function (e) {
//if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//display error messag
            return false;
        }
    });
</script>

@if(Session::has('Success'))

    <script>
        $.notify({
                title: "موفقیت : ",
                message: "{{ Session::get('Success') }}",
                icon: 'fa fa-check'
            },
            {
                placement: {
                    from: "bottom",
                    align: "right"
                },
                animate: {
                    enter: "animated fadeInUp",
                    exit: "animated fadeOutDown"
                },
                type: "success",
                mouse_over: "pause"
            });
    </script>

@endif

@if(Session::has('Error'))

    <script>
        $.notify({
                title: "خطا : ",
                message: "{{ Session::get('Error') }}",
                icon: 'fa fa-check'
            },
            {
                placement: {
                    from: "bottom",
                    align: "right"
                },
                animate: {
                    enter: "animated fadeInUp",
                    exit: "animated fadeOutDown"
                },
                type: "danger",
                mouse_over: "pause"
            });
    </script>

@endif


</body>
</html>