<?php

namespace App\Models\Concerns;

use App\Events\ForgettingTenant;
use App\Events\UsingTenant;
use Illuminate\Support\Facades\Cache;

trait AsTenant
{
    /**
     * Use the tenant as current tenant for the rest of the request.
     */
    public function use(): static
    {
        UsingTenant::dispatch($this);

        return app()->instance('tenant', $this);
    }

    /**
     * Forget the tenant as current tenant.
     */
    public function forget(): void
    {
        ForgettingTenant::dispatch($this);

        app()->forgetInstance('tenant');
    }

    /**
     * Run the given callback in the tenant's context
     */
    public function run(callable $callback): mixed
    {
        $original = static::current();

        $this->use();

        return tap(rescue(fn () => $callback($this)), function () use ($original) {
            $original ? $original->use() : $this->forget();
        });
    }

    public static function current(): ?static
    {
        return app()->has('tenant') ? app('tenant') : null;
    }

    public static function start($domain): static
    {
        return Cache::remember(
            $domain, now()->addHour(), fn () => static::whereDomain($domain)->firstOrFail()
        )->use();
    }
}
