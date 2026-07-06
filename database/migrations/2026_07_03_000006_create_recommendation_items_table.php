<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recommendation_items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->unsignedInteger('recommendation_id');
            $table->unsignedInteger('perfume_id');
            $table->float('score');
            $table->integer('rank');

            $table->foreign('recommendation_id')->references('recommendation_id')->on('recommendations')->cascadeOnDelete();
            $table->foreign('perfume_id')->references('perfume_id')->on('perfumes')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recommendation_items');
    }
};
