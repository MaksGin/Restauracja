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
        Schema::create('miejsce_realizacji', function (Blueprint $table) {
            $table->id();
            $table->string("nazwa");
            $table->timestamps();
        });
        DB::insert("INSERT INTO miejsce_realizacji (nazwa) VALUES ('Kuchnia')");
        DB::insert("INSERT INTO miejsce_realizacji (nazwa) VALUES ('Bar')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miejsce_realizacji');
    }
};
