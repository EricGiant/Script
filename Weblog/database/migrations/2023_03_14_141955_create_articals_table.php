<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('articals', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger("author_id");
            $table -> foreign('author_id') -> references('id') -> on('users');
            $table -> string("title");
            $table -> binary("content");
            $table -> boolean("isPremium");
            $table->timestamps();
        });

        DB::statement("ALTER TABLE articals ADD image MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articals');
    }
};
