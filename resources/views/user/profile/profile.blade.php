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


                        @if((Auth::user()->address_confirm != 1) || Auth::user()->card_meli_confirm != 1 || Auth::user()->shenasname_confirm != 1)
                            <div class="alert m-1 bg-pink text-center alert-icon-left alert-dismissible mb-2" role="alert">
                                <span class="alert-icon">
                                    <i class="ft-user-x"></i>
                                </span>
                                هنوز اکانت شما بصورت کامل وریفای نشده است و لطفا همه اطلاعات احراز هویت را تکمیل نمایید
                            </div>
                        @endif

                        <div class="">
                            <div class="card-body">
                                <div class="row col-md-8 mx-auto">
                                    <div class="col-md-6 col-12 form-group">
                                        <label for="firstName1">نام</label>
                                        <input type="text" class="form-control round text-center" value="{{Auth::user()->name}}" readonly>
                                    </div>

                                    <div class="col-md-6 col-12 form-group">
                                        <label for="firstName1">فامیل</label>
                                        <input type="text" class="form-control round text-center" value="{{Auth::user()->family}}" readonly>
                                    </div>

                                    <div class="col-md-6 col-12 form-group">
                                        <label for="firstName1">موبایل</label>
                                        <input type="text" class="form-control round text-center" value="{{Auth::user()->mobile}}" readonly>
                                    </div>

                                    <div class="col-md-6 col-12 form-group">
                                        <label for="firstName1">کد ملی</label>
                                        <input type="text" class="form-control round text-center" value="{{Auth::user()->code_meli}}" readonly>
                                    </div>

                                    <div class="col-md-6 col-12 mx-auto form-group">
                                        <label for="firstName1">ایمیل</label>
                                        <input type="text" class="form-control round text-center" value="{{Auth::user()->email}}" readonly>
                                    </div>

                                    <div class="col-12">
                                        <p class="text-center mt-1">جهت تکمیل اطلاعات متوانید به بخش های احراز هویت 1.آدرس و 2.آپلود کارت شناسایی و 3.آپلود تصویر سلفی مراجعه کنید!</p>
                                    </div>
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
    <script src="{{asset('')}}app-assets/vendors/js/dropify.min.js"></script>
    <script src="{{asset('')}}app-assets/vendors/css/lightbox2/js/lightbox.js"></script>
@stop

@section('script')
<script>

</script>
@stop