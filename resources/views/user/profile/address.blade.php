@extends('user.layouts.master')
@section('title', 'آدرس و تلفن')
@section('css')
    <link rel="stylesheet" href="{{asset('')}}app-assets/vendors/css/dropify.min.css">
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


                        <div class="">
                            <div class="card-body">
                                <div class="card-title mb-0">1. اطلاعات تکمیلی
                                    @if(Auth::user()->address_confirm == 1)<span class="badge badge-success"><i class="icon-check"></i> تایید شده</span>
                                    @elseif(Auth::user()->address_confirm == 2)
                                        <span class="badge badge-warning"> در انتظار بررسی</span>
                                    @elseif(Auth::user()->address_confirm == 3)
                                        <span class="badge badge-danger"> رد شده</span>
                                    @endif                                </div>
                                <p class="text-small text-muted">اطلاعات پایه خود را با دقت درج کنید و تلفن شما از طریق تماس و کدی که برای شما اعلام میشود احراز صورت میگیرید.</p>

                                @if(isset(Auth::user()->address_reason) && Auth::user()->address_confirm == 3)
                                    <div class="alert m-1 bg-warning text-center alert-icon-left alert-dismissible mb-2" role="alert">
                                    <span class="alert-icon">
                                        <i class="ft-user-x"></i>
                                    </span>
                                        مشخصات به دلیل "{{Auth::user()->address_reason}}" متاسفانه تایید نشد.
                                    </div>
                                @endif

                                <form autocomplete="off" method="post" class="needs-validation mt-1 @if(Auth::user()->address_confirm == 1) disable-block @endif" id="address-ownership" novalidate action="address-ownership">
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

                                        <div class="col-md-12 col-12 form-group">
                                            <label for="firstName1">آدرس</label>
                                            <input type="text" class="form-control round text-center" value="{{Auth::user()->address}}" required name="address" id="address" placeholder="آدرس دقیق به همراه پلاک، طبقه و واحد">
                                            <div class="invalid-feedback">آدرس خود را درج کنید</div>
                                        </div>

                                        <div class="col-md-6 col-12 form-group">
                                            <label for="firstName1">کد پستی</label>
                                            <input type="text" class="form-control round numbers text-center" value="{{Auth::user()->code_posti}}" minlength="7" max="15" required name="code_posti" id="code_posti" placeholder="کد پستی بدون فاصله و خط تیره">
                                            <div class="invalid-feedback">کد پستی خود را درج کنید</div>
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

                                            <div class="col-md-12 m-auto text-center">
                                                <button type="submit" class="btn btn-primary round px-3"
                                                @if(Auth::user()->address_confirm != 1 && Auth::user()->address_confirm != 2)
                                                @else
                                                    disabled
                                                @endif
                                                    >تایید مشخصات</button>
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
</div>

@stop

@section('js')
    <script src="{{asset('')}}app-assets/vendors/js/dropify.min.js"></script>
@stop

@section('script')
<script>



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