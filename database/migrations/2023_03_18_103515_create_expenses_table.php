<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('trip_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('purchase_from')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('purchased_by')->nullable();
            $table->string('amount')->nullable();
            $table->string('paid_by')->nullable();
            $table->string('status')->nullable();
            $table->string('attachments')->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
