<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\IUserTokenRepository;
use App\Repositories\User\UserTokenRepository;
use App\Repositories\IBaseRepository;
use App\Repositories\BaseRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    private $_listRepoMapInterface =[
        IBaseRepository::class =>BaseRepository::class,
        IUserRepository::class => UserRepository::class,
        IUserTokenRepository::class => UserTokenRepository::class,
    ];
    public function register()
    {
        //
        foreach ($this->_listRepoMapInterface as $interface => $repository) {
            $this->app->bind($interface, $repository);
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
