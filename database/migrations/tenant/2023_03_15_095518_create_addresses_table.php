<?php

use App\Models\Tenant\Backend\Commerce\Customer;
use App\Models\Tenant\Backend\Commerce\Order;
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
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->foreignIdFor(Customer::class)->constrained();
            $table->foreignIdFor(Order::class)->constrained();

            $table->string('name')->nullable()->default(null);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('address')->nullable();
            $table->integer('country_id')->nullable()->default(null);
            $table->integer('province_id')->nullable()->default(null);
            $table->integer('district_id')->nullable()->default(null);
            $table->integer('ward_id')->nullable()->default(null);

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
        Schema::dropIfExists('addresses');
    }
};
