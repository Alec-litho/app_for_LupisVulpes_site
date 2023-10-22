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
            $table->string('colors');
            $table->string('artType');
            $table->string('fandom');
            $table->string('link');
            $table->boolean('isPlushie');
            $table->boolean('isCommission');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('art');
    }
};
