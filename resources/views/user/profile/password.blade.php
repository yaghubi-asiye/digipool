@extends('user.layouts.master')
@section('title', 'رمز عبور')
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
                            <p class="mt-2">
                                در صورت لزوم می‌توانید از طریق این صفحه کلمه عبور خود را تغییر دهید.<br>
                                سعی کنید کلمه عبور پیچیده ای انتخاب کنید و با سایر حساب های شما در سایت های دیگر یکسان نباشد.<br>
                                به منظور افزایش سطح ایمنی حساب کاربری خود می توانید احراز هویت دو مرحله ای را نیز <a href="{{asset('')}}profile/two-factor-authentication">فعال کنید</a>.<br>
                            </p>
                            <form autocomplete="off" method="post" class="needs-validation" novalidate action="">
                                @csrf
                                <div class="row col-md-6 col-12 m-md-auto m-0 p-0">
                                    <div class="col-md-12 p-0 form-group mb-1">
                                        <label>رمز عبور فعلی</label>
                                        <input type="password" class="form-control round text-center ltr-dir" minlength="6" id="password" name="password" placeholder="رمز فعلی" required>
                                        <div class="invalid-feedback">رمز فعلی خود را درج کنید(حداقل 6 کاراکتر)</div>
                                    </div>

                                    <div class="col-md-12 p-0 form-group mb-1">
                                        <label>رمز عبور جدید</label>
                                        <input type="password" class="form-control round text-center ltr-dir" minlength="6" id="new_password" name="new_password" placeholder="رمز جدید" required>
                                        <div class="invalid-feedback">رمز جدید خود را درج کنید(حداقل 6 کاراکتر)</div>
                                    </div>

                                    <div class="col-md-12 p-0 form-group mb-1">
                                        <label>تکرار رمز جدید</label>
                                        <input type="password" class="form-control round text-center ltr-dir" minlength="6" id="renew_password" name="renew_password" placeholder="تکرار رمز جدید" required>
                                        <div class="invalid-feedback">تکرار رمز جدید خود را درج کنید(حداقل 6 کاراکتر)</div>
                                    </div>
                                    <div class="border-bottom w-80 mb-4 mt-2 mx-auto"></div>
                                    <div class="col-md-12 m-auto mb-md-3 text-center">
                                        <button type="submit" class="btn btn-primary round">ثبت تغییرات</button>
                                    </div>

                                </div>
                            </form>
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
    $(document).ready(function () {

        $('form').ajaxForm({
            beforeSend: function (xhr, opts) {
                if ($('#new_password').val() != $('#renew_password').val()) {
                    swal({
                        type: 'error',
                        title: "خطا",
                        html: 'پسورد های درج شده یکسان نیستند',
                        confirmButtonText: "تایید",
                    });
					xhr.abort();
                   return false
                }

                if ($('#password').val() == $('#new_password').val()) {
                    swal({
                        type: 'error',
                        title: "خطا",
                        html: 'پسورد جدید با پسورد فعلی فرقی ندارد',
                        confirmButtonText: "تایید",
                    });
					xhr.abort();
                    return false
                }
            },
            complete: function (data) {
                data = data.responseJSON;
                if (data.status == true) {
                    swal({
                        type: 'success',
                        title: "انجام شد",
                        html: data.message,
                        confirmButtonText: "تایید",
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    swal({
                        type: 'error',
                        title: "خطا",
                        html: data.message,
                        confirmButtonText: "تایید",
                    })

                }
            }
        });
    });
</script>
@stop