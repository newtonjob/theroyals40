<?php

namespace App\Providers;

use App\Listeners\ConfigureTenant;
use App\Models\Tenant;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class TenancyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ConfigureTenant::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureRequests();
        $this->configureQueues();
    }

    /**
     * Configure queues to run within the context of the tenant that dispatched the job.
     */
    public function configureQueues(): void
    {
        Queue::before(function (JobProcessing $event) {
            $id = Context::get('tenantId');
            $id ? Tenant::findOrFail($id)->use() : Tenant::current()?->forget();
        });
    }

    /**
     * Configure requests to run within the context of the tenant.
     */
    public function configureRequests(): void
    {
        if (! $this->app->runningInConsole()) {
            Cache::remember(
                $domain = request()->host(), now()->addHour(),
                fn () => Tenant::whereDomain($domain)->first()
            )?->use();
        }
    }
}
