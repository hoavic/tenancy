<?php

namespace App\Http\Middleware\Tenant;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TenantTrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts()
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
