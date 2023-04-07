<?php

use App\Models\Tenant\Backend\Commerce\Customer;
use App\Models\Tenant\Backend\Inventory\Stock;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(Customer::class)->nullable()->constrained();
            $table->foreignIdFor(Stock::class)->constrained('stocks');

            $table->string('type')->default('pos');
            $table->string('status')->nullable()->default('draft'); // 0: Draft - 1: New - 2: Checkout - 3: Paid - 4: Failed - 5: Shipped - 6: Delivered - 7: Returned - 8: Complete
            $table->integer('update_by')->nullable();

            $table->bigInteger('sub_total')->nullable()->default(0);
            $table->bigInteger('tax')->nullable()->default(0);
            $table->bigInteger('shipping')->nullable()->default(0);

            $table->string('promo')->nullable()->default(null);
            $table->bigInteger('discount')->nullable()->default(0);
            $table->bigInteger('grand_total')->nullable()->default(0);

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
        Schema::dropIfExists('orders');
    }
};
