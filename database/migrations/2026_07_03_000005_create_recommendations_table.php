<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->increments('recommendation_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('weather_id');
            $table->dateTime('generated_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
            $table->foreign('weather_id')->references('weather_id')->on('weather')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
