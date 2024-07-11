<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $serviceBindings=[
      'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
      'App\Services\Interfaces\ProvinceServiceInterface' => 'App\Services\ProvinceService',
      'App\Services\Interfaces\DistrictServiceInterface' => 'App\Services\DistrictService',
      'App\Repositories\Interfaces\UserRepositoryInterface'=> 'App\Repositories\UserRepository',
      'App\Repositories\Interfaces\DistrictRepositoryInterface'=> 'App\Repositories\DistrictRepository',
      'App\Repositories\Interfaces\ProvinceRepositoryInterface'=> 'App\Repositories\ProvinceRepository',
      'App\Repositories\Interfaces\PostCatalogueRepositoryInterface'=> 'App\Repositories\PostCatalogueRepository'
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->serviceBindings as $key=>$val){
            $this->app->bind($key,$val);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
