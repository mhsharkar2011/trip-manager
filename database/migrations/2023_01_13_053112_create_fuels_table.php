<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedInteger('mileage_id')->nullable();
            $table->timestamp('refueling')->useCurrent();
            $table->integer('volume')->nullable();
            $table->integer('cost')->nullable();
            $table->string('gas_station')->nullable();
            $table->timestamps();
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mileage_id')->references('id')->on('mileages')->onDelete('cascade')->onUpdate('cascade');
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
