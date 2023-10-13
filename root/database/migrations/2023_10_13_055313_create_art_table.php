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
            $table->year('year');
            $table->text('characters');
            $table->string('show');
            $table->text('colors');
            $table->string('artType');
            $table->string('fandom');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('art');
    }
};
