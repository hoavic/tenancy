<?php

use App\Models\Tenant\Backend\Inventory\Stock;
use App\Models\Tenant\Backend\Inventory\Supplier;
use App\Models\Tenant\User;
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
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            /* $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete(); */
            $table->foreignIdFor(Supplier::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Stock::class)->constrained()->cascadeOnDelete();

            $table->string('status')->default('created');
            $table->string('update_by')->nullable();
            $table->bigInteger('sub_total')->nullable()->default(0);
            $table->bigInteger('tax')->nullable()->default(0);
            $table->bigInteger('shipping')->nullable()->default(0);

            $table->string('promo')->nullable();
            $table->bigInteger('discount')->nullable()->default(0);

            $table->bigInteger('grand_total')->nullable()->default(0);

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
        Schema::dropIfExists('purchases');
    }
};
