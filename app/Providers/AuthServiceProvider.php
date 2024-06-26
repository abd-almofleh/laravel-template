<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    'App\Models\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();
    Passport::routes();

    Passport::tokensExpireIn(now()->addDays(1));

    Passport::refreshTokensExpireIn(now()->addDays(3));

    Passport::personalAccessTokensExpireIn(now()->addMonths(1));

    Gate::before(function ($user, $ability) {
      return $user->hasRole('Super Admin') ? true : null;
    });
  }
}
