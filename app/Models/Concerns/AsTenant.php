<?php

namespace App\Models\Concerns;

use App\Events\ForgettingTenant;
use App\Events\UsingTenant;
use Illuminate\Support\Facades\Context;

trait AsTenant
{
    /**
     * Use the tenant as current tenant for the rest of the request.
     */
    public function use(): void
    {
        UsingTenant::dispatch($this);

        app()->instance('tenant', $this);

        Context::add('tenant', $this->id);
    }

    /**
     * Forget the tenant as being the current tenant.
     */
    public function forget(): void
    {
        ForgettingTenant::dispatch($this);

        app()->forgetInstance('tenant');

        Context::forget('tenant');
    }

    /**
     * Run the given callback in the tenant's context
     */
    public function run(callable $callback): mixed
    {
        $original = static::current();

        $this->use();

        return tap($callback($this), function () use ($original) {
            $original ? $original->use() : $this->forget();
        });
    }

    public static function current(): ?static
    {
        return app()->has('tenant') ? app('tenant') : null;
    }
}
