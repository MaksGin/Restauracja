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
        Schema::create('zamowienia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelnera');
            $table->foreign('id_kelnera')->references('id')->on('users');
            $table->unsignedBigInteger('id_stoliku');
            $table->foreign('id_stoliku')->references('id')->on('stolies');
            $table->double('cena');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zamowienia');
    }
};
