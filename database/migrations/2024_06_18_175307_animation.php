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
        Schema::create('animations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("animationLink");
            $table->string("year");
            $table->string("previewLink");
            $table->string("characters");
            $table->string("fandom");
            $table->string("show");
            $table->boolean("isCommission");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
