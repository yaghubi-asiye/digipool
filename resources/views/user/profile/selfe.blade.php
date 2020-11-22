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
                                <form id="frm-selfi" method="POST" autocomplete="off" class="form-horizontal needs-validation" novalidate action="selfi-image" enctype="multipart/form-data">
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



</script>
@stop