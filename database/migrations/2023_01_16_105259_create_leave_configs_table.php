<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('leave_type_id');
            $table->date('year')->nullable();
            $table->integer('total_leave')->nullable();
            $table->timestamps();
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->cascadeOnDelete();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leave_configs');
    }
}
