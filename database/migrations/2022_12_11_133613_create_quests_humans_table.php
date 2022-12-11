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
        Schema::create('quests_humans', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger("quest_id");
            $table -> foreign("quest_id") -> references("id") -> on("quests");
            $table -> unsignedBigInteger("human_id");
            $table -> foreign("human_id") -> references("id") -> on("humans");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quests_humans');
    }
};
