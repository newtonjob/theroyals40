<?php

namespace App\Providers;

use App\Listeners\ConfigureTenant;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::forceAssetInjection();

        Model::unguard();

        $this->configureTenancy();
    }

    /**
     * Configure the app for multitenancy.
     */
    public function configureTenancy()
    {
        $this->app->singleton(ConfigureTenant::class);

        Queue::createPayloadUsing(fn () => ['tenantId' => Tenant::current()?->id]);

        Queue::before(function (JobProcessing $event) {
            ($tenantId = $event->job->payload()['tenantId'])
                ? Tenant::find($tenantId)->use()
                : Tenant::current()?->forget();
        });
    }
}
