<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStartUserGraduationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('start_user_graduations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('time')->default(1);

            $table->integer('idUserGraduation')->unsigned();

            $table->timestamps();

            $table->foreign('idUserGraduation')->references('id')->on('user_graduations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('start_user_graduations');
    }
}
