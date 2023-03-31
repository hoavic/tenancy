<?php

use App\Models\Tenant\Backend\Commerce\Customer;
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

            $table->smallInteger('type')->default(0);
            $table->string('status')->default(0); // 0: Draft - 1: New - 2: Checkout - 3: Paid - 4: Failed - 5: Shipped - 6: Delivered - 7: Returned - 8: Complete
            $table->string('update_by')->nullable();

            $table->bigInteger('sub_total')->nullable()->default(0);
            $table->bigInteger('tax')->nullable()->default(0);
            $table->bigInteger('shipping')->nullable()->default(0);

            $table->bigInteger('total')->nullable()->default(0);
            $table->string('promo')->nullable()->default(null);
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
        Schema::dropIfExists('orders');
    }
};
