<?php

namespace App\Providers;

use App\Services\Abstracts\DepartmentServiceInterface;
use App\Services\Abstracts\AuthServiceInterface;
use App\Services\Abstracts\UserServiceInterface;
use App\Services\AuthService;
use App\Services\DepartmentService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $services = [
        UserServiceInterface::class => UserService::class,
        DepartmentServiceInterface::class => DepartmentService::class,
        AuthServiceInterface::class => AuthService::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->services as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
