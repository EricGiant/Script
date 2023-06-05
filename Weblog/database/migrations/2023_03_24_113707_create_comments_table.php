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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger("author_id");
            $table -> foreign('author_id') -> references('id') -> on('users');
            $table -> string("content", 1000);
            $table -> unsignedBigInteger("artical_id");
            $table -> foreign('artical_id') -> references('id') -> on('articals') -> cascadeOnDelete();
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
        Schema::dropIfExists('comments');
    }
};
