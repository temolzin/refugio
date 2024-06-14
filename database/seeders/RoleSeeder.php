<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'admin']);
        $role2 = Role::create(['name'=>'shelter']);

        Permission::create(['name' => 'viewDashboard', 'description' => 'ver dashboard'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'viewUser', 'description' => 'ver usuario'])->assignRole($role1);
        Permission::create(['name' => 'viewShelter', 'description' => 'ver albergue'])->assignRole($role1);
        Permission::create(['name' => 'viewRol', 'description' => 'ver rol'])->assignRole($role1);

        Permission::create(['name' => 'viewVaccine', 'description' => 'ver vacuna'])->assignRole($role2);
        Permission::create(['name' => 'viewSpecie', 'description' => 'ver especie'])->assignRole($role2);
        Permission::create(['name' => 'viewAnimal', 'description' => 'ver animal'])->assignRole($role2);
        Permission::create(['name' => 'viewQuotes', 'description' => 'ver citas'])->assignRole($role2);
        Permission::create(['name' => 'viewAdoptions', 'description' => 'ver adopciones'])->assignRole($role2);
        Permission::create(['name' => 'viewShelterUsers', 'description' => 'ver usuarios albergue'])->assignRole($role2);
        Permission::create(['name' => 'viewGodparents', 'description' => 'ver apadrinamientos'])->assignRole($role2);

    }
}
