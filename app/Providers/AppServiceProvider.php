<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('cpf', '\App\Utils\CpfValidation@validate');
        Validator::extend('cep', '\App\Utils\CepValidation@validate');
        Validator::extend('phone', '\App\Utils\PhoneValidation@validate');
        Validator::extend('cellphone', '\App\Utils\CellphoneValidation@validate');
    }
}
