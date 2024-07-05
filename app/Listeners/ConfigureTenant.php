<?php

namespace App\Listeners;

use App\Events\ForgettingTenant;
use App\Events\UsingTenant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'mail.from.name' => $tenant->name,
            'mail.from.address' => Str::replaceFirst('.', '@', $tenant->domain)
        ]);

        Mail::purge();
    }

    public function handleForgettingTenant(ForgettingTenant $event): void
    {
        //
    }
}
