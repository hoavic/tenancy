<?php

use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Commerce\Attribute;
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
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');

/*             $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete(); */
            $table->foreignIdFor(Attribute::class)->constrained()->cascadeOnDelete();
            $table->string('label')->nullable();
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_values');
    }
};
