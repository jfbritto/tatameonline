<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraduationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('hours');
            $table->char('color', 20)->nullable();
            $table->boolean('isActive')->default(true);

            $table->integer('idAcademy')->unsigned();
            $table->integer('idSport')->unsigned();

            $table->timestamps();

            $table->foreign('idAcademy')->references('id')->on('academies')->onDelete('cascade');
            $table->foreign('idSport')->references('id')->on('sports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graduations');
    }
}
