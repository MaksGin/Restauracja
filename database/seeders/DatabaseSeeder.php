<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Potrawa;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //$this->call(UsersTableSeeder::class);

        DB::table('kategorie_potraw')->insert([
            [
                'nazwa' => 'Zupy',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Dania z drobiu',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Dania z wieprzowiny',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Dania z cielęciny',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Dania z wołowiny',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Owoce morza',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Dania bezmięsne',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Inne Dania',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Specjalność zakładu',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Dania z grilla',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Fast food',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Desery',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Dodatki',
                'miejsce_realizacji' => 1,
            ],
            [
                'nazwa' => 'Napoje',
                'miejsce_realizacji' => 2,
            ],
            [
                'nazwa' => 'Alkohole',
                'miejsce_realizacji' => 2,
            ]
        ]);
        DB::table('lista_potraw')->insert([
            [
                'nazwa' => 'Kurczak na ostro',
                'skladniki' => '-',
                'cena' => 25,
                'id_kategorii' => 11,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Kurczak w jarzynach i sosie czosnkowym',
                'skladniki' => '-',
                'cena' => 24,
                'id_kategorii' => 11,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Szarlotka',
                'skladniki' => '-',
                'cena' => 12,
                'id_kategorii' => 12,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Malinowa Chmurka',
                'skladniki' => '-',
                'cena' => 14,
                'id_kategorii' => 12,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Pomidorowa',
                'skladniki' => '-',
                'cena' => 7,
                'id_kategorii' => 1,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Kawa',
                'skladniki' => '-',
                'cena' => 8,
                'id_kategorii' => 14,
                'dostep' => 1
            ],
        ]);
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
