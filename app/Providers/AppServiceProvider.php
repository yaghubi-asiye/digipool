<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            $inputs = $validator->getData();
            if(substr( $inputs[$attribute],0,2) == '09')
                return true;
            else
                return false;
        });

        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            $inputs = $validator->getData();
            if(substr( $inputs[$attribute],0,2) != '09')
                return true;
            else
                return false;
        });

        Validator::extend('farsi', function ($attribute, $value, $parameters, $validator) {
            $inputs = $validator->getData();
            $farsi_Char="/^[a-zA-Z0-9]+$/";
            if(preg_match($farsi_Char,$inputs[$attribute]) | preg_match($farsi_Char,$inputs[$attribute]))
                return false;
            else
                return true;
        });
    }
}
