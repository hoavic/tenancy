<?php

use App\Models\Tenant\Post;
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
        Schema::create('postmetas', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
            $table->string('key');
            $table->enum('visual', ['text', 'color', 'image'])->default('text');
            $table->string('value');
            $table->string('label')->nullable();
            
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
        Schema::dropIfExists('postmetas');
    }
};
