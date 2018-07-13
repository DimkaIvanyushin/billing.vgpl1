<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('1_sem');
            $table->integer('2_sem');
            $table->integer('theory');
            $table->integer('lpz');
            $table->integer('peer_review');
            $table->integer('course');
            $table->integer('exam');
            $table->integer('training_practice');
            $table->integer('additional_control');
            $table->integer('qualification');
            $table->integer('diplom');
            $table->integer('ovr');
            $table->integer('removal');
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
        Schema::dropIfExists('entries');
    }
}
