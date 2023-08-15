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
        Schema::create('stolies', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->integer('pojemnosc');
            $table->string('umiejscowienie');

        });

        DB::insert("INSERT INTO `stolies` (nazwa, pojemnosc, umiejscowienie) VALUES
                    ('4-osobowy', '4', '1 pietro'),
                    ('2-osobowy', '2', '1 pietro'),
                    ('2-osobowy', '2', '1 pietro'),
                    ('3-osobowy', '3', '1 pietro'),
                    ('4-osobowy', '4', '1 pietro'),
                    ('3-osobowy', '3', 'parter'),
                    ('5-osobowy', '5', 'parter'),
                    ('4-osobowy', '4', 'parter'),
                    ('2-osobowy', '2', 'parter'),
                    ('2-osobowy', '2', 'parter'),
                    ('2-osobowy', '2', 'parter'),
                    ('4-osobowy', '4', '2 pietro'),
                    ('4-osobowy', '4', '2 pietro'),
                    ('2-osobowy', '2', '2 pietro'),
                    ('4-osobowy', '4', '2 pietro'),
                    ('2-osobowy', '2', '2 pietro'),
                    ('3-osobowy', '3', 'podworze'),
                    ('2-osobowy', '2', 'podworze'),
                    ('5-osobowy', '5', 'podworze'),
                    ('5-osobowy', '5', 'podworze'),
                    ('4-osobowy', '4', 'podworze');");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stolies');
    }
};
