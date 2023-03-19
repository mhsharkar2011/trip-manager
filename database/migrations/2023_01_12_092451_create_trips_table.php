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
            $table->unsignedInteger('driver_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('vehicle_id')->nullable();
            $table->unsignedInteger('package_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->timestamp('booking_date');
            $table->integer('booking_period');
            $table->integer('advance_amount');
            $table->integer('bkash_charge');
            $table->integer('balance_in')->nullable();
            $table->string('fuel_name')->nullable();
            $table->decimal('fuel_amount')->nullable();
            $table->string('item_name')->nullable();
            $table->decimal('amount')->nullable();
            $table->string('from_area')->nullable();
            $table->string('to_area')->nullable();
            $table->integer('distance')->nullable();
            $table->integer('trip_earning')->nullable();
            $table->integer('trip_expenses')->nullable();
            $table->string('status');
            $table->foreign('driver_id')->references('id')->on('drivers')->cascadeOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete();
            $table->foreign('package_id')->references('id')->on('packages')->cascadeOnDelete();
            $table->softDeletes();
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
