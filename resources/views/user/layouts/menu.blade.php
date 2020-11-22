
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow " data-scroll-to-active="true" data-img="{{asset('')}}app-assets/images/backgrounds/05.jpg">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            {{-- <li class="nav-item mr-auto"><a class="navbar-brand" href="{{asset('')}}"><img class="brand-logo" alt="Chameleon admin logo" src="{{asset('')}}app-assets/images/logo/logo.png"/> --}}
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{asset('')}}"><img class="brand-logo" alt="Chameleon admin logo" src="{{asset('')}}app-assets/images/logo/Digipool-logo/logo-white.png"/>
                    <h3 class="brand-text">دیجی پول</h3></a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="navigation-background"></div>
    <div class="main-menu-content" style="visibility: hidden">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{asset('')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">داشبورد</span></a>
            </li>
            <li class=" nav-item"><a href="{{asset('')}}ticket"><i class="ft-message-square"></i><span class="menu-title" data-i18n="">پشتیبانی</span></a>
            </li>
            <li class=" nav-item"><a href="{{asset('')}}orders"><i class="ft-monitor"></i><span class="menu-title" data-i18n="">سفارشات</span></a>
            </li>
            <li class=" nav-item"><a href="{{asset('')}}wallet"><i class="icon-wallet"></i><span class="menu-title" data-i18n="">کیف پول</span></a>
            </li>


            <li class=" nav-item">
                <a href="#">
                    <i class=""><img src="{{asset('')}}app-assets/images/currency/perfectmoney.svg" style="width: 30px"></i>
                    <span class="menu-title" data-i18n="">پرفکت مانی</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{asset('')}}perfectmoney">
                            <img src="{{asset('')}}app-assets/images/currency/perfectmoney.svg" width="25px"> پرفکت مانی
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{asset('')}}PMvoucher">
                            <img src="{{asset('')}}app-assets/images/currency/perfectmoney.svg" width="25px"> ووچر پرفکت مانی
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="{{asset('')}}PSVouchers">
                    <i class=""><img src="{{asset('')}}app-assets/images/currency/PSVouchers.svg" style="width: 27px"></i>
                    <span class="menu-title" data-i18n="">پرمیوم ووچر</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="#">
                    <i class="icon-user-following"></i><span class="menu-title" data-i18n="">احراز هویت</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{asset('')}}profile/location">
                              1- احراز آدرس و تلفن
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{asset('')}}profile/identification">
                            2- تصویر مدارک شناسایی
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{asset('')}}profile/selfie">
                            3- تصویر سلفی
                        </a>
                    </li>
                </ul>
            </li>
            <!--
            <li class=" nav-item"><a href="{{asset('')}}invitation"><i class="icon-magnet"></i><span class="menu-title" data-i18n="">کسب درآمد</span></a>
            -->
            </li>

            <li class=" nav-item"><a href="{{asset('')}}profile/financial"><i class="icon-credit-card"></i><span class="menu-title" data-i18n="">کارت های بانکی</span></a>
            </li>
            <li class=" nav-item"><a href="{{asset('')}}profile"><i class="icon-user"></i><span class="menu-title" data-i18n="">حساب کاربری</span></a>
            </li>
            <li class=" nav-item"><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-logout"></i><span class="menu-title" data-i18n="">خروج</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
