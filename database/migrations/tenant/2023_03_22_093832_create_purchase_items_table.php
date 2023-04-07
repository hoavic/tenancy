<?php

use App\Models\Tenant\Backend\Inventory\Item;
use App\Models\Tenant\Backend\Inventory\Purchase;
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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->foreignIdFor(Purchase::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Item::class)->constrained();

            $table->bigInteger('price')->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_items');
    }
};
