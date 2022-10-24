<?php

namespace App\Providers;

use App\Services\ListedHorsesService;
use App\Services\Security\SecurityService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register()
  {
    $this->app->singleton(SecurityService::class);
    $this->app->singleton(ListedHorsesService::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot()
  {
    // $this->registerPolicies();
    Schema::defaultStringLength(191);
  }
}
