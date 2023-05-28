<?php

namespace App\Providers;

use App\Events\ContratDeleted;
use App\Events\EntretienCreated;
use App\Events\EntretienDeleted;
use App\Events\EntretienUpdated;
use App\Events\ReglementCreated;
use App\Events\ReglementDeleted;
use App\Events\ReglementUpdated;
use App\Events\VidangeCreated;
use App\Events\VidangeDeleted;
use App\Events\VidangeUpdated;
use App\Listeners\ChangeContratStatusOnReglementCreated;
use App\Listeners\ChangeContratStatusOnReglementDeleted;
use App\Listeners\ChangeContratStatusOnReglementUpdated;
use App\Listeners\CreateChargeOnEntretienCreated;
use App\Listeners\CreateChargeOnVidangeCreated;
use App\Listeners\DeleteChargeOnEntretienDeleted;
use App\Listeners\DeleteChargeOnVidangeDeleted;
use App\Listeners\UpdateChargeOnEntretienUpdated;
use App\Listeners\UpdateChargeOnVidangeUpdated;
use App\Listeners\UpdateVehicleStatusOnContratDeleted;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ContratDeleted::class => [
            UpdateVehicleStatusOnContratDeleted::class
        ],
        VidangeCreated::class => [
            CreateChargeOnVidangeCreated::class
        ],
        VidangeDeleted::class => [
            DeleteChargeOnVidangeDeleted::class
        ],
        VidangeUpdated::class => [
            UpdateChargeOnVidangeUpdated::class
        ],
        EntretienCreated::class => [
            CreateChargeOnEntretienCreated::class
        ],
        EntretienDeleted::class => [
            DeleteChargeOnEntretienDeleted::class
        ],
        EntretienUpdated::class => [
            UpdateChargeOnEntretienUpdated::class
        ],
        ReglementCreated::class => [
            ChangeContratStatusOnReglementCreated::class
        ],
        ReglementDeleted::class => [
            ChangeContratStatusOnReglementDeleted::class
        ],
        ReglementUpdated::class => [
            ChangeContratStatusOnReglementUpdated::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
