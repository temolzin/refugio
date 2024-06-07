<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('species')->insert([
            [
                'name' => 'Perro',
                'description' => 'Mamífero doméstico de la familia de los cánidos.',
                'id_shelters' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gato',
                'description' => 'Mamífero carnívoro de la familia de los félidos.',
                'id_shelters' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ave',
                'description' => 'Clase de animales vertebrados, generalmente alados.',
                'id_shelters' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perro',
                'description' => 'Mamífero doméstico de la familia de los cánidos.',
                'id_shelters' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gato',
                'description' => 'Mamífero carnívoro de la familia de los félidos.',
                'id_shelters' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Peces',
                'description' => 'Clase de animales vertebrados, generalmente alados.',
                'id_shelters' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
