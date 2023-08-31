<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Maksymilian Gintner - Kierownik',
                'email' => 'maks@wp.pl',
                'password' => bcrypt('Haslo123'),
                'id_stanowiska' => 1,
            ],
            [
                'name' => 'Adrian Nowak - Kelner',
                'email' => 'adrian@wp.pl',
                'password' => bcrypt('Haslo123'),
                'id_stanowiska' => 2,
            ],
            [
                'name' => 'Beata Kowal - Kucharz',
                'email' => 'beata@wp.pl',
                'password' => bcrypt('Haslo123'),
                'id_stanowiska' => 3,
            ],
            [
                'name' => 'Marcin Nowak - Barman',
                'email' => 'marcin@wp.pl',
                'password' => bcrypt('Haslo123'),
                'id_stanowiska' => 4,
            ],

        ]);
    }
}
