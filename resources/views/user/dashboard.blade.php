@extends('user.layouts.master')
@section('title', 'پنل کاربری دیجی پول')
@section('css')
    <link rel="stylesheet" href="{{asset('')}}app-assets/vendors/bootstrap-select.css?v=1.0.2">
@stop

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
            </div>


            <div class="content-body">
                <div class="alert alert-card alert-dark w-100 notification" style="display: none" role="alert">
                    <strong class="text-capitalize">دسترسی:</strong>
                    لطفا جهت دریافت تخفیف ها و اطلاعیه های سایت به این سایت اجازه دسترسی به نوتیفکیشن را بدهید!
                    <a href="{{asset('')}}app-assets/images/gallery/notifications.png" target="_blank"><i
                                class="ft-info"></i> راهنما</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @foreach($result->notification as $Notif)
                    <div class="alert alert-card alert-{{($Notif->color!='' ? $Notif->color : 'primary')}} w-100"
                         role="alert">
                        <strong class="text-capitalize">{{$Notif->title}}:</strong> {{$Notif->message}}
                        @if($Notif->head_close == 1)
                            <button type="button" class="close" onclick="RemoveNotification({{$Notif->id}})"
                                    data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        @endif
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-md-4 d-md-block @if(Auth::user()->address_confirm ==1  && Auth::user()->card_meli_confirm ==1  && Auth::user()->shenasname_confirm==1) d-none  @endif">
                        <div class="card ">
                            <div class="card-content">
                                <div class="card-body pb-1">
                                    <div class="text-center">
                                        <img src="{{asset('')}}app-assets/images/portrait/small/1.jpg" width="50px">
                                        <p>
                                            {{Auth::user()->name.' '.Auth::user()->family}}
                                            <br>
                                            {{Auth::user()->mobile}}
                                        </p>
                                    </div>
                                    <div class="mt-1">
                                        <a href="{{asset('')}}profile/location">
                                            <div class="d-flex">
                                                <div class="w-50 text-left font-medium-1 text-dark"><i
                                                            class="icon-user-following"></i> اطلاعات تکمیلی
                                                </div>
                                                <div class="w-50 text-right">
                                                    @if(Auth::user()->address_confirm ==1)
                                                        <div class="badge badge-success">تایید شده</div>
                                                    @elseif(Auth::user()->address_confirm == 0)
                                                        <div class="badge bg-info">تایید نشده</div>
                                                    @elseif(Auth::user()->address_confirm == 2)
                                                        <div class="badge badge-warning">انتظار بررسی</div>
                                                    @else
                                                        <div class="badge badge-danger">رد شده</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                        <hr>
                                        <a href="{{asset('')}}profile/identification">
                                            <div class="d-flex">
                                                <div class="w-50 text-left font-medium-1 text-dark"><i
                                                            class="icon-picture"></i> تصویر مدارک
                                                </div>
                                                <div class="w-50 text-right">
                                                    @if(Auth::user()->card_meli_confirm ==1)
                                                        <div class="badge badge-success">تایید شده</div>
                                                    @elseif(Auth::user()->card_meli_confirm == 0)
                                                        <div class="badge bg-info">تایید نشده</div>
                                                    @elseif(Auth::user()->card_meli_confirm == 2)
                                                        <div class="badge badge-warning">انتظار بررسی</div>
                                                    @else
                                                        <div class="badge badge-danger">رد شده</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                        <hr>
                                        <a href="{{asset('')}}profile/selfie">
                                            <div class="d-flex">
                                                <div class="w-50 text-left font-medium-1 text-dark"><i
                                                            class="icon-cup"></i> تصویر سلفی
                                                </div>
                                                <div class="w-50 text-right">
                                                    @if(Auth::user()->shenasname_confirm ==1)
                                                        <div class="badge badge-success">تایید شده</div>
                                                    @elseif(Auth::user()->shenasname_confirm == 0)
                                                        <div class="badge badge-info">تایید نشده</div>
                                                    @elseif(Auth::user()->shenasname_confirm == 2)
                                                        <div class="badge badge-warning">انتظار بررسی</div>
                                                    @else
                                                        <div class="badge badge-danger">رد شده</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left align-self-bottom mt-2">
                                                    <span class="d-block mb-1 font-medium-1">موجودی کیف پول</span>
                                                    <h5 class="danger mb-0">{{number_format(Auth::user()->wallet)}}
                                                        <span class="font-small-1">تومان</span></h5>
                                                </div>
                                                <div class="align-self-top">
                                                    <i class="icon-wallet icon-opacity danger font-large-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left align-self-bottom mt-2">
                                                    <span class="d-block mb-1 font-medium-1">کل خریدها</span>
                                                    <h4 class="success mb-0">{{number_format($result->CountBuy)}}</h4>
                                                </div>
                                                <div class="align-self-top">
                                                    <i class="icon-basket-loaded icon-opacity success font-large-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-6 col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left align-self-bottom mt-2">
                                                    <span class="d-block mb-1 font-medium-1">کل فروش ها</span>
                                                    <h4 class="warning mb-0">{{number_format($result->CountSell)}}</h4>
                                                </div>
                                                <div class="align-self-top">
                                                    <i class="la la-rocket icon-opacity warning font-large-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left align-self-bottom mt-2">
                                                    <span class="d-block mb-1 font-medium-1"> کل تراکنش ها</span>
                                                    <h5 class="info mb-0">{{number_format($result->TotalAmount)}} <span
                                                                class="font-small-1">تومان</span></h5>
                                                </div>
                                                <div class="align-self-top">
                                                    <i class="la la-cubes icon-opacity info font-large-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-7 ltr-dir mx-auto mb-2 d-md-block d-none">
                        <div class="conv-wrap card">
                            <div class="conv-cont al-left">
                                <div class="card-title mb-1 rtl-dir">
                                    <span id="model">خرید</span>
                                    <span id="cur">psvouchers </span>
                                    <span id="about">از </span>
                                    ما
                                </div>
                                <form action="{{asset('')}}dashboard/redirect" method="post" name="frm" id="frm"
                                      class="cov-frm" autocomplete="off">
                                @csrf
                                <!-- <label class="cov-frm-label">Sending Amount</label> -->
                                    <div class="cov-inp-bx d-flex" style="margin-bottom: 10px">
                                        <div class="col-md-8">
                                            <label class="cov-frm-labeli">مقدار واریز</label>
                                            <input class="cov-frm-input" type="text" name="myText1" id="myText1"
                                                   value="">
                                        </div>
                                        <div class="col-md-4">
                                            <select class="selectpicker" id="mySelect1" name="mySelect1"
                                                    disabled="disabled">
                                                <option value="rial" data-icon="rial" selected>Toman</option>
                                                <option value="PSVouchers" data-icon="psv">PSV</option>
                                                <option value="PMvoucher" data-icon="pmv">PMV</option>
                                                <option value="PerfectMoney" data-icon="pm">PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!--  <label class="cov-frm-label">Receving Amount</label> -->
                                    <div class="cov-inp-bx d-flex">
                                        <div class="col-md-8">
                                            <label class="cov-frm-labeli">مقدار دریافت</label>
                                            <input class="cov-frm-input" type="text" name="myText2" id="myText2"
                                                   placeholder="loading ..." value="" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="selectpicker" id="mySelect2" name="mySelect2"
                                                    disabled="disabled">
                                                <option value="rial" data-icon="rial">Toman</option>
                                                <option value="PSVouchers" selected data-icon="psv">PSV</option>
                                                <option value="PMvoucher" data-icon="pmv">PMV</option>
                                                <option value="PerfectMoney" data-icon="pm">PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="mt-1">
                                        <button class="btn btn-outline-secondary btn-block py-2 text-14" disabled>تایید
                                            و ادامه
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="card mb-2 o-hidden mt-1 rtl-dir">
                            <div class="card-body pb-1">
                                <h5 class="text-28 text-center">موجودی <a href="{{asset('')}}wallet">کیف
                                        پول</a> {{number_format(Auth::user()->wallet)}} تومان</h5>
                                <hr width="30%">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1 text-center font-small-3">
                                        <span class="text-small"><i class="ft-zap"></i> تعداد تراکنش ها</span>
                                        <h5 class="m-0 font-weight-bold text-muted">{{$result->CountFinance}}</h5>
                                    </div>
                                    <div class="flex-grow-1 text-center">
                                        <span class="text-small"><i class="ft-trending-up"></i> تعداد واریزها</span>
                                        <h5 class="m-0 font-weight-bold text-muted">{{$result->CountFinanceIncrement}}</h5>
                                    </div>
                                    <div class="flex-grow-1 text-center">
                                        <span class="text-small"><i class="ft-trending-down"></i> تعداد برداشت ها</span>
                                        <h5 class="m-0 font-weight-bold text-muted ">{{$result->CountFinanceDecrement}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-5 col-md-5 col-12 stock">

                        <div class="card">
                            <div class="card-header ">
                                <h4 class="card-title"></h4>
                                <a class="heading-elements-toggle">
                                    <i class="la la-ellipsis-v font-medium-3"></i>
                                </a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="reload" onclick="stock()">
                                                <i class="ft-rotate-cw"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body text-center">


                                    <?php

                                    $api = json_decode(file_get_contents('https://xpayserv-api.com/rate/getdata/pm/'), true);
                                    $test['buy'] = substr($api['TOMAN:PM'],2);
                                    $test['buy'] =  round((1 / $test['buy'])/10);
                                    $test['sell'] = round(substr($api['PM:TOMAN'],2)/10);

                                    // $percent_buy = App/Settings::where('name', 'perfectmoney_price_percent_buy')->first()['value'];
                                    // $percent_sell = App/Settings::where('name', 'perfectmoney_price_percent_sell')->first()['value'];
                                    // $result['buy'] = round($result['buy']) + ($percent_buy);
                                    // $result['sell'] = round($result['sell']) + ($percent_sell);

                                    ?>
                                    <div class="carousel slide" id="carousel-example" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @php $i = 0; $j = rand(0,1)@endphp
                                            @foreach($result->Currencys as $Currency)
                                                <div class="carousel-item @if($i==$j)active @endif">
                                                    <div class="card-header pt-0 pb-0">
                                                        <p class="primary darken-2">موجودی</p>
                                                        <h3 class="display-4 blue-grey lighten-2"
                                                            id="stock_{{($Currency)}}">
                                                            <div class="font-medium-1 spinner-border"></div>
                                                        </h3>
                                                    </div>
                                                    <div class="card-content">

                                                        <div id="new-customers" class="donutShadow">
                                                            <a href="{{asset('')}}{{$Currency}}">
                                                                <img src="{{asset('')}}app-assets/images/currency/{{strtolower($Currency)}}.svg"
                                                                     width="165px">
                                                            </a>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-4">
                                                            <div class="flex-grow-1 text-center font-small-3">
                                                                <span class="font-medium-1"><i
                                                                            class="ft-chevrons-down"></i> قیمت خرید</span>
                                                                <h5 class="m-0 font-weight-bold text-muted"
                                                                    id="fee_buy_{{($Currency)}}">
                                                                    <div class="font-medium-1 spinner-border spinner-border-sm"></div>
                                                                </h5>
                                                            </div>
                                                            <div class="flex-grow-1 text-center">
                                                                <span class="font-medium-1"><i
                                                                            class="ft-chevrons-up"></i> قیمت فروش</span>
                                                                <h5 class="m-0 font-weight-bold text-muted"
                                                                    id="fee_sell_{{($Currency)}}">
                                                                    <div class="font-medium-1 spinner-border spinner-border-sm"></div>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $i++; @endphp
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev grey-blue" href="#carousel-example"
                                           role="button" data-slide="prev"><span class="la la-angle-right"
                                                                                 aria-hidden="true"></span><span
                                                    class="sr-only">قبلی</span></a>
                                        <a class="carousel-control-next grey-blue" href="#carousel-example"
                                           role="button" data-slide="next"><span class="la la-angle-left icon-next"
                                                                                 aria-hidden="true"></span><span
                                                    class="sr-only">بعدی</span></a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card bg-gradient-x-purple-red">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left align-self-bottom mt-2 ">
                                                    <span class="d-block mb-1 font-small-3">تیکت ها</span>
                                                    <h5 class="text-white mb-0">{{$result->CountTicket}}</h5>
                                                </div>
                                                <div class="align-self-top">
                                                    <i class="icon-bubbles icon-opacity text-white font-large-2 float-left"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card bg-gradient-x-purple-blue">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left align-self-bottom mt-2 ">
                                                    <span class="d-block mb-1 font-small-3">معرفی ها</span>
                                                    <h5 class="text-white mb-0">{{$result->CountInvitation}}</h5>
                                                </div>
                                                <div class="align-self-top">
                                                    <i class="icon-user-follow icon-opacity text-white font-large-2 float-left"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card bg-gradient-x-orange-yellow">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left align-self-bottom mt-2">
                                                    <span class="d-block mb-1 font-small-3">جمع خرید {{$result->Month}} ماه</span>
                                                    <h5 class="text-white mb-0">{{number_format($result->CountBuyMonth )}}
                                                        <span class="font-small-1">تومان</span></h5>
                                                </div>
                                                <div class="align-self-top">
                                                    <i class="icon-basket-loaded icon-opacity text-white font-large-2 float-left"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card bg-gradient-directional-success">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left align-self-bottom mt-2 ">
                                                    <span class="d-block mb-1 font-small-3">جمع فروش {{$result->Month}} ماه</span>
                                                    <h5 class="text-white mb-0">{{number_format($result->CountSellMonth )}}
                                                        <span class="font-small-1">تومان</span></h5>
                                                </div>
                                                <div class="align-self-top">
                                                    <i class="icon-fire icon-opacity text-white font-large-2 float-left"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card  p-0 o-hidden">

                            <div class="card-header">
                                <h5 class="card-title">وضعیت میزان خرید روزانه</h5>
                                <p class="text-muted">{{number_format(Auth::user()->daily_buy)}} تومان در روز مجاز به خرید هستید.</p>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body p-0 pb-1">
                                    <div class="height-150">
                                        <canvas id="polar-chart"></canvas>
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
    <script src="{{asset('')}}app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>

    <script src="{{asset('')}}app-assets/vendors/bootstrap-select.js"></script>
    <script src="{{asset('')}}app-assets/vendors/js/digitbox.min.js"></script>
@stop

@section('script')

    <script>


// $(document).ready(function() {
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });



        function textCalculate(idTextBox) {
            var mySelect1 = $('#mySelect1');
            var mySelect2 = $('#mySelect2');
            var floatNumber = 2;

            $('#myText1').val( $('#myText1').val().replace(/\,/g, ''));
            $('#myText2').val( $('#myText2').val().replace(/\,/g, ''));

            if(mySelect1.val() == 'rial'){
                //$('#myText1').val(10000000);

                var mySelect2Val = mySelect2.val();
                if(mySelect2Val == 'PMvoucher')
                    mySelect2Val = 'PerfectMoney';

                if(mySelect2Val == 'bitcoin')
                    floatNumber = 5;

                var fee = $('#fee_buy_'+ mySelect2Val ).html();
                // alert(fee);
                var fee1 = parseInt(fee.replace(/\,/g, ''));
                // alert(fee1);


                var amount = $('#myText1').val();
                amount = parseInt(amount.replace(/\,/g, ''));

                if(idTextBox=='myText1' || idTextBox == null)
                    $('#myText2').val((amount / fee).toFixed(floatNumber)).removeAttr('disabled');
                if(idTextBox=='myText2')
                    $('#myText1').val( Math.round($('#myText2').val() * fee)).digits();

            }else{
                var mySelect1Val = mySelect1.val();
                if(mySelect1Val == 'PMvoucher')
                    mySelect1Val = 'PerfectMoney';

                if(mySelect1Val == 'bitcoin')
                    floatNumber = 5;

                var fee = $('#fee_sell_'+ mySelect1Val ).html();
                var fee = parseInt(fee.replace(/\,/g, ''));



                if(idTextBox=='myText1' || idTextBox == null){
                    var amount = $('#myText1').val();
                    $('#myText2').val((amount * fee));
                }
                else if(idTextBox=='myText2'){
                    var amount = $('#myText2').val();
                    amount = parseInt(amount.replace(/\,/g, ''));
                    $('#myText1').val( (amount / fee).toFixed(floatNumber) );
                }
            }

        }

        $('#myText1,#myText2').on('keyup', function () {
            textCalculate($(this).attr('id'))
        });


        $(window).on("load", function () {
            var a = $("#polar-chart");
            new Chart(a, {
                type: "pie",
                options: {
                    legend: {
                        position: "left",
                        labels: {
                            fontSize: 14,
                            fontFamily: 'Vazir-FD',
                        }
                    },
                    tooltips: {
                        titleFontFamily: 'Vazir-FD',
                        bodyFontFamily: 'Vazir-FD',
                        titleMarginBottom: 10,
                        titleSpacing: 10,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var value = data.datasets[0].data[tooltipItem.index];
                                var str = data.labels[tooltipItem.index];
                                if(parseInt(value) >= 1000){
                                    return str + ' ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return str + ' ' + value;
                                }
                            }
                        } // end callbacks:

                    },
                    responsive: !0, maintainAspectRatio: !1, responsiveAnimationDuration: 500},
                data: {
                    labels: ["میزان خرید های امروز", "میزان باقیمانده"],
                    datasets: [{
                        label: "مجموعه داده اول من",
                        data: [{{$result->SumOrderDay}}, {{Auth::user()->daily_buy - $result->SumOrderDay}}],
                        backgroundColor: ["#666EE8", "#28D094"]
                    }]
                }
            })
        });


        setTimeout(function () {
            stock();
        }, 1000);

        function stock() {
            // alert('ok');

            $.post("<?=asset('');?>stock",
                {_token: "{{ csrf_token() }}"},
                function (data) {
                    alert(data.fee_sell_PerfectMoney);
                    var i = 0;
                    $.each(data, function (k, v) {
                        $('#' + k).fadeOut(i, function () {
                            $('#' + k).html(v);
                            $('#' + k).show();
                        });
                        //i = i+300;
                    });

                    $('#mySelect1').change();
                });
        }

        function RemoveNotification(id) {
            $.post("<?=asset('');?>RemoveNotification",
                {_token: "{{ csrf_token() }}", id: id}
            );
        }


        if (Notification.permission !== "granted" && 1 == {{number_format(Auth::user()->requestPermission)}}) {
            $('.notification').show();
            Notification.requestPermission();
        }

    // });
    </script>

@stop
