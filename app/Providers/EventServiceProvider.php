<?php

namespace App\Providers;

use App\Events\EmailActivated;
use App\Events\RegisterCreated;
use App\Listeners\SendNotifActive;
use App\Listeners\SendRegisterEmail;
// observers
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        RegisterCreated::class => [
            SendRegisterEmail::class,
        ],
        EmailActivated::class => [
            SendNotifActive::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // observers
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
