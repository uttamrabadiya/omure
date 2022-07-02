<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_histories', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable();
            $table->string('date');
            $table->string('temperature');
            $table->string('dew_point');
            $table->string('humidity');
            $table->string('wind_direction');
            $table->string('wind_speed');
            $table->string('wind_gust');
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
        Schema::dropIfExists('weather_histories');
    }
};
