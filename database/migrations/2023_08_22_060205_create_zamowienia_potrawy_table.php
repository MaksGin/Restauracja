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
        Schema::create('zamowienia_potrawy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zamowienie_id');
            $table->foreign('zamowienie_id')->references('id')->on('zamowienia');
            $table->unsignedBigInteger('potrawa_id');
            $table->foreign('potrawa_id')->references('id')->on('lista_potraw');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zamowienia_potrawy');
    }
};
