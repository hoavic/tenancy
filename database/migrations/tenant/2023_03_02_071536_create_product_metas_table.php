<?php

use App\Models\Tenant\Backend\Product\Product;
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
        Schema::create('product_metas', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('visual', ['text', 'color', 'image'])->default('text');
            
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
        Schema::dropIfExists('product_metas');
    }
};
