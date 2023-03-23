<?php

use App\Models\Tenant\Backend\Inventory\Stock;
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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->foreignIdFor(Stock::class)->constrained()->cascadeOnDelete();
            /* $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete(); */

            $table->integer('before')->nullable()->default(0);
            $table->integer('after')->nullable()->default(0);
            $table->integer('cost')->nullable()->default(0);

            $table->string('reason')->nullable();

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
        Schema::dropIfExists('stock_movements');
    }
};
