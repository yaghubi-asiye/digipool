<div class="card o-hidden d-none d-md-block">

    <div class="card-body p-md-0">
        <div class="card-body text-center">
            <div class="mb-3 mx-auto rounded-circle w-60">
                <img class="box-shadow-3 rounded-circle" src="{{asset('')}}app-assets/images/portrait/small/1.jpg" width="50%" alt="">
            </div>
            <h5 class="m-0">{{Auth::user()->name .' '.Auth::user()->family }}</h5>
            <p class="mt-0">{{Auth::user()->email??Auth::user()->mobile}}</p>
            <hr>

            <div class="list-group mt-2 text-left menu-profile">
                <a href="{{asset('')}}profile" class="list-group-item list-group-item-action"><i class="ft-user mr-1"></i>اطلاعات شخصی</a>
                <a href="{{asset('')}}profile/location" class="list-group-item list-group-item-action"><i class="icon-pin mr-1"></i>احراز آدرس و تلفن (1) </a>
                <a href="{{asset('')}}profile/identification" class="list-group-item list-group-item-action"><i class="ft ft-image mr-1"></i>آپلود تصویر مدارک (2) </a>
                <a href="{{asset('')}}profile/selfie" class="list-group-item list-group-item-action"><i class="icon-picture mr-1"></i>آپلود تصویر سلفی (3) </a>
                <a href="{{asset('')}}profile/financial" class="list-group-item list-group-item-action"><i class="ft-credit-card mr-1"></i>اطلاعات مالی </a>
                <a href="{{asset('')}}profile/password" class="list-group-item list-group-item-action"><i class="ft-lock mr-1"></i>کلمه عبور </a>
                <a href="{{asset('')}}profile/two-factor-authentication" class="list-group-item list-group-item-action"><i class="ft-flag mr-1"></i>ورود دو مرحله ای </a>
            </div>
        </div>
    </div>
</div>