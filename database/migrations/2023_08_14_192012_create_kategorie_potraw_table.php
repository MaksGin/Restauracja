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
        Schema::create('kategorie_potraw', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->unsignedBigInteger('miejsce_realizacji');

            $table->foreign('miejsce_realizacji')->references('id')->on('miejsce_realizacji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategorie_potraw');
    }
};
