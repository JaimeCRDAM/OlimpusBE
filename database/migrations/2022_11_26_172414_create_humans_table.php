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
        Schema::create('human', function (Blueprint $table) {
            $table -> integer("humanid") ->autoIncrement();
            $table -> string("name");
            $table -> string("email");
            $table -> string("password");
            $table -> integer("fate") -> nullable() -> default(0);
            $table -> string("blessed") -> nullable();
            $table -> foreign("blessed") -> references('godname')-> on("god"); //foreig
            $table -> integer("wisdom") -> nullable();
            $table -> integer("nobility") -> nullable();
            $table -> integer("virtue") -> nullable();
            $table -> integer("wickedness") -> nullable();
            $table -> integer("audacity") -> nullable();
            $table -> string("avatar") -> nullable();
            $table -> boolean("alive") -> nullable();
            $table -> string("destiny") -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('human');
    }
};
