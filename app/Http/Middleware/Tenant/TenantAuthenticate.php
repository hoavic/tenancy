<?php

namespace App\Http\Middleware\Tenant;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class TenantAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('ten.login');
        }
    }
}
