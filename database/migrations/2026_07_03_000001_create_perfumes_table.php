<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfumes', function (Blueprint $table) {
            $table->increments('perfume_id');
            $table->string('name');
            $table->string('brand');
            $table->string('scent_family');
            $table->string('top_notes');
            $table->string('middle_notes');
            $table->string('base_notes');
            $table->enum('longevity', ['weak', 'moderate', 'strong']);
            $table->enum('sillage', ['soft', 'moderate', 'heavy']);
            $table->string('weather_suitability');
            $table->text('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfumes');
    }
};
