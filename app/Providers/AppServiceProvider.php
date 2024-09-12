<?php

namespace App\Providers;

use App\Http\Middleware\StartTenancy;
use App\Listeners\ConfigureTenant;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Context;
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
        $this->app->singleton(ConfigureTenant::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::forceAssetInjection();

        Model::unguard();

        $this->configureQueues();

        Livewire::addPersistentMiddleware([
            //StartTenancy::class,
        ]);
    }

    /**
     * Configure queues to run within the context of the tenant that dispatched the job.
     */
    public function configureQueues()
    {
        Queue::before(function (JobProcessing $event) {
            $id = Context::get('tenantId');
            $id ? Tenant::findOrFail($id)->use() : Tenant::current()?->forget();
        });
    }
}
