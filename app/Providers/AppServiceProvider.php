<?php

namespace App\Providers;

use App\Services\Abstracts\MailServiceInterface;
use App\Services\Abstracts\UserServiceInterface;
use App\Services\MailService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $services = [
        UserServiceInterface::class => UserService::class,
        MailServiceInterface::class => MailService::class,
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
