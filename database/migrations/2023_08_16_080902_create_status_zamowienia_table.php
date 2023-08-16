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
        Schema::create('status_zamowienia', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });
        DB::insert("INSERT INTO status_zamowienia (status) VALUES ('W trakcie realizacji')");
        DB::insert("INSERT INTO status_zamowienia (status) VALUES ('Anulowane')");
        DB::insert("INSERT INTO status_zamowienia (status) VALUES ('Gotowe do odbioru')");
        DB::insert("INSERT INTO status_zamowienia (status) VALUES ('Brak')");
        DB::insert("INSERT INTO status_zamowienia (status) VALUES ('Oczekujace')");
        DB::insert("INSERT INTO status_zamowienia (status) VALUES ('Zrealizowane')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_zamowienia');
    }
};
