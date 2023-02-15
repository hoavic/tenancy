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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->longText('content')->nullable();
            $table->text('title');
            $table->text('excerpt')->nullable();
            $table->string('status');
            $table->string('password')->nullable();
            $table->string('name');
            $table->bigInteger('parent')->default(0);
            $table->string('guid');
            $table->integer('menu_order')->default(0);
            $table->string('type')->default('post');
            $table->timestamps();

            $table->string('comment_status')->default('open');
            $table->bigInteger('comment_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }

};
