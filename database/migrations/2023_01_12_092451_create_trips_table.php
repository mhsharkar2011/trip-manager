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
            $table->integer('booking_id');
            $table->timestamp('bookig_date');
            $table->integer('booking_period');
            $table->integer('advance_amount');
            $table->integer('bkash_charge');
            $table->string('cost_details')->nullable();
            $table->integer('cost_amount')->nullable();
            $table->string('package_details')->nullable();
            $table->integer('package_amount')->nullable();
            $table->integer('balance_in')->nullable();
            $table->string('from_area')->nullable();
            $table->string('to_area')->nullable();
            $table->integer('distance')->nullable();
            $table->integer('trip_earning')->nullable();
            $table->string('status');
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
