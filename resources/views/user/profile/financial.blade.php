@extends('user.layouts.master')
@section('title', 'اطلاعات مالی')
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
                <div class="col-md-9 mb-2">

                    <div class="card o-hidden">

                        <div class="card-body">

                            <p class="">جهت دریافت خدمات و سرویس های وب سایت به صورت آنی، می بایست شماره کارت بانکی که خرید را توسط آن انجام می دهید ثبت نمایید.
                            </p>
                            <div class="col-12 border-purple rounded p-2">

                                <label class="checkbox checkbox-primary mr-3 mb-0">
                                    <input type="checkbox" onclick="$('form').slideToggle();">
                                    <span>افزودن کارت بانکی</span>
                                    <span class="checkmark"></span>
                                </label>

                                <form autocomplete="off" method="post" action=""  class="needs-validation" novalidate style="display: none">
                                    @csrf
                                    <div class="row col-md-9 col-12 mx-md-auto m-0 p-0 mt-2 ">
                                        <div class="col-md-6 form-group mb-1">
                                            <label>شماره حساب</label>
                                            <input type="text" class="form-control round text-center numbers ltr-dir" name="account_number" maxlength="16" minlength="9" placeholder="شماره حساب" required>
                                            <div class="invalid-feedback">شماره حساب درج شود</div>
                                        </div>
                                        <div class="col-md-6 form-group mb-1">
                                            <label>نام بانک</label>
                                            <select name="bank_name" id="bank_name" required class="form-control round text-center">
                                                <option value="" disabled hidden selected>انتخاب کنید</option>
                                                <option value="بانک ملی">بانک ملی</option>
                                                <option value="بانک ملت">بانک ملت</option>
                                                <option value="بانک سپه">بانک سپه</option>
                                                <option value="بانک تجارت">بانک تجارت</option>
                                                <option value="بانک آینده">بانک آینده</option>
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
                                        <div class="col-md-12 form-group mb-1">
                                            <label>شماره کارت</label>
                                            <input type="text" class="form-control round text-center numbers ltr-dir" name="card_number" maxlength="16" minlength="16" placeholder="شماره کارت" required>
                                            <div class="invalid-feedback">شماره کارت بصورت صحیح درج شود</div>
                                        </div>
                                        <div class="col-md-12 form-group mb-1">
                                            <label>شماره شبا بدون IR</label>
                                            <input type="text" class="form-control round text-center numbers ltr-dir" name="iban" maxlength="24" minlength="24" placeholder="شماره شبا بدون IR" required>
                                            <div class="invalid-feedback">شماره شبا درج شود</div>
                                        </div>
                                        <div class="col-md-12 form-group mb-1">
                                            <label>تصویر کارت</label>
                                            <input type="file" id="card_image" name="card_image" class="dropify" data-allowed-file-extensions="jpg jpeg png" required/>
                                            <div class="invalid-feedback">تصویر کارت بانکی را آپلود کنید(jpg,png)</div>
                                        </div>

                                        <div class="progress mt-3 w-100" style="display: none">
                                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar"
                                                 aria-valuemax="100" style="width:0%">
                                                0%
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-5 col-5 mx-auto mt-1">
                                            <button type="submit" class="btn btn-primary round btn-block">ثبت کارت
                                            </button>
                                        </div>


                                    </div>
                                </form>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-default">

                                    <tr>
                                        <th class="text-center p-0 m-0">#</th>
                                        <th class="text-center">بانک</th>
                                        <th class="text-center">شماره کارت</th>
                                        <th class="text-center">شماره حساب</th>
                                        <th class="text-center">شبا</th>
                                        <th class="text-center">تصویر</th>
                                        <th class="text-center">وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center font-size-small">
                                    @php $i=1 @endphp
                                    @foreach($card as $card)
                                        <tr>
                                            <td scope="row" class="sans-serif">{{$i}}</td>
                                            <td>{{$card->bank_name}}</td>
                                            <td class="text-11 sans-serif" >{{$card->card_number}}</td>
                                            <td class="text-10 sans-serif" >{{$card->account_number}}</td>
                                            <td class="text-10 sans-serif">{{$card->shaba}}</td>
                                            <td class="text-10 sans-serif">
                                                <a href="{{asset('').$card->card_image}}" data-lightbox="image-1" data-title="{{$card->card_number}}">
                                                    <img src="{{asset('').$card->card_image}}" width="80px">
                                                </a>
                                            </td>

                                            @if($card->confirm == 0)
                                                <td><span class="badge badge-pill badge-warning my-1 font-weight-light">منتظر تایید</span></td>
                                            @elseif($card->confirm == 1)
                                                <td><span class="badge badge-pill badge-success my-1 font-weight-light">تایید شده</span></td>
                                            @else
                                                <td><span class="badge badge-pill badge-danger my-1 font-weight-light">تایید نشده</span></td>
                                            @endif

                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                    </tbody>
                                </table>
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

                    //$('.progress').fadeIn();
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                    ElementBlock( 'form button');
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
                        swal({
                            type: 'error',
                            title: "خطا",
                            html: data.message,
                            confirmButtonText: "تایید",
                        })

                    }
                    ElementUnBlock( 'form button');
                }
            });
        });
    </script>
@stop