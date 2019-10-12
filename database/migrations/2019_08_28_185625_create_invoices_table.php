<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('value', 8, 2);
            $table->date('dueDate');
            $table->boolean('isPaid')->default(false);
            $table->date('paymentDate')->nullable();

            $table->integer('idUser')->unsigned();
            $table->integer('idContract')->unsigned();
            $table->integer('idAcademy')->nullable()->unsigned();

            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idContract')->references('id')->on('contracts')->onDelete('cascade');
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
        Schema::dropIfExists('invoices');
    }
}
