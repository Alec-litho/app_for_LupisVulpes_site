<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('art', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('year');
            $table->string('characters');
            $table->string('show');
            $table->string('art_type'); 
            $table->string('fandom');
            $table->string('link');
            $table->boolean('is_plushie');
            $table->boolean('is_commission');
            $table->string('ids_for_test');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->index('color_id', 'art_colors_idx');
            $table->foreign('color_id', 'art_colors_fk')->on('colors')->references('id');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('arts');
    }
};
