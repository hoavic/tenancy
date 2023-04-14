<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Domain as BaseDomain;

class Domain extends BaseDomain
{

    public function getDomain()
    {

        if($this->domain_type === 'subdomain') {
            return 'https://'.$this->domain.'.'.config('tenancy.central_domains')[0];
        }

        return 'https://'.$this->domain;
    }

}