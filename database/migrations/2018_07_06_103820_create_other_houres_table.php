<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherHouresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_houres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('elective_hour')->default(0);
            $table->integer('DK_hour')->default(0);
            $table->integer('room_hour')->default(0);
            $table->integer('examinations_hour')->default(0);
            $table->integer('teacher_id');
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
        Schema::dropIfExists('other_houres');
    }
}
