<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StanowiskaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lista_stanowisk')->insert([
            [
                'stanowisko' => 'kierownik',
                'opis' => 'taki jak admin',

            ],
            [
                'stanowisko' => 'kelner',
                'opis' => 'przyjmuje i przynosi zamówienia',
            ],
            [
                'stanowisko' => 'kucharz',
                'opis' => 'przygotowuje potrawy',
            ],
            [
                'stanowisko' => 'barman',
                'opis' => 'przygotowuje napoje oraz drinki',
            ],

        ]);
    }
}
