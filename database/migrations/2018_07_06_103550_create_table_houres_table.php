<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHouresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_houres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discipline_id');
            $table->integer('group_id');
            $table->integer('teacher_id');
            $table->integer('otherhour_id');
            $table->integer('hour')->default(0);
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
        Schema::dropIfExists('table_houres');
    }
}
