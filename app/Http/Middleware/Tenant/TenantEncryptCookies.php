<?php

namespace App\Http\Middleware\Tenant;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class TenantEncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
