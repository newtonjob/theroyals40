<?php

namespace App\Listeners;

use App\Events\ForgettingTenant;
use App\Events\UsingTenant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ConfigureTenant
{
    protected array $original;

    public function __construct()
    {
        $this->original = config()->get(['app.name', 'mail.from']);
    }

    public function handleUsingTenant(UsingTenant $event): void
    {
        $tenant = $event->tenant;

        $this->configure([
            'app.name'          => $tenant->name,
            'app.url'           => request()->getScheme() . '://' . $tenant->domain,
            'mail.from.name'    => $tenant->name,
            'mail.from.address' => Str::replaceFirst('.', '@', $tenant->domain)
        ]);
    }

    public function handleForgettingTenant(ForgettingTenant $event): void
    {
        $this->configure($this->original);
    }

    public function configure(array $config)
    {
        config()->set($config);

        URL::forceRootUrl(config('app.url'));
        Mail::purge();
    }
}
