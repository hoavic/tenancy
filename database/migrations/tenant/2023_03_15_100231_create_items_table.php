<?php

use App\Models\Tenant\Backend\Commerce\Brand;
use App\Models\Tenant\Backend\Order;
use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Inventory\Location;
use App\Models\Tenant\Backend\Inventory\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(Brand::class)->nullable()->constrained();
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignIdFor(Supplier::class)->constrained();
            $table->foreignIdFor(Location::class)->nullable()->constrained();

            $table->string('SKU')->nullable(); //Stock Keeping Unit
            $table->bigInteger('MRP')->default(0); // Maximum Retail Price
            $table->bigInteger('discount')->default(0);
            $table->bigInteger('price')->default(0);

            $table->smallInteger('quantity')->default(0);
            $table->smallInteger('sold')->default(0);

            $table->smallInteger('available')->default(0);
            $table->smallInteger('defective')->default(0);

            $table->bigInteger('created_by')->nullable()->default(null);
            $table->bigInteger('updated_by')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
