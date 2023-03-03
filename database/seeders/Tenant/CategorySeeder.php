<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant;
use App\Models\Tenant\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Database\Models\Domain;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

/*         $tenant = Tenant::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->first();

        $domain = Domain::where('tenant_id', $tenant->id)->first();

        if ($domain->domain_type === 'subdomain') {
            $guid = $domain->domain.'.'.config('tenancy.central_domains')[0];
        } else {
            $guid = $domain->domain;
        } */

        Category::create([
            'title'     => 'Chưa phân loại',
            'parent_id' => 0,
            'count'     => 0,
            'slug'      => 'chua-phan-loai',
            'guid'      => '/chua-phan-loai'
        ]);
    }
}
