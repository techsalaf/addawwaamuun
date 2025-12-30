<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use RachidLaasri\LaravelInstaller\Events\LaravelInstallerFinished;
use App\Listeners\CreateDefaultRoutes;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event listener mappings for the application.
   *
   * @var array
   */
  protected $listen = [
    Registered::class => [
      SendEmailVerificationNotification::class,
    ],
    LaravelInstallerFinished::class => [
      CreateDefaultRoutes::class,
    ],
  ];

  /**
   * Register any events for your application.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
