<?php

namespace App\Listeners;

use App\Events\ForgettingTenant;
use App\Events\UsingTenant;

class ConfigureTenant
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handleUsingTenant(UsingTenant $event): void
    {
        $tenant = $event->tenant;

        config()->set([
            'app.name' => $tenant->name,
            'mail.from.name' => $tenant->name
        ]);
    }

    public function handleForgettingTenant(ForgettingTenant $event): void
    {
        //
    }
}
