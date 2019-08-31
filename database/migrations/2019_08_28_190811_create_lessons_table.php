<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('weekDay');
            $table->time('hour');
            $table->boolean('isAtivo')->default(true);

            $table->integer('idSport')->unsigned();
            $table->integer('idAcademy')->unsigned();
            
            $table->timestamps();

            $table->foreign('idSport')->references('id')->on('academies')->onDelete('cascade');
            $table->foreign('idAcademy')->references('id')->on('academies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
