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

        foreach ($shelterMembers as $shelterMember) {
            $animalIds = Animal::where('shelter_id', $shelterMember->shelter_id)->pluck('id')->all();

            if (empty($animalIds)) {
                continue;
            }

            for ($i = 0; $i < 1; $i++) {
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
