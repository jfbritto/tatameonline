<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->increments('id');

            $table->dateTime("checkedHour");
            $table->integer('idRegistration')->nullable()->unsigned();
            $table->integer('idUserGraduation')->nullable()->unsigned();

            $table->timestamps();
            
            $table->foreign('idRegistration')->references('id')->on('registrations')->onDelete('cascade');
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
        Schema::dropIfExists('presences');
    }
}
