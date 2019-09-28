<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGraduationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_graduations', function (Blueprint $table) {
            $table->increments('id');

            $table->date('startDate');
            $table->date('endDate');
            $table->boolean('isActive')->default(true);
            $table->integer('idUser')->nullable()->unsigned();
            
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_graduations');
    }
}
