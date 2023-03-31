<?php

use App\Models\Tenant\Backend\Commerce\AttributeValue;
use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Commerce\ProductAttribute;
use App\Models\Tenant\Backend\Inventory\Item;
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
        Schema::create('variants', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Item::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ProductAttribute::class)->constrained('product_attribute')->cascadeOnDelete();
            $table->foreignIdFor(AttributeValue::class)->constrained('attribute_values')->cascadeOnDelete();
            $table->string('label')->nullable();

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
        Schema::dropIfExists('variants');
    }
};
