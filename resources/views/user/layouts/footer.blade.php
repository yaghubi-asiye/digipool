

<!-- BEGIN: Customizer-->
<div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block"><a class="customizer-close" href="#"><i class="ft-x font-medium-3"></i></a><a class="customizer-toggle bg-primary box-shadow-3" href="#" id="customizer-toggle-setting"><i class="ft-settings font-medium-3 spinner white"></i></a><div class="customizer-content p-2">
        <h5 class="mt-1 mb-1 text-bold-500">تنظیمات رنگ ناوبری</h5>
        <div class="navbar-color-options clearfix">
            <div class="gradient-colors mb-1 clearfix">
                <div class="bg-gradient-x-purple-blue navbar-color-option" data-bg="bg-gradient-x-purple-blue" title="bg-gradient-x-purple-blue"></div>
                <div class="bg-gradient-x-purple-red navbar-color-option" data-bg="bg-gradient-x-purple-red" title="bg-gradient-x-purple-red"></div>
                <div class="bg-gradient-x-blue-green navbar-color-option" data-bg="bg-gradient-x-blue-green" title="bg-gradient-x-blue-green"></div>
                <div class="bg-gradient-x-orange-yellow navbar-color-option" data-bg="bg-gradient-x-orange-yellow" title="bg-gradient-x-orange-yellow"></div>
                <div class="bg-gradient-x-blue-cyan navbar-color-option" data-bg="bg-gradient-x-blue-cyan" title="bg-gradient-x-blue-cyan"></div>
                <div class="bg-gradient-x-red-pink navbar-color-option" data-bg="bg-gradient-x-red-pink" title="bg-gradient-x-red-pink"></div>
            </div>
            <div class="solid-colors clearfix">
                <div class="bg-primary navbar-color-option" data-bg="bg-primary" title="اولیه"></div>
                <div class="bg-success navbar-color-option" data-bg="bg-success" title="موفقیت"></div>
                <div class="bg-info navbar-color-option" data-bg="bg-info" title="اطلاعات"></div>
                <div class="bg-dark navbar-color-option " data-bg="bg-dark" title="مشکی"></div>
                <div class="bg-danger navbar-color-option" data-bg="bg-danger" title="خطر"></div>
                <div class="bg-blue navbar-color-option " data-bg="bg-blue" title="آبی"></div>
            </div>
        </div>

        <hr>

        <h5 class="my-1 text-bold-500">گزینه های طرح بندی</h5>
        <div class="row">
            <div class="col-12">
                <div class="d-inline-block custom-control custom-radio mb-1 col-4">
                    <input type="radio" class="custom-control-input bg-primary" name="layouts" id="default-layout" checked>
                    <label class="custom-control-label" for="default-layout">پیش فرض</label>
                </div>
                <div class="d-inline-block custom-control custom-radio mb-1 col-4">
                    <input type="radio" class="custom-control-input bg-primary" name="layouts" id="fixed-layout">
                    <label class="custom-control-label" for="fixed-layout">ثابت</label>
                </div>
                <div class="d-inline-block custom-control custom-radio mb-1 col-4">
                    <input type="radio" class="custom-control-input bg-primary" name="layouts" id="static-layout">
                    <label class="custom-control-label" for="static-layout">استاتیک</label>
                </div>
                <div class="d-inline-block custom-control custom-radio mb-1">
                    <input type="radio" class="custom-control-input bg-primary" name="layouts" id="boxed-layout">
                    <label class="custom-control-label" for="boxed-layout">جعبه ای</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-inline-block custom-control custom-checkbox mb-1">
                    <input type="checkbox" class="custom-control-input bg-primary" name="right-side-icons" id="right-side-icons">
                    <label class="custom-control-label" for="right-side-icons">آیکون سمت راست</label>
                </div>
            </div>
        </div>

        <hr>

        <h5 class="mt-1 mb-1 text-bold-500">پس زمینه منوی نوار کناری</h5>
        <!-- <div class="sidebar-color-options clearfix">
            <div class="bg-black sidebar-color-option" data-sidebar="menu-dark" title="مشکی"></div>
            <div class="bg-white sidebar-color-option" data-sidebar="menu-light" title="سفید"></div>
        </div> -->
        <div class="row sidebar-color-options ml-0">
            <label for="sidebar-color-option" class="card-title font-medium-2 mr-2">حالت سفید</label>
            <div class="text-center mb-1">
                <input type="checkbox" id="sidebar-color-option" class="switchery" data-size="xs"/>
            </div>
            <label for="sidebar-color-option" class="card-title font-medium-2 ml-2">حالت تاریک</label>
        </div>

        <hr>

        <label for="collapsed-sidebar" class="font-medium-2">سقوط منو</label>
        <div class="float-right">
            <input type="checkbox" id="collapsed-sidebar" class="switchery" data-size="xs"/>
        </div>

        <hr>

        <!--Sidebar Background Image Starts-->
        <h5 class="mt-1 mb-1 text-bold-500">تصویر پس زمینه نوار کناری</h5>
        <div class="cz-bg-image row">
            <div class="col mb-3">
                <img src="{{asset('')}}app-assets/images/backgrounds/04.jpg" class="rounded sidiebar-bg-img" width="50" height="100" alt="background image">
            </div>
            <div class="col mb-3">
                <img src="{{asset('')}}app-assets/images/backgrounds/01.jpg" class="rounded sidiebar-bg-img" width="50" height="100" alt="background image">
            </div>
            <div class="col mb-3">
                <img src="{{asset('')}}app-assets/images/backgrounds/02.jpg" class="rounded sidiebar-bg-img" width="50" height="100" alt="background image">
            </div>
            <div class="col mb-3">
                <img src="{{asset('')}}app-assets/images/backgrounds/05.jpg" class="rounded sidiebar-bg-img selected" width="50" height="100" alt="background image">
            </div>
        </div>
        <!--Sidebar Background Image Ends-->

        <!--Sidebar BG Image Toggle Starts-->
        <div class="sidebar-image-visibility">
            <div class="row ml-0">
                <label for="toggle-sidebar-bg-img" class="card-title font-medium-2 mr-2">مخفی کردن تصویر</label>
                <div class="text-center mb-1">
                    <input type="checkbox" id="toggle-sidebar-bg-img" class="switchery" data-size="xs" checked/>
                </div>
                <label for="toggle-sidebar-bg-img" class="card-title font-medium-2 ml-2">نمایش تصویر</label>
            </div>
        </div>
        <!--Sidebar BG Image Toggle Ends-->

        <hr>

        <div class="text-center">
            <button id="twitter" class="btn btn-social-icon btn-twitter sharrre mr-1"><i class="la la-twitter"></i></button>
            <button id="facebook" class="btn btn-social-icon btn-facebook sharrre mr-1"><i class="la la-facebook"></i></button>
            <button id="google" class="btn btn-social-icon btn-google sharrre"><i class="la la-google"></i></button>
        </div>
    </div>
</div>
<!-- End: Customizer-->


<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2019  &copy; کپی رایت: تمامی حقوق دیجی پول محفوظ است.</span>
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
            <li class="list-inline-item"><a class="my-1" href="https://digipool.net" target="_blank">صفحه اصلی</a></li>
            <li class="list-inline-item"><a class="my-1" href="https://digipool.net/what-is-perfect-money" target="_blank"> بلاگ</a></li>
        </ul>
    </div>
</footer>
<!-- END: Footer-->
