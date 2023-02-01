<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->string('name')->nullable();
                $table->integer('project_id')->unsigned();
                $table->dateTime('start_date')->nullable();
                $table->dateTime('completion_date')->nullable();
                $table->longText('show_number')->nullable();
                $table->dateTime('show_date')->nullable();
                $table->string('status')->default('DRAFT');
                $table->integer('sequence')->default(0);
                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
