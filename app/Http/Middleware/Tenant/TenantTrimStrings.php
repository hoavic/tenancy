<?php

namespace App\Http\Middleware\Tenant;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TenantTrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
