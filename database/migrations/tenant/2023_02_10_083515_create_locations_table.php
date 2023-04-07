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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->enum('type', [
                '{"value": "warehouse", "label": "Kho"}',
                '{"value": "depot", "label": "Tổng kho"}',
                '{"value": "shop", "label": "Cửa hàng"}',
                '{"value": "office", "label": "Văn phòng"}',
                '{"value": "branch", "label": "Chi nhánh"}',
                '{"value": "other", "label": "Khác"}',
            ])->default('{"value": "shop", "label": "Cửa hàng"}');

            $table->text('address')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('operating_time')->nullable();
            $table->text('note')->nullable();

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
        Schema::dropIfExists('locations');
    }
};
