<?php

namespace App\Listeners;

use App\Events\ForgettingTenant;
use App\Events\UsingTenant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ConfigureTenant
{
    protected array $original;

    public function __construct()
    {
        $this->original = config()->get(['mail.from.name']);
    }

    public function handleUsingTenant(UsingTenant $event): void
    {
        config()->set([
            'mail.from.name' => $event->tenant->name .' (via '.config('app.name').')',
        ]);

        if (app()->runningInConsole()) {
            URL::forceRootUrl(request()->getScheme().'://'.$event->tenant->domain);
            Mail::purge();
        }
    }

    public function handleForgettingTenant(ForgettingTenant $event): void
    {
        config()->set($this->original);

        if (app()->runningInConsole()) {
            URL::forceRootUrl(config('app.url'));
            Mail::purge();
        }
    }
}
