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
        Schema::create('harmonogram', function (Blueprint $table) {
            $table->id();
            $table->string('zmiana');
            $table->string('od_ktorej');
            $table->string('do_ktorej');
        });
        DB::insert("insert into harmonogram (zmiana, od_ktorej, do_ktorej) VALUES ('1','8','16')");
        DB::insert("insert into harmonogram (zmiana, od_ktorej, do_ktorej) VALUES ('2','16','24')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harmonogram');
    }
};
