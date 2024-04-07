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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->boolean('adult');
            $table->string('backdrop_path')->nullable();
            $table->string('name');
            $table->string('original_language');
            $table->string('original_name');
            $table->text('overview');
            $table->string('poster_path')->nullable();
            $table->string('media_type');
            $table->json('genre_ids');
            $table->float('popularity');
            $table->date('first_air_date');
            $table->float('vote_average');
            $table->integer('vote_count');
            $table->json('origin_country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
