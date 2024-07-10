<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\ShelterMember;
use App\Models\Animal;

class AdoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $shelterMembers = ShelterMember::all();
        $animalIds = Animal::pluck('id')->all();

        foreach ($shelterMembers as $shelterMember) {
            for ($i = 0; $i < 5; $i++) {
                DB::table('adoptions')->insert([
                    'animal_id' => $faker->randomElement($animalIds),
                    'shelter_member_id' => $shelterMember->id,
                    'adoption_date' => $faker->date,
                    'observation' => $faker->text
                ]);
            }
        }
    }
}
