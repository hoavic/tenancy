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
        Schema::create('productcategories', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('title');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('parent_id')->default(0);
            
            $table->bigInteger('count')->default(0);
            $table->string('slug');
            $table->string('guid');

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
        Schema::dropIfExists('productcategories');
    }
};
