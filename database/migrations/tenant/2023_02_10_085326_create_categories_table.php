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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('parent_id')->default(0);
            /* $table->foreign('parent_id')->default(0)->references('id')->on('categories')->onDelete('cascade'); */
/*             $table->nestedSet();
            $table->dropNestedSet();
            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt'); */

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
        Schema::dropIfExists('categories');
    }
};
