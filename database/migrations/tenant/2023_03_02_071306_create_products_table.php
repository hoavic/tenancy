<?php

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
            $table->string('SKU');
            $table->string('supplier_product_id')->nullable();

            $table->bigInteger('user_id');

            $table->text('name');
            $table->longText('description')->nullable();
            $table->tinyText('short_description')->nullable();
            $table->integer('status')->default(0);
            $table->string('slug')->unique();
            $table->string('guid');
            $table->smallInteger('type')->default(0);
            
            $table->integer('price')->nullable();
            $table->float('discount')->default(0);
            $table->dateTime('start_at')->nullable()->default(null);
            $table->dateTime('end_at')->nullable()->default(null);

            $table->integer('shop')->default(0);

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
