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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('status'); 
            $table->string('status_update_by'); 
            $table->string('details');
            $table->float('coupon')->nullable();

            $table->bigInteger('product_id');

            $table->double('sub_total');
            $table->double('total');
            $table->double('paid');

            $table->bigInteger('customer_id');

            $table->bigInteger('payment_id');

            $table->bigInteger('shipper_id'); 

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
