<?php

use App\Enums\FuelTypes;
use App\Enums\Status;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('trip_id')->nullable();
            $table->enum('fuel_name',[FuelTypes::DIESEL,FuelTypes::CNG,FuelTypes::PETROL,FuelTypes::LPG])->default('DIESEL');
            $table->string('fuel_purchase_from')->nullable();
            $table->string('fuel_purchase_date')->nullable();
            $table->string('fuel_amount')->nullable();
            $table->string('fuel_paid_by')->nullable();
            $table->string('fuel_attachments')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('trip_id')->references('id')->on('trips')->cascadeOnDelete()->cascadeOnUpdate();

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuels');
    }
}
