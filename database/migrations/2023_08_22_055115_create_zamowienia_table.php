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
            $table->unsignedBigInteger('id_statusu_kuchnia')->nullable();
            $table->unsignedBigInteger('id_statusu_bar')->nullable();
            $table->double('cena');

            $table->timestamps();
            $table->foreign('id_statusu_kuchnia')->references('id')->on('status_zamowienia');
            $table->foreign('id_statusu_bar')->references('id')->on('status_zamowienia');
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
