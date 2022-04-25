<?php


namespace App\Providers;

use App\Repositories\Abstracts\DepartmentRepository;
use App\Repositories\Abstracts\PositionRepository;
use App\Repositories\Abstracts\RoleRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Repositories\Abstracts\UserTokenRepository;
use App\Repositories\DepartmentRepositoryEloquent;
use App\Repositories\PositionRepositoryEloquent;
use App\Repositories\RoleRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\UserTokenRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $repositories = [
        UserRepository::class => UserRepositoryEloquent::class,
        RoleRepository::class => RoleRepositoryEloquent::class,
        UserTokenRepository::class => UserTokenRepositoryEloquent::class,
        DepartmentRepository::class => DepartmentRepositoryEloquent::class,
        PositionRepository::class => PositionRepositoryEloquent::class,
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
