<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('isRoot')->default(false);
            $table->boolean('isAdmin')->default(false);
            $table->boolean('isStudent')->default(false);
            $table->boolean('isActive')->default(true);
            
            $table->integer('idAcademy')->nullable()->unsigned();
            
            $table->timestamps();

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
        Schema::dropIfExists('users');
    }
}
