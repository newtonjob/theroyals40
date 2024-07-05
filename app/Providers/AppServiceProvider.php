<?php

namespace App\Providers;

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

        $this->configureQueues();
    }

    public function configureQueues()
    {
        Queue::createPayloadUsing(fn () => ['domain' => Tenant::current()->domain]);

        Queue::before(function (JobProcessing $event) {
            ($domain = $event->job->payload()['domain']) && Tenant::start($domain);
        });
    }
}
