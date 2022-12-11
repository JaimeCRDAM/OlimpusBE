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
        Schema::create('humans', function (Blueprint $table) {
            $table -> id() -> autoIncrement();
            $table -> string("name");
            $table -> string("email");
            $table -> string("password");
            $table -> integer("fate");
            $table -> unsignedBigInteger("god_id");
            $table -> foreign("god_id") -> references("id") -> on("gods");
            $table -> integer("wisdom");
            $table -> integer("nobility");
            $table -> integer("virtue");
            $table -> integer("wickedness");
            $table -> integer("audacity");
            $table -> string("avatar") -> default("MaleVillDE.jpg");
            $table -> boolean("alive");
            $table -> string("destiny");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('humans');
    }
};
