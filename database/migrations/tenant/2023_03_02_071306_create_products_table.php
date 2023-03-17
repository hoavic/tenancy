<?php

use App\Models\Tenant\Backend\Commerce\Brand;
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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SKU')->nullable();
            $table->string('supplier_product_id')->nullable();

            $table->bigInteger('user_id')->default(1);

            $table->bigInteger('featured_id')->nullable();
            $table->text('name');
            $table->longText('description')->nullable();
            $table->tinyText('short_description')->nullable();
            $table->string('status');
            $table->string('slug')->nullable()->unique();
            $table->string('guid');
            $table->smallInteger('type')->default(0);
            
            $table->bigInteger('price')->nullable();
            $table->bigInteger('discount')->nullable()->default(0);
            $table->dateTime('start_at')->nullable()->default(null);
            $table->dateTime('end_at')->nullable()->default(null);

            $table->integer('shop')->nullable()->default(0);

            $table->foreignIdFor(Brand::class)->nullable()->default(1)->constrained();

            $table->smallInteger('quantity')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();

            $table->boolean('is_publish');
            $table->dateTime('published_at');    
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
        Schema::dropIfExists('products');
    }
};
