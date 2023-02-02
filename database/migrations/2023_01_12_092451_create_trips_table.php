<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('vehicle_id')->nullable();
            $table->timestamp('booking_date');
            $table->integer('booking_id');
            $table->boolean('status')->default(false);
            $table->integer('advance');
            $table->integer('bkash_charge');
            
            $table->string('from_area')->nullable();
            $table->string('from_area')->nullable();
            $table->string('to_area')->nullable();
            $table->integer('mileages')->nullable();
            $table->integer('rate')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete();
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trips');
    }
}
