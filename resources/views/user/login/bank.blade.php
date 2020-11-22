
<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <title>ثبت کارت بانکی</title>
    <link rel="apple-touch-icon" href="{{asset('')}}app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('')}}app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/dropify.min.css">

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
                    <li role="presentation" class="visited"><i class="ft-user-plus" aria-hidden="true"></i>
                        <p>درج اطلاعات</p>
                    </li>
                    <li role="presentation" class="active"><i class="ft-credit-card" aria-hidden="true"></i>
                        <p>حساب بانکی</p>
                    </li>
                </ul>

            </div>
        </section>
        <div class="content-body mb-5 ">
            <section class="flexbox-container" style="height: auto">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-5 col-md-6 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <div class="font-medium-1  text-center">
                                    مشخصات بانکی
                                </div>
                            </div>
                            <div class="card-content">

                                <div class="card-body p-0 p-md-2 ">


                                    <form autocomplete="off" method="post" action="" class="needs-validation" novalidate >
                                        @csrf
                                        <div>
                                            <div class="content">
                                                <div class="mb-2">
                                                    <input type="text" name="name_family" class="form-control round text-center family "
                                                           placeholder="نام و نام خانوادگی صاحب حساب" value="{{isset($card->account_owner)?$card->account_owner:''}}"
                                                           required/>
                                                    <div class="invalid-feedback">نام صاحب حساب درج شود</div>
                                                </div>
                                                <div class="mb-2">
                                                    <select name="bank_name" id="bank_name" required class="form-control round text-center">
                                                        <option value="" disabled hidden selected>نام بانک را انتخاب کنید</option>
                                                        <option value="بانک ملی">بانک ملی</option>
                                                        <option value="بانک ملت">بانک ملت</option>
                                                        <option value="بانک سپه">بانک سپه</option>
                                                        <option value="بانک تجارت">بانک تجارت</option>
                                                        <option value="بانک مسکن">بانک مسکن</option>
                                                        <option value="بانک صادرات">بانک صادرات</option>
                                                        <option value="بانک کشاورزی">بانک کشاورزی</option>
                                                        <option value="بانک رفاه">بانک رفاه</option>
                                                        <option value="بانک سامان">بانک سامان</option>
                                                        <option value="بانک پارسیان">بانک پارسیان</option>
                                                        <option value="بانک پاسارگاد">بانک پاسارگاد</option>
                                                        <option value="بانک سینا">بانک سینا</option>
                                                        <option value="بانک دی">بانک دی</option>
                                                        <option value="بانک شهر">بانک شهر</option>
                                                        <option value="بانک سرمایه">بانک سرمایه</option>
                                                        <option value="بانک اقتصاد نوین">بانک اقتصاد نوین</option>
                                                        <option value="بانک مهر اقتصاد">بانک مهر اقتصاد</option>
                                                        <option value="بانک قرض الحسنه مهر ایران">بانک قرض الحسنه مهر ایران</option>
                                                        <option value="بانک انصار">بانک انصار</option>
                                                        <option value="بانک ایران زمین">بانک ایران زمین</option>
                                                        <option value="بانک حکمت ایرانیان">بانک حکمت ایرانیان</option>
                                                        <option value="پست بانک">پست بانک</option>
                                                        <option value="بانک گردشگری">بانک گردشگری</option>
                                                        <option value="بانک کارآفرین">بانک کارآفرین</option>
                                                        <option value="بانک قوامین">بانک قوامین</option>
                                                        <option value="بانک توسعه صادرات ایران">بانک توسعه صادرات ایران</option>
                                                        <option value="بانک توسعه تعاون">بانک توسعه تعاون</option>
                                                        <option value="موسسه اعتباری کوثر">موسسه اعتباری کوثر</option>
                                                        <option value="موسسه اعتباری توسعه">موسسه اعتباری توسعه</option>
                                                        <option value="سایر">سایر</option>
                                                    </select>
                                                    <div class="invalid-feedback"> بانک را انتخاب کنید</div>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="text" name="account_number" value="{{isset($card->account_number)?$card->account_number:''}}"
                                                           class="form-control round numbers text-center ltr-dir"
                                                           maxlength="16" minlength="9" placeholder="شماره حساب" required/>
                                                    <div class="invalid-feedback">شماره حساب درج شود</div>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="text" name="card_number" value="{{isset($card->card_number)?$card->card_number:''}}"
                                                           class="form-control round numbers text-center ltr-dir"
                                                           maxlength="16" minlength="16" placeholder="شماره کارت" required/>
                                                    <div class="invalid-feedback">شماره کارت بصورت صحیح درج شود</div>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="text" name="iban"
                                                           class="form-control round numbers text-center ltr-dir" value="{{isset($card->shaba)?$card->shaba:''}}"
                                                           maxlength="24" minlength="24" placeholder="شماره شبا بدون IR" required/>
                                                    <div class="invalid-feedback">شماره شبا درج شود</div>
                                                </div>

                                                <div class="mt-3">
                                                    <div class="upload-demo">
                                                        <div class="text-left mb-1">تصویر کارت بانکی:</div>
                                                        <div class="image-upload">
                                                            <input type="file" id="card_image" name="card_image" class="dropify" data-allowed-file-extensions="jpg JPG jepg png" required/>
                                                            <div class="invalid-feedback">تصویر کارت بانکی را آپلود کنید(jpg,png)</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="progress mt-3" style="display: none">
                                                    <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar"
                                                         aria-valuemax="100" style="width:0%">
                                                        0%
                                                    </div>
                                                </div>

                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-red col-12 mr-1 mt-3 mb-1">ثبت</button>
                                                </div>


                                            </div>
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


<!-- BEGIN: Vendor JS-->
<script src="{{asset('')}}app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('')}}app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/dropify.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/jquery.form.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/extensions/sweetalert2.all.js" type="text/javascript"></script>

<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{asset('')}}app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/js/core/app.js" type="text/javascript"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
{!! NoCaptcha::renderJs() !!}

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
                    if($('.dropify:invalid')){
                        $('.dropify:invalid').parent().next().css('display','block');
                        $('.dropify:invalid').parent().css('border-color','#d22346');
                    }
                }

                form.classList.add('was-validated');
            }, false);
        });
    });


    $('#card_image').dropify({
        messages: {
            'default': 'تصویر کارت بانکی را در این قسمت درج کنید',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });

    $(".dropify").change(function(){

        if($(this).is(":valid")){
            $(this).parent().next().css('display','none');
            $(this).parent().css('border-color','#E5E5E5');
        }
    });


    $(document).ready(function() {
        // bind 'myForm' and provide a simple callback function
        var bar = $('.progress-bar');
        var percent = $('.progress-bar');

        $('form').ajaxForm({
            beforeSend: function() {

                $('.progress').fadeIn();
                var percentVal = '0%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal);
                percent.html(percentVal);
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
                        location.href = "{{route('login')}}";
                    });
                } else {
                    swal({
                        type: 'error',
                        title: "خطا",
                        html: data.message,
                        confirmButtonText: "تایید",
                    });
                    $('.progress').fadeOut();

                }
            }
        });
    });

    $('#bank_name').val("{{isset($card->bank_name)?$card->bank_name:''}}");
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


