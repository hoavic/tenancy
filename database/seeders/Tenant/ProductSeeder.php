<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant;
use App\Models\Tenant\Backend\Commerce\Attribute;
use App\Models\Tenant\Backend\Commerce\AttributeValue;
use App\Models\Tenant\Backend\Commerce\Brand;
use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Inventory\Location;
use App\Models\Tenant\Backend\Commerce\ProductCategory;
use App\Models\Tenant\Backend\Inventory\Item;
use App\Models\Tenant\Backend\Inventory\Stock;
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
            'type'      => 'basic',
        ]);

        $product->product_categories()->sync(array(1));

        $item = Item::create([
            'product_id'    => $product->id,
        ]);

        $product2 = Product::create([
            'name'     => 'Sản phẩm demo',
            'status'    => 'public',
            'is_publish'    => 1,
            'published_at' => now(),
            'slug'     => 'san-pham-demo',
            'guid'      => '/san-pham-demo',
            'type'      => 'basic',
        ]);

        $product2->product_categories()->sync(array(1));

        $item2 = Item::create([
            'product_id'    => $product2->id,
        ]);

        Artisan::call('vietnamzone:import');

        $location = Location::create([
            'name'      =>  'Kho hàng tổng',
            'type'      =>  '{"value": "depot", "label": "Tổng kho"}',
        ]);

        Stock::create([
            'location_id' => $location->id,
        ]);

        Supplier::create([
            'company_name'  => 'Nhà cung cấp mặc định',
            'contact_name'  => 'Mặc định',
            'contact_title' => 'Nhân viên',
            'ranking'       => 'A',
        ]);

        $size = Attribute::create([
            'name' => 'Size',
            'visual' => 'text',
        ]);

        $sizeValues = ['S', 'M', 'L', 'XL', 'XXL'];

        foreach($sizeValues as $value) 
        {
            AttributeValue::create([
                'attribute_id' => $size->id,
                'label' => $value,
                'value' => $value,
            ]);
        }

        $ram = Attribute::create([
            'name' => 'RAM',
            'visual' => 'text',
        ]);

        $ramValues = ['1G', '2G', '3G', '4G', '5G', '6G', '8G', '16G', '32G', '64G'];

        foreach($ramValues as $value) 
        {
            AttributeValue::create([
                'attribute_id' => $ram->id,
                'label' => $value,
                'value' => $value,
            ]);
        }

        $bonho = Attribute::create([
            'name' => 'Bộ nhớ',
            'visual' => 'text',
        ]);

        $bonhoValues = ['246GB', '512GB', '1TB', '2TB'];

        foreach($bonhoValues as $value) 
        {
            AttributeValue::create([
                'attribute_id' => $bonho->id,
                'label' => $value,
                'value' => $value,
            ]);
        }

    }
}
