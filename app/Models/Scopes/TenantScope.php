<?php

namespace App\Models\Scopes;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->when(Tenant::current())->where(function (Builder $builder) {
            $builder->whereBelongsTo(Tenant::current())
                ->orWhereNull($builder->qualifyColumn('tenant_id'));
        });
    }

    public function extend(Builder $builder)
    {
        $builder->macro('withoutTenancy',
            fn (Builder $builder) => $builder->withoutGlobalScope($this)
        );
    }
}
