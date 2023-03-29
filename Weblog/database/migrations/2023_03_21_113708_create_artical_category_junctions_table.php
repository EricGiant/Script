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
        Schema::create('artical_category_junctions', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger("category_id");
            $table -> foreign('category_id')->references('id')->on('categories');
            $table -> unsignedBigInteger("artical_id");
            $table -> foreign('artical_id')->references('id')->on('articals');
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
        Schema::dropIfExists('artical_category_junctions');
    }
};
