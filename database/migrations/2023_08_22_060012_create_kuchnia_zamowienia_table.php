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
        Schema::create('kuchnia_zamowienia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_zamowienia');
            $table->timestamps();

            $table->foreign('id_zamowienia')->references('id')->on('zamowienia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuchnia_zamowienia');
    }
};
