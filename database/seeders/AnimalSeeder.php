<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('animals')->insert([
            [
                'specie_id' => 1,
                'shelter_id' => 1,
                'name' => 'Max',
                'breed' => 'Labrador Retriever',
                'birth_date' => '2018-06-01',
                'sex' => 'Macho',
                'color' => 'Negro',
                'weight' => 30.5,
                'is_sterilized' => 1,
                'entry_date' => '2023-01-15',
                'origin' => 'Rescatado',
                'behavior' => 'Amigable',
                'history' => 'Rescatado de la calle',
            ],
            [
                'specie_id' => 2,
                'shelter_id' => 1,
                'name' => 'Luna',
                'breed' => 'Persa',
                'birth_date' => '2020-03-15',
                'sex' => 'Hembra',
                'color' => 'Blanco',
                'weight' => 4.2,
                'is_sterilized' => 0,
                'entry_date' => '2023-02-20',
                'origin' => 'Transferido',
                'behavior' => 'Timido',
                'history' => 'Transferido de otro refugio',
            ],
            [
                'specie_id' => 4,
                'shelter_id' => 2,
                'name' => 'Rocky',
                'breed' => 'Bulldog',
                'birth_date' => '2017-11-11',
                'sex' => 'Macho',
                'color' => 'Marrón',
                'weight' => 25.3,
                'is_sterilized' => 0,
                'entry_date' => '2023-03-05',
                'origin' => 'Abandonado',
                'behavior' => 'Agresivo',
                'history' => 'Abandonado en un parque',
            ],
            [
                'specie_id' => 6,
                'shelter_id' => 2,
                'name' => 'Bella',
                'breed' => 'Cacatúa',
                'birth_date' => '2019-08-22',
                'sex' => 'Hembra',
                'color' => 'Amarillo',
                'weight' => 0.5,
                'is_sterilized' => 1,
                'entry_date' => '2023-04-10',
                'origin' => 'Rescatado',
                'behavior' => 'Amigable',
                'history' => 'Encontrado herido',
            ],
        ]);
    }
}
