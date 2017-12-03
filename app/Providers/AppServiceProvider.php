<?php

namespace App\Providers;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->registerPolicies();
        Passport::routes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
