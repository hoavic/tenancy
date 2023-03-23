<?php

use App\Models\Tenant\Backend\Commerce\Product;
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
        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');

            /* $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete(); */
            $table->string('name')->unique();
            $table->string('group')->nullable();
            $table->enum('visual', ['text', 'color', 'image'])->default('text');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
};
