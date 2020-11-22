@extends('user.layouts.master')
@section('title', 'حساب کاربری')
@section('css')
    <link rel="stylesheet" href="{{asset('')}}app-assets/vendors/css/dropify.min.css">
    <link rel="stylesheet" href="{{asset('')}}app-assets/vendors/css/lightbox2/css/lightbox.css">
    <style>
        .dropify-filename-inner{display: none}
    </style>
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
                <div class="col-md-9 mb-2 ">

                    <div class="card o-hidden">


                        @if(!isset(Auth::user()->address) || Auth::user()->card_meli_confirm != 1 || Auth::user()->shenasname_confirm != 1)
                            <div class="alert m-1 bg-pink text-center alert-icon-left alert-dismissible mb-2" role="alert">
                                <span class="alert-icon">
                                    <i class="ft-user-x"></i>
                                </span>
                                هنوز اکانت شما بصورت کامل وریفای نشده است و لطفا همه اطلاعات را تکمیل نمایید
                            </div>
                        @endif

                        <div class="">
                            <div class="card-body">
                                <div class="card-title mb-0">1. اطلاعات تکمیلی
                                    @if(Auth::user()->address) <span class="badge badge-success"><i class="icon-check"></i> تایید شده</span> @endif
                                </div>
                                <p class="text-small text-muted">اطلاعات پایه خود را با دقت درج کنید و تلفن شما از طریق تماس و کدی که برای شما اعلام میشود احراز صورت میگیرید.</p>

                                <form autocomplete="off" method="post" class="needs-validation mt-1 @if(Auth::user()->address) disable-block @endif" id="address-ownership" novalidate action="profile/address-ownership">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="picker1">استان</label>
                                            <select class="text-center round ostan form-control" name="ostan"
                                                    required id="Province">
                                                <option value='' disabled selected>استان را انتخاب کنید</option>
                                                @foreach($ostan as $ostan)
                                                    <option value='{{$ostan->id}}' @if(Auth::user()->id_province == $ostan->id) selected @endif>{{$ostan->title}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">استان خود را انتخاب کنید</div>
                                        </div>

                                        <div class="col-md-6 col-12 form-group">
                                            <label for="picker1">شهر</label>
                                            <select class="city form-control round" name="city" id="city"  required>
                                                @if(isset(Auth::user()->id_city))
                                                    @foreach($city as $city)
                                                        <option value='{{$city->id}}' @if(Auth::user()->id_city == $city->id) selected @endif>{{$city->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">شهر خود را انتخاب کنید</div>
                                        </div>

                                        <div class="col-md-6 col-12 form-group">
                                            <label for="firstName1">آدرس</label>
                                            <input type="text" class="form-control round text-center" value="{{Auth::user()->address}}" required name="address" id="address" placeholder="آدرس دقیق به همراه پلاک، طبقه و واحد">
                                            <div class="invalid-feedback">آدرس خود را درج کنید</div>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                            <label for="firstName1">تلفن ثابت</label>
                                            <input type="text" name="phone" id="phone" value="{{isset(Auth::user()->phone)? Auth::user()->phone:''}}"
                                                   class="form-control numbers text-center round ltr-dir" required
                                                   placeholder="تلفن 02123456789" maxlength="11" minlength="11" />
                                            <div class="invalid-feedback">نلفن خود را درج کنید</div>
                                        </div>

                                        <div class="col-md-6 mx-auto form-group" style="display: none" id="box_phone">
                                            <input type="text" class="form-control numbers round text-center ltr-dir" value=""
                                                   maxlength="4" minlength="4" name="verify_phone" id="verify_phone" placeholder="کد تماس را درج کنید" >
                                            <div class="invalid-feedback">کد 4 رقمی تماس را درج نمایید</div>
                                        </div>

                                        @if(!(Auth::user()->address))
                                            <div class="col-md-12 m-auto text-center">
                                                <button type="submit" class="btn btn-primary round px-3">تایید مشخصات</button>
                                            </div>
                                        @endif
                                    </div>
                                </form>

                            </div>

                            <hr>

                            <div class="card-body">
                                <div class="card-title mb-0">2. ثبت تصویر کارت شناسایی
                                    @if(Auth::user()->card_meli_confirm == 1)<span class="badge badge-success"><i class="icon-check"></i> تایید شده</span>
                                    @elseif(Auth::user()->card_meli_confirm == 2)
                                        <span class="badge badge-warning"> در انتظار بررسی</span>
                                    @elseif(Auth::user()->card_meli_confirm == 3)
                                        <span class="badge badge-danger"> رد شده</span>
                                    @endif
                                </div>
                                <p class="text-small text-muted">تصویر کارت ملی خود را آپلود نمایید و بعد از آپلود تصویر در انتظار بررسی توسط اپراتور قرار میگیرد و لطفا تصویر مناسب و واضح ارائه کنید. در صورتی که عکس رد شود بایستی مجدد آپلود نمایید.
                                    <a class="badge badge-warning" href="{{asset('app-assets/images/sample-1.jpg')}}" data-lightbox="image-1" data-title="نمونه تصویر مدارک شناسایی">
                                         نمایش نمونه تصویر کارت شناسایی
                                    </a>
                                </p>
                                @if(isset(Auth::user()->card_meli_reason) && Auth::user()->card_meli_confirm == 3)
                                <div class="alert m-1 bg-warning text-center alert-icon-left alert-dismissible mb-2" role="alert">
                                    <span class="alert-icon">
                                        <i class="ft-user-x"></i>
                                    </span>
                                        تصویر به دلیل "{{Auth::user()->card_meli_reason}}" متاسفانه تایید نشد.
                                </div>
                                @endif
                                <form id="nationalCard" method="POST" autocomplete="off" class="form-horizontal needs-validation" novalidate action="profile/national-card" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8 col-12 mx-auto form-group mb-1">
                                            <label class="font-small-2">با کلیک بر روی باکس زیر تصویر را آپلود و یا تصویر را بر روی باکس زیر درگ(بکشید و بندازید) کنید</label>
                                            <input type="file" id="img_codemeli" name="img_codemeli" accept="image/*"
                                                   @if(isset(Auth::user()->card_meli_img) && (Auth::user()->card_meli_confirm == 2 || Auth::user()->card_meli_confirm == 1))
                                                   disabled data-default-file="{{asset('')}}{{Auth::user()->card_meli_img}}"
                                                   @endif
                                                   class="dropify" data-allowed-file-extensions="jpg jpeg png" required/>
                                            <div class="invalid-feedback">تصویر را آپلود کنید(jpg,png)</div>
                                        </div>
                                    </div>
                                    <div class="progress w-100" style="display: none">
                                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar"
                                             aria-valuemax="100" style="width:0%">
                                            0%
                                        </div>
                                    </div>
                                    @if(Auth::user()->card_meli_confirm == 0 || Auth::user()->card_meli_confirm==3)
                                        <div class="col-md-12 m-auto text-center">
                                            <button type="submit" class="btn btn-primary round px-3">ارسال تصویر</button>
                                        </div>
                                    @endif
                                </form>
                            </div>


                            <hr>

                            <div class="card-body @if(isset(Auth::user()->id_reference_code) || isset(Auth::user()->id_reference_code2)) disable-block @endif">
                                <div class="card-title mb-0">3. ثبت تصویر سلفی
                                    @if(Auth::user()->shenasname_confirm == 1) <span class="badge badge-success"><i class="icon-check"></i> تایید شده</span>
                                    @elseif(Auth::user()->shenasname_confirm == 2)
                                        <span class="badge badge-warning"> در انتظار بررسی</span>
                                    @elseif(Auth::user()->shenasname_confirm == 3)
                                        <span class="badge badge-danger"> رد شده</span>
                                    @endif
                                </div>
                                <p class="text-small text-muted">تصویر سلفی به صورت کارت ملی در دست عکس بگیرید و آن را آپلود نمایید و بعد از آپلود تصویر در انتظار بررسی توسط اپراتور قرار میگیرد و لطفا تصویر مناسب و واضح ارائه کنید. در صورتی که عکس رد شود بایستی مجدد آپلود نمایید.
                                    <a class="badge badge-warning" href="{{asset('app-assets/images/sample-2.jpg')}}" data-lightbox="image-2" data-title="نمونه تصویر سلفی">
                                        نمایش نمونه تصویر سلفی
                                    </a>
                                </p>
                                @if(isset(Auth::user()->shenasname_reason) && Auth::user()->shenasname_confirm == 3)
                                    <div class="alert m-1 bg-warning text-center alert-icon-left alert-dismissible mb-2" role="alert">
                                    <span class="alert-icon">
                                        <i class="ft-user-x"></i>
                                    </span>
                                        تصویر به دلیل "{{Auth::user()->card_meli_reason}}" متاسفانه تایید نشد.
                                    </div>
                                @endif
                                <form id="frm-selfi" method="POST" autocomplete="off" class="form-horizontal needs-validation" novalidate action="profile/selfi-image" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8 col-12 mx-auto form-group mb-1">
                                            <label class="font-small-2">با کلیک بر روی باکس زیر تصویر را آپلود و یا تصویر را بر روی باکس زیر درگ(بکشید و بندازید) کنید</label>
                                            <input type="file" id="img_selfi" name="img_selfi" accept="image/*"
                                                   @if(isset(Auth::user()->shenasname_img) && (Auth::user()->shenasname_confirm == 2 || Auth::user()->shenasname_confirm == 1))
                                                   disabled data-default-file="{{asset('')}}{{Auth::user()->shenasname_img}}"
                                                   @endif
                                                   class="dropify" data-allowed-file-extensions="jpg jpeg png" required/>
                                            <div class="invalid-feedback">تصویر را آپلود کنید(jpg,png)</div>
                                        </div>
                                    </div>
                                    <div class="progress w-100" style="display: none">
                                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar"
                                             aria-valuemax="100" style="width:0%">
                                            0%
                                        </div>
                                    </div>
                                    @if(Auth::user()->shenasname_confirm == 0 || Auth::user()->shenasname_confirm==3)
                                        <div class="col-md-12 m-auto text-center">
                                            <button type="submit" class="btn btn-primary round px-3">ارسال تصویر</button>
                                        </div>
                                    @endif
                                </form>
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
    <script src="{{asset('')}}app-assets/vendors/js/dropify.min.js"></script>
    <script src="{{asset('')}}app-assets/vendors/css/lightbox2/js/lightbox.js"></script>
@stop

@section('script')
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
                    if($(this).find('.dropify:invalid')){
                        $(this).find('.dropify:invalid').parent().next().css('display','block');
                        $(this).find('.dropify:invalid').parent().css('border-color','#d22346');
                    }
                    return false;
                }

                form.classList.add('was-validated');
            }, false);
        });
    });




    $(document).ready(function () {
        (function () {
            var bar = $('#frm-selfi .progress-bar');
            var percent = $('#frm-selfi .progress-bar');
            $('#frm-selfi').ajaxForm({
                beforeSend: function() {
                    $('#frm-selfi .progress').fadeIn();
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                    ElementBlock('#frm-selfi button');
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
                            location.reload();
                        });
                    } else {
                        $('#frm-selfi .progress').fadeOut();
                        swal({
                            type: 'error',
                            title: "خطا",
                            html: data.message,
                            confirmButtonText: "تایید",
                        })

                    }
                    ElementUnBlock('#frm-selfi button');
                }
            });
        })();
    });

    $(document).ready(function () {
        (function () {
            var bar = $('#nationalCard .progress-bar');
            var percent = $('#nationalCard .progress-bar');
            $('#nationalCard').ajaxForm({
                beforeSend: function() {
                    $('#nationalCard .progress').fadeIn();
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                    ElementBlock('#nationalCard button');
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
                            location.reload();
                        });
                    } else {
                        $('#nationalCard .progress').fadeOut();
                        swal({
                            type: 'error',
                            title: "خطا",
                            html: data.message,
                            confirmButtonText: "تایید",
                        })

                    }
                    ElementUnBlock('#nationalCard button');
                }
            });
        })();
    });


    $('#img_codemeli').dropify({
        messages: {
            'default': 'تصویر را در این قسمت درج کنید',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
    $('#img_selfi').dropify({
        messages: {
            'default': 'تصویر را در این قسمت درج کنید',
        }
    });



    $('#address-ownership').ajaxForm({
        beforeSend: function(xhr, opts) {
            //loading();
            if ($('#box_phone').is(':visible') && $('#verify_phone').val().length < 4) {
                xhr.abort();
                return false;
            }
            ElementBlock('#address-ownership button');

        },
        uploadProgress: function(event, position, total, percentComplete) {
        },
        complete: function(data) {
            data = data.responseJSON;
            //unloading();
            if (data.status == true) {
                swal({
                    type: 'success',
                    title: "انجام شد",
                    html: data.message,
                    confirmButtonText: "تایید",
                }).then(function () {
                    if (!$('#box_phone').is(':visible')){
                        $('#box_phone').slideDown();
                        $('#phone').attr('readonly','readonly');
                        $('#verify_phone').attr('required','required');
                        $('#address-ownership button').html('تایید کد و ثبت اطلاعات');
                    }else
                        location.reload()
                });
            } else {
                swal({type: 'error', title: "خطا",html: data.message,confirmButtonText: "تایید",})
                $('#address-ownership button').html('تایید مشخصات');
            }
            ElementUnBlock('#address-ownership button');

        }
    });

    $(".ostan").on("change", function () {
        if ($("#Province").find(":selected").val() != '') {
            var id = $("#Province").find(":selected").val();
            $.post("<?=asset('');?>cities",
                {
                    id: id,
                    _token: "{{ csrf_token() }}",
                },
                function(data){
                    $("#city").html('<option value="" disabled selected>شهر را انتخاب کنید</option>');
                    $.each(data, function(k, v) {
                        $("#city").append(new Option(v.name, v.id));
                    });
                });
        } else
            $("#City").html('');
    });


</script>
@stop