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
        Schema::create('quests', function (Blueprint $table) {
            $table -> id();
            $table -> integer("destiny");
            $table -> double("chance");
            $table -> integer("virtue_amount") -> nullable();
            $table -> string("virtue_name") -> nullable();
            $table -> string("key_words") -> nullable();
            $table -> string("description");
            $table -> unsignedBigInteger("god_id");
            $table -> foreign("god_id") -> references("id") -> on("gods");
            $table -> unsignedBigInteger("type_id");
            $table -> foreign("type_id") -> references("id") -> on("quests_types");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quests');
    }
};
