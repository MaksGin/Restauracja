<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bar_zamowienia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_zamowienia');
            $table->foreign('id_zamowienia')->references('id')->on('zamowienia');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bar_zamowienia');
    }
};
