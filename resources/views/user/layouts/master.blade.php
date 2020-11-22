<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')</title>
    {{-- <link rel="apple-touch-icon" href="{{asset('')}}app-assets/images/ico/apple-icon-120.png"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('')}}app-assets/images/ico/fiv1.ico">
    <link rel="manifest" href="{{asset('')}}js/manifest.json">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="firebase_token" content="{{ Auth::user()->firebase_token }}">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/forms/toggle/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/plugins/forms/switch.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/core/colors/palette-switch.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/vendors/css/extensions/toastr.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/colors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/components.css?v=0.0.0">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/custom-rtl.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('')}}app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/css-rtl/plugins/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}app-assets/fonts/simple-line-icons/style.min.css">
    <!-- END: Page CSS-->
    @yield('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu"
      data-color="bg-dark" data-col="2-columns">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light navbar-hide-on-scroll">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                                class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                    class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                    class="ficon ft-maximize"></i></a></li>

                    <li class="dropdown d-none d-md-block mr-1">
                        <a class="dropdown-toggle nav-link" id="apps-navbar-links" href="#" data-toggle="dropdown">
                            دسترسی سریع
                        </a>
                        <div class="dropdown-menu">
                            <div class="arrow_box">
                                <a class="dropdown-item" href="{{asset('')}}PMvoucher">
                                    <img src="{{asset('')}}app-assets/images/currency/perfectmoney.svg" width="25px"> ووچر پرفکت مانی
                                </a>
                                <a class="dropdown-item" href="{{asset('')}}PSVouchers">
                                    <img src="{{asset('')}}app-assets/images/currency/PSVouchers.svg" width="25px"> پی اس ووچرز
                                </a>
                                <a class="dropdown-item" href="{{asset('')}}orders">
                                    <i class="font-medium-3 icon-list"></i>سفارشات
                                </a>
                                <a class="dropdown-item"  href="{{asset('')}}ticket">
                                    <i class="font-medium-3 icon-speech"></i>پشتیبانی
                                </a>
                            </div>
                        </div>
                    </li>

                </ul>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="ficon ft-bell bell-shake" id="notification-navbar-link"></i>
                            @if(($SumNotification = config('notification.CountInvitationFinance')+ config('notification.CountInvitation')+ config('notification.CountWallet')+config('notification.CountTicket')+config('notification.CountOrdersSellPaymentCard'))>0)
                            <span class="badge badge-pill badge-sm badge-success badge-up badge-glow">
                                {{$SumNotification}}
                            </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right py-0">
                            <div class="arrow_box_right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">اطلاعیه</span></h6>
                                </li>
                                <li class="notification-dropdown scrollable-container media-list w-100">
                                    @if($SumNotification == 0)
                                        <a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h6 class="media-heading text-center text-muted mb-0">
                                                        اطلاعیه ای موجود نیست!
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    @else

                                    @if(config('notification.CountTicket')>0)
                                        <a href="{{asset('')}}ticket" data-sort='{{config('notification.SortTicket')}}'>
                                            <div class="media">
                                                <div class="media-left align-self-center">
                                                    <i class="icon-speech warning font-medium-4 mt-2"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading warning mb-0">
                                                        <span class="badge badge-pill badge-sm badge-warning badge-glow float-right">
                                                            {{config('notification.CountTicket')}}
                                                        </span>
                                                        تیکت خوانده نشده
                                                    </h6>
                                                    <p class="notification-text font-small-3 text-muted mb-0">
                                                        {{config('notification.SubjectTicket')}}
                                                    </p>
                                                    <small class="float-right">
                                                        <time class="media-meta text-muted">
                                                            {{config('notification.TimeTicket')}}
                                                        </time>
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    @endif

                                    @if(config('notification.CountOrdersSellPaymentCard')>0)
                                        <a href="{{asset('')}}orders" data-sort='{{config('notification.SortOrdersSellPaymentCard')}}'>
                                            <div class="media">
                                                <div class="media-left align-self-center">
                                                    <i class="icon-check success font-medium-4 mt-2"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading success mb-0">
                                                        <span class="badge badge-pill badge-sm badge-success badge-glow float-right">
                                                            {{config('notification.CountOrdersSellPaymentCard')}}
                                                        </span>
                                                            تایید سفارش
                                                    </h6>
                                                    <p class="notification-text font-small-3 text-muted mb-0">
                                                        {{config('notification.SubjectOrdersSellPaymentCard')}}
                                                    </p>
                                                    <small class="float-right">
                                                        <time class="media-meta text-muted">
                                                            {{config('notification.TimeOrdersSellPaymentCard')}}
                                                        </time>
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    @endif

                                    @if(config('notification.CountWallet')>0)
                                        <a href="{{asset('')}}wallet" data-sort='{{config('notification.SortWallet')}}'>
                                            <div class="media">
                                                <div class="media-left align-self-center">
                                                    <i class="icon-credit-card success font-medium-4 mt-2"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading success mb-0">
                                                        <span class="badge badge-pill badge-sm badge-success badge-glow float-right">
                                                            {{config('notification.CountWallet')}}
                                                        </span>
                                                        واریز انجام شد
                                                    </h6>
                                                    <p class="notification-text font-small-3 text-muted mb-0">
                                                        {{config('notification.SubjectWallet')}}
                                                    </p>
                                                    <small class="float-right">
                                                        <time class="media-meta text-muted">
                                                            {{config('notification.TimeWallet')}}
                                                        </time>
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    @endif

                                    @if(config('notification.CountInvitation')>0)
                                        <a href="{{asset('')}}invitation" data-sort='{{config('notification.SortInvitation')}}'>
                                            <div class="media">
                                                <div class="media-left align-self-center">
                                                    <i class="icon-user-follow primary font-medium-4 mt-2"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading primary mb-0">
                                                        <span class="badge badge-pill badge-sm badge-primary badge-glow float-right">
                                                            {{config('notification.CountInvitation')}}
                                                        </span>
                                                        معرفی دوست شما
                                                    </h6>
                                                    <p class="notification-text font-small-3 text-muted mb-0">
                                                        {{config('notification.SubjectInvitation')}}
                                                    </p>
                                                    <small class="float-right">
                                                        <time class="media-meta text-muted">
                                                            {{config('notification.TimeInvitation')}}
                                                        </time>
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    @endif

                                    @if(config('notification.CountInvitationFinance')>0)
                                        <a href="{{asset('')}}invitation" data-sort='{{config('notification.SortInvitationFinance')}}'>
                                            <div class="media">
                                                <div class="media-left align-self-center">
                                                    <i class="icon-wallet danger font-medium-4 mt-2"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading danger mb-0">
                                                        <span class="badge badge-pill badge-sm badge-danger badge-glow float-right">
                                                            {{config('notification.CountInvitationFinance')}}
                                                        </span>
                                                            پورسانت خرید دوستتان
                                                    </h6>
                                                    <p class="notification-text font-small-3 text-muted mb-0">
                                                        {{config('notification.SubjectInvitationFinance')}}
                                                    </p>
                                                    <small class="float-right">
                                                        <time class="media-meta text-muted">
                                                            {{config('notification.TimeInvitationFinance')}}
                                                        </time>
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    @endif

                                </li>
                            </div>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="avatar avatar-online">
                                <img src="{{asset('')}}app-assets/images/portrait/small/1.jpg" alt="avatar"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="#">
                                    <span class="avatar avatar-online">
                                        <img src="{{asset('')}}app-assets/images/portrait/small/1.jpg" alt="avatar">
                                        <span class="user-name text-bold-700"> {{Auth::user()->name .' ' .Auth::user()->family}}</span>
                                    </span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{asset('')}}profile">
                                    <i class="ft-user"></i> پروفایل
                                </a>
                                <a class="dropdown-item" href="{{asset('')}}profile/password">
                                    <i class="ft-lock"></i>                                    کلمه عبور
                                </a>
                                <a class="dropdown-item" href="{{asset('')}}profile/two-factor-authentication">
                                    <i class="ft-check-square"></i> ورود دو مرحله ای
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ft-power"></i> خروج</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->

@include('user.layouts.menu')



<!-- BEGIN: Content-->
@yield('content')
<!-- END: Content-->

@include('user.layouts.footer')



@if(config('popup')!='')
    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    {!! config('popup') !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
@endif
<form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<!-- BEGIN: Vendor JS-->
<script src="{{asset('')}}app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/js/scripts/forms/switch.min.js" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('')}}app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/ui/headroom.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/jquery.form.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/extensions/sweetalert2.all.js" type="text/javascript"></script>
@yield('js')
<!-- END: Page Vendor JS-->
<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase.js"></script>

<!-- BEGIN: Theme JS-->
<script src="{{asset('')}}app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/js/core/app.js?v=1.5.0" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/js/scripts/customizer.min.js" type="text/javascript"></script>
<script src="{{asset('')}}app-assets/vendors/js/jquery.sharrre.js" type="text/javascript"></script>
<!-- END: Theme JS-->



@if(Session::has('Success'))
    <script>
        toastr.success("{{ Session::get('Success') }}", "انجام شد!", {
            positionClass: "toast-bottom-center",
            progressBar: !0,
        })
    </script>
@endif
@if(Session::has('Error'))
    <script>
        toastr.error("{{ Session::get('Error') }}", "خطا!", {
            positionClass: "toast-bottom-center",
            progressBar: !0,
        })
    </script>
@endif
@yield('script')


<script type="text/javascript">

    $(window).on("load", function () {
        $("#loader").fadeOut();
        $("#preloader").delay(500).fadeOut("slow");
    });

    @if(config('popup')!='')
    setTimeout(function () {
        $('#popup').modal('show');
    }, 1500)
    @endif

</script>

<!---begin GOFTINO code--->
<script type="text/javascript">
    !function(){var g=document.createElement("script"),s="https://www.goftino.com/widget/U0Tcx4",e=document.getElementsByTagName("script")[0];g.type="text/javascript";g.async=!0;g.src=localStorage.getItem("goftino")?s+"?o="+localStorage.getItem("goftino"):s;e.parentNode.insertBefore(g,e);}();
</script>
<!---end GOFTINO code--->

<!---start GOFTINO code--->
{{-- <script type="text/javascript">
    !function(){var a=window,d=document;function g(){var g=d.createElement("script"),s="https://www.goftino.com/widget/U0Tcx4",l=localStorage.getItem("goftino");g.type="text/javascript",g.async=!0,g.referrerPolicy="no-referrer-when-downgrade",g.src=l?s+"?o="+l:s;d.getElementsByTagName("head")[0].appendChild(g);}"complete"===d.readyState?g():a.attachEvent?a.attachEvent("onload",g):a.addEventListener("load",g,!1);}();
  </script> --}}
  <!---end GOFTINO code--->


<!--- Add this to set User's Data --->
<script>
    window.addEventListener('goftino_ready', function () {
        Goftino.setUser({
            email: '{{Auth::user()->email}}',
            name: '{{Auth::user()->name.' '.Auth::user()->family}}',
            phone: '{{Auth::user()->mobile}}',
            forceUpdate : true
        });
    });
</script>
</body>
<!-- END: Body-->
</html>
