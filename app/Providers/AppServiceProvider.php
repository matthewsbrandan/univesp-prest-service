<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\ServiceObserver;
use App\Models\Service;

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
    Service::observe(ServiceObserver::class);
  }
}
