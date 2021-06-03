<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialiteLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialite_logins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('provider_id');
            $table->string('provider')->nullable();
            $table->string('nickname')->nullable();
            $table->string('name')->nullable();
            $table->longText('avatar')->nullable();
            $table->longText('token')->nullable();
            $table->longText('refreshToken')->nullable();
            $table->string('expire')->nullable();
            $table->json('user_details')->nullable();
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
        Schema::dropIfExists('socialite_logins');
    }
}
