<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("base_color"); 
            $table->string("original_hue");
            $table->string("close_hue_name");
            $table->string("close_hue");
            $table->string("hsv"); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};
