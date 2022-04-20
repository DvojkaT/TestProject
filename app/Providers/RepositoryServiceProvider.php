<?php


namespace App\Providers;

use App\Repositories\Abstracts\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $repositories = [
        UserRepository::class => UserRepositoryEloquent::class,
    ];

    /**
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    public function boot()
    {

    }
}
