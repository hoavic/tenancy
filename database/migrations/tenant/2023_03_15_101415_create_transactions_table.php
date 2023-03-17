<?php

use App\Models\Tenant\Backend\Commerce\Customer;
use App\Models\Tenant\Backend\Order;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(Customer::class)->constrained();
            $table->foreignIdFor(Order::class)->constrained();
            
            $table->string('code');
            $table->smallInteger('type')->default(0);
            $table->smallInteger('mode')->default(0);
            $table->smallInteger('status')->default(0);
            
            $table->text('content')->nullable()->default(null);

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
        Schema::dropIfExists('transactions');
    }
};
