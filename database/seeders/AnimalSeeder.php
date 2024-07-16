<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $petsByShelter = 50;
        $data = [];

        for ($shelterId = 1; $shelterId <= 2; $shelterId++) {
            for ($i = 0; $i < $petsByShelter; $i++) {
                $data[] = [
                    'specie_id' => $faker->numberBetween(1, 6),
                    'shelter_id' => $shelterId,
                    'name' => $faker->firstName,
                    'breed' => $faker->word,
                    'birth_date' => $faker->date('Y-m-d', '2015-01-01'),
                    'sex' => $faker->randomElement(['Macho', 'Hembra']),
                    'color' => $faker->safeColorName,
                    'weight' => $faker->randomFloat(1, 0.5, 20.0),
                    'is_sterilized' => $faker->boolean,
                    'entry_date' => $faker->date('Y-m-d', 'now'),
                    'origin' => $faker->randomElement(['Rescatado', 'Abandonado', 'Transferido']),
                    'behavior' => $faker->randomElement(['Amigable', 'Tímido', 'Agresivo']),
                    'history' => $faker->sentence(6),
                ];
            }
        }

        DB::table('animals')->insert($data);
    }
}
