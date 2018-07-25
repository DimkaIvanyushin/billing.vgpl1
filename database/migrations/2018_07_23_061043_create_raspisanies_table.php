<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaspisaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raspisanies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('discipline_id');
            $table->integer('teacher_id');
            $table->string('room');
            $table->integer('number');
            $table->date('day');
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
        Schema::dropIfExists('raspisanies');
    }
}
