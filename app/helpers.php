<?php

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * Get the current active tenant.
 */
function tenant(): ?Tenant
{
    return Tenant::current();
}

function user(): Authenticatable|User|null
{
    return Auth::user();
}
