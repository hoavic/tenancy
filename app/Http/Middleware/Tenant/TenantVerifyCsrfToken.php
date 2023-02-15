<?php

namespace App\Http\Middleware\Tenant;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class TenantVerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
