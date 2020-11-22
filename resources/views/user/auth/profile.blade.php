@extends('user.login.master')
@section('title', 'ثبت اطلاعات')

@section('content')
    <div class="content-body mb-4">
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-5 col-md-6 col-11 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">

                        <div class="card-content">

                            <div class="card-body p-0 p-md-2 ">
                                <form method="POST" autocomplete="off" class="form-horizontal needs-validation" novalidate action="" enctype="multipart/form-data">
                                    @csrf
                                    <p><i class="ft-user"></i> اطلاعات فردی
                                        <br>
                                        <small>با تکمیل این بخش به داشبورد هدایت میشوید</small>
                                    </p>

                                    <div class="row">
                                        <fieldset class="col-12 col-md-6 form-group">
                                            <input type="text" name="name" class="form-control round text-center "
                                                   placeholder="نام" required/>
                                            <div class="invalid-feedback">نام را درج کنید</div>
                                        </fieldset>
                                        <fieldset class="col-12 col-md-6 form-group">
                                            <input type="text" name="family" class="form-control round text-center "
                                                   placeholder="نام خانوادگی" required/>
                                            <div class="invalid-feedback">فامیل را درج کنید</div>
                                        </fieldset>
                                    </div>

                                    <fieldset class="form-group">
                                        <input type="text" name="codemeli" required minlength="8" maxlength="12" class="form-control round text-center numbers ltr-dir"
                                               placeholder="کد ملی"/>
                                        <div class="invalid-feedback">کد ملی را بدرستی درج کنید</div>
                                    </fieldset>

                                    <fieldset class="form-group">
                                        <input type="email" name="email" required class="form-control round text-center ltr-dir"
                                               placeholder="ایمیل "/>
                                        <div class="invalid-feedback">ایمیل را بدرستی درج کنید</div>
                                    </fieldset>

                                    <fieldset class="form-group">
                                        <input type="password" name="password" id="password"
                                               class="form-control round text-center ltr-dir"
                                               placeholder="کلمه عبور" minlength="6" required/>
                                        <div class="invalid-feedback">کلمه عبور را بیش از 6 کاراکتر درج کنید</div>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               class="form-control round text-center ltr-dir"
                                               placeholder="تکرار کلمه عبور" minlength="6" required/>
                                        <div class="invalid-feedback">کلمه عبور را بیش از 6 کاراکتر درج کنید</div>
                                    </fieldset>


                                    <div class="text-center">
                                        <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12" id="BtnRegister">تکمیل اطلاعات</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('form').ajaxForm({
                beforeSend: function() {
                    ElementBlock('#BtnRegister');
                },
                uploadProgress: function(event, position, total, percentComplete) {
                },
                complete: function(data) {
                    data = data.responseJSON;
                    if (data.status == true) {
                        if(data.redirect != null){
                            location.href = (data.redirect);
                            return false
                        }
                        Swal.fire({
                            type: 'success',
                            title: "انجام شد",
                            html: data.message,
                            confirmButtonText: "تایید",
                        })
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: "خطا",
                            html: data.message,
                            confirmButtonText: "تایید",
                        })
                    }
                    ElementUnBlock('#BtnRegister');
                }
            });


        });
    </script>
@stop



