<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class StartTenancy
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        Cache::remember(
            $domain = $request->host(), now()->addHour(),
            fn () => Tenant::whereDomain($domain)->firstOrFail()
        )->use();

        return $next($request);
    }
}
