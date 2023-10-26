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
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('art_id');

            $table->index('art_id', 'art_color_art_idx');
            $table->index('art_id', 'art_color_color_idx');

            $table->foreign('art_id','art_color_art_fk')->on('colors')->references('id');
            $table->foreign('color_id','art_color_color_fk')->on('arts')->references('id'); 
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
