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
            $table->string('email');
            $table->string('password');

            $table->string('phone')->nullable();
            $table->char('cpf', 14)->nullable();
            $table->date('birth')->nullable();
            $table->string('responsible')->nullable();
            $table->string('phoneResponsible')->nullable();

            $table->string('zipCode')->nullable();
            $table->string('city')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('avatar')->nullable();
            $table->text('observation')->nullable();


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
