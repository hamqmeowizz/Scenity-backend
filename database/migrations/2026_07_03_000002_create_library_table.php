<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library', function (Blueprint $table) {
            $table->increments('library_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('perfume_id');
            $table->integer('rating')->nullable();
            $table->dateTime('added_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
            $table->foreign('perfume_id')->references('perfume_id')->on('perfumes')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library');
    }
};
