<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->increments('weather_id');
            $table->unsignedInteger('user_id');
            $table->float('temperature');
            $table->float('humidity');
            $table->string('condition');
            $table->boolean('is_manual')->default(false);
            $table->dateTime('recorded_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
