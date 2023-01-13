<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fuel_type_id')->nullable();
            $table->integer('start_fuel')->nullable();
            $table->integer('end_fuel')->nullable();
            $table->integer('total_fuel')->nullable();
            $table->timestamps();
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fuels');
    }
}
