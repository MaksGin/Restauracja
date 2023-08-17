<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rezerwacje', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_stoly');
            $table->dateTime('od');
            $table->datetime('do');
            $table->string('nazwisko');
            $table->foreign('id_stoly')->references('id')->on('stolies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rezerwacje');
    }
};
