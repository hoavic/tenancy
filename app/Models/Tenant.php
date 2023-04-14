<?php

namespace App\Models;

use Bpuig\Subby\Traits\HasSubscriptions;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasSubscriptions;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'user_id',
            'name',
            'status', // active, unactive, block,
            'plan', // free, startup, higer, professional
        ];
    }


    public function getDomain()
    {
        $domain = $this->domains[0];

        if(empty($domain)) {return null;}

        if($domain->domain_type === 'subdomain') {
            return 'https://'.$domain->domain.'.'.config('tenancy.central_domains')[0];
        }

        return 'https://'.$domain->domain;
    }

    // relataion

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}