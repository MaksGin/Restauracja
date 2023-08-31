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

         DB::table('lista_potraw')->insert([
            [
                'nazwa' => 'Kurczak na ostro',
                'skladniki' => '-',
                'cena' => 25,
                'id_kategorii' => 1,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Kurczak w jarzynach i sosie czosnkowym',
                'skladniki' => '-',
                'cena' => 24,
                'id_kategorii' => 1,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Szarlotka',
                'skladniki' => '-',
                'cena' => 12,
                'id_kategorii' => 6,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Malinowa Chmurka',
                'skladniki' => '-',
                'cena' => 14,
                'id_kategorii' => 6,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Pomidorowa',
                'skladniki' => '-',
                'cena' => 7,
                'id_kategorii' => 2,
                'dostep' => 1
            ],
            [
                'nazwa' => 'Kawa',
                'skladniki' => '-',
                'cena' => 8,
                'id_kategorii' => 4,
                'dostep' => 1
            ],
        ]);

    }
}
