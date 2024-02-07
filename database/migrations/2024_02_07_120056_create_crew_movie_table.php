<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crew_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreignId('crew_id')->references('id')->on('crews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crew_movie');
    }
};
