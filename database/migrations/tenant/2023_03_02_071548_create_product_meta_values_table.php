<?php

use App\Models\Tenant\Backend\Product\Product;
use App\Models\Tenant\ProductMeta;
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
        Schema::create('product_meta_values', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ProductMeta::class)->constrained()->cascadeOnDelete();
            $table->string('value');
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
        Schema::dropIfExists('product_meta_values');
    }
};
