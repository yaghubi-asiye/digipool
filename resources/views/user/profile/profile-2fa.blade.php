@extends('user.layouts.master')
@section('title', 'ورود دو مرحله ای')
@section('css')

@stop

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
            <div class="row mb-4">
            <div class="col-md-3 mb-2 p-md-0">
                @include('user.profile.menu')
            </div>
            <div class="col-md-9 mb-2">
                <div class="card o-hidden">
                    <div class="card-body">
                        <p class="mt-3">
                            به منظور افزایش سطح ایمنی حساب کاربری خود می توانید احراز هویت دو مرحله ای را فعال کنید. با
                            فعال کردن این قابلیت حساب کاربری شما در برابر حملات هکرها، فیشینگ و سوء استفاده افراد سودجو
                            ایمن خواهد بود. </p>


                        <div class="col-12 border-purple p-2 border-bottom-purple-1">
                            <label class="switch switch-primary mr-3">
                                <span>احراز هویت دو مرحله ای از طریق کد پیامکی</span>
                                <input @if(Auth::user()->sms2fa==1) checked @elseif(isset(Auth::user()->google2fa)) disabled @endif  type="checkbox" value="1" id="2fa_sms">
                                <span class="slider"></span>
                            </label>

                            <div class="mt-2 @if(Auth::user()->sms2fa!=1) disable-block @endif" id="block_sms">
                                <p>با فعالسازی این گزینه برای هر بار ورود به شماره موبایلی که ثبت کرده اید کد پنج رقمی
                                    ارسال میشود و آن کد را باید موقع ورود درج کنید.</p>
                            </div>
                        </div>

                        <div class="col-12 border-bottom-purple border-left-purple border-right-purple p-2">
                            <label class="switch switch-primary mr-3">
                                <span>احراز هویت دو مرحله ای با Google Authenticator</span>
                                <input type="checkbox" @if(Auth::user()->google2fa!="") checked disabled @elseif(Auth::user()->sms2fa==1) disabled @endif id="2fa_google">
                                <span class="slider"></span>
                            </label>

                            <div class="mt-2 @if(Auth::user()->google2fa=="") disable-block @endif" id="block_google">
                                @if(!isset(Auth::user()->google2fa))
                                <p>جهت فعال سازی این قابلیت، مراحل زیر را دنبال کنید:</p>
                                <div>
                                    1. آخرین نسخه Google Authenticator را از
                                    <a rel="nofollow" target="_blank"
                                       href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2">گوگل
                                        پلی</a>
                                    یا
                                    <a rel="nofollow" target="_blank"
                                       href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8">اپل
                                        استور</a>
                                    دریافت نمایید.
                                    <br>
                                    2. پس از نصب و اجرای برنامه Google Authenticator از طریق یکی از روش های زیر، کلید را
                                    به برنامه اضافه نمایید.
                                    <div class="m--padding-right-10 m--padding-top-5"><span class="text-bold-600">- Scan a barcode (اسکن بارکد):</span>
                                        این گزینه را انتخاب کرده و بارکد زیر را اسکن نمایید.<br><img
                                                src="{{$goole2fa['inlineUrl']}}"><br>
                                        <span class="text-bold-600">- Enter a provided key (با استفاده از کلید):</span> این
                                        گزینه را انتخاب کرده و کد زیر را به دقت وارد نمایید.
                                        <h2 class="text-info sans-serif">{{$goole2fa['secret']}}</h2>
                                    </div>
                                    3. کد دریافتی (عدد 6 رقمی) را در کادر زیر وارد نموده و دکمه فعال سازی را کلیک
                                    نمایید.


                                </div>
                                <form class="w-100 needs-validation" action="" novalidate>
                                    <div class="row mt-2">

                                        <div class="col-md-5 col-12 form-group mb-2">
                                            <input type="text" class="form-control round text-center" required
                                                   id="code" name="code" minlength="6" maxlength="6" placeholder="عدد 6 رقمی">
                                            <div class="invalid-feedback">
                                                کد 6 رقمی در اپلیکیشن را درج کنید
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button onclick="google2fa()" type="button" class="btn btn-primary round btn-block">فعال سازی
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @else
                                    <p>جهت غیرفعال سازی این قابلیت، بایستی کد درج شده در اپلیکیشن را در فیلد زیر درج کنید و دکمه غیر فعالسازی رو بزنید.</p>
                                    <form class="w-100 needs-validation" action="" novalidate>
                                        <div class="row mt-2">

                                            <div class="col-md-5 col-12 form-group mb-2">
                                                <input type="text" class="form-control round text-center" required
                                                       id="code" name="code" minlength="6" maxlength="6" placeholder="عدد 6 رقمی">
                                                <div class="invalid-feedback">
                                                    کد 6 رقمی در اپلیکیشن را درج کنید
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button onclick="google2fa()" type="button" class="btn btn-primary round btn-block">غیرفعال سازی
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>


        </div>
    </div>
</div>


@stop

@section('js')

@stop

@section('script')
    <script>
        $('#2fa_sms').click(function () {
            loading();
            if ($(this).is(':checked')) {
                var sms = 1;
                $('#block_sms').removeClass('disable-block');
                $('#block_google').addClass('disable-block');
                $('#2fa_google').prop('checked', false);
                $('#2fa_google').prop('disabled', true);
            } else {
                var sms = 0;
                $('#block_sms').addClass('disable-block');
                $('#2fa_google').prop('disabled', false);
            }

            $.post("<?=asset('');?>profile/two-factor-authentication/sms",
            {
                sms: sms,
                _token: "{{ csrf_token() }}",
            },
            function (data) {
                unloading();
                if (data.status == true) {
                    toastr.success(data.message, "انجام شد!", {
                        positionClass: "toast-bottom-right",
                        progressBar: !0,
                    })
                } else {
                    toastr.error(data.message, "خطا!", {
                        positionClass: "toast-bottom-right",
                        progressBar: !0,
                    })
                }
            });

        });

        $('#2fa_google').click(function () {
            if ($(this).is(':checked')) {
                $('#block_google').removeClass('disable-block');
                $('#block_sms').addClass('disable-block');
                $('#2fa_sms').prop('checked', false);
                $('#2fa_sms').prop('disabled', true);
            } else {
                $('#block_google').addClass('disable-block');
                $('#2fa_sms').prop('disabled', false);
            }
        });

        function google2fa(){
            if($("#code:invalid").length==1)
                $('form').addClass('was-validated');
            else{
                loading();
                $.post("<?=asset('');?>profile/two-factor-authentication/google",
                {
                    code: $("#code").val(),
                    _token: "{{ csrf_token() }}",
                },
                function (data) {
                    unloading();
                    if (data.status == true) {
                        swal({
                            type: 'success',
                            title: "انجام شد",
                            html: data.message,
                            confirmButtonText: "تایید",
                            onClose: () => {
                                location.reload();
                            }
                        });
                    } else {
                        toastr.error(data.message, "خطا!", {
                            positionClass: "toast-bottom-right",
                            progressBar: !0,
                        })
                    }
                });
            }
        }
    </script>
@stop