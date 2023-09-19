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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("content");
            $table -> unsignedBigInteger("appointed_to_id");
            $table -> foreign("appointed_to_id") -> references("id") -> on("users");
            $table -> unsignedBigInteger("status_id");
            $table -> foreign("status_id") -> references("id") -> on("statuses");
            $table -> unsignedBigInteger("user_id");
            $table -> foreign("user_id") -> references("id") -> on("users");
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
        Schema::dropIfExists('tickets');
    }
};
