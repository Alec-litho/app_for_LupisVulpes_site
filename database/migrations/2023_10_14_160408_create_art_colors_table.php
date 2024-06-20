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
        Schema::create('art_colors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('art_id');
            $table->unsignedBigInteger('color_id');

            $table->index('art_id', 'art_colors_art_idx');
            $table->index('color_id', 'art_colors_color_idx');

            $table->foreign('art_id','art_colors_art_fk')->references('id')->on('art');
            $table->foreign('color_id','art_colors_color_fk')->references('id')->on('colors'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('art_colors');
    }
};
