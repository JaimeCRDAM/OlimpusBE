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
        Schema::create('gods', function (Blueprint $table) {
            $table -> id() ->autoIncrement();
            $table->string("god_name");
            $table->integer("wisdom");
            $table->integer("nobility");
            $table->integer("virtue");
            $table->integer("wickedness");
            $table->integer("audacity");
            $table->string("password");
            $table->string("avatar") -> default("MaleVillDE.jpg");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('god');
    }
};
