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
            $table->string('status');
            $table->string('status_update_by');

            $table->float('sub_total')->nullable()->default(0);
            $table->float('item_discount')->nullable()->default(0);
            $table->float('tax')->nullable()->default(0);
            $table->float('shipping')->nullable()->default(0);

            $table->float('total')->nullable()->default(0);
            $table->string('promo')->nullable()->default(null);
            $table->float('discount')->nullable()->default(0);
            $table->float('grand_total')->nullable()->default(0);

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
