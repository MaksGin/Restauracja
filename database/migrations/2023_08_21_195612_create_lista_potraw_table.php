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
        Schema::create('lista_potraw', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->text('skladniki')->nullable();
            $table->double('cena');
            $table->unsignedBigInteger('id_kategorii');
            $table->foreign('id_kategorii')->references('id')->on('kategorie_potraw');
            $table->boolean("dostep")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_potraw');
    }
};
