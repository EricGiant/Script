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
        // TODO: probeer je code zo netjes mogelijk op te maken, dus onnodige spaties er uit:
        // $table -> string("name"); moet worden: $table->string("name");
        // (gebruik evt. een code formatter zoals prettier voor vscode)
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table -> string("name");
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
