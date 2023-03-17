<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant;
use App\Models\Tenant\Backend\Commerce\Brand;
use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Inventory\Location;
use App\Models\Tenant\Backend\Commerce\ProductCategory;
use App\Models\Tenant\Backend\Inventory\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Database\Models\Domain;

class ProductSeeder extends Seeder
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

        ProductCategory::create([
            'title'     => 'Chưa phân loại',
            'parent_id' => 0,
            'count'     => 0,
            'slug'      => 'chua-phan-loai',
            'guid'      => '/chua-phan-loai'
        ]);

        Brand::create([
            'title'      => 'Không',
            'count'     => 0,
            'slug'      => 'khong',
            'guid'      => '/khong'
        ]);

        $product = Product::create([
            'name'     => 'Sản phẩm mẫu',
            'status'    => 'public',
            'is_publish'    => 1,
            'published_at' => now(),
            'slug'     => 'san-pham-mau',
            'guid'      => '/san-pham-mau',
        ]);

        $product->product_categories()->sync(array(1));

        $product2 = Product::create([
            'name'     => 'Sản phẩm demo',
            'status'    => 'public',
            'is_publish'    => 1,
            'published_at' => now(),
            'slug'     => 'san-pham-demo',
            'guid'      => '/san-pham-demo',
        ]);

        $product2->product_categories()->sync(array(1));

        Artisan::call('vietnamzone:import');

        Location::create([
            'name'      =>  'Kho hàng mặc định',
            'type'      =>  '{"value": "warehouse", "label": "Kho"}',
        ]);

        Supplier::create([
            'company_name'  => 'Nhà cung cấp mặc định',
            'contact_name'  => 'Mặc định',
            'contact_title' => 'Nhân viên',
            'ranking'       => 'A',
        ]);

        

    }
}
