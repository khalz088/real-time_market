<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->date('forecast_date');
            $table->decimal('temperature_high')->nullable();
            $table->decimal('temperature_low')->nullable();
            $table->decimal('rainfall')->nullable();
            $table->integer('humidity')->nullable();
            $table->string('weather_condition')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('weather_data');
    }
};
