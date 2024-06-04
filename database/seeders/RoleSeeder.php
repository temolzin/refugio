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

        Permission::create(['name' => 'ver dashboard'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'ver usuario'])->assignRole($role1);
        Permission::create(['name' => 'ver albergue'])->assignRole($role1);
        Permission::create(['name' => 'ver rol'])->assignRole($role1);
        Permission::create(['name' => 'Ver vacuna'])->assignRole($role2);
        Permission::create(['name' => 'ver especie'])->assignRole($role2);
        Permission::create(['name' => 'ver animal'])->assignRole($role2);
        Permission::create(['name' => 'ver citas'])->assignRole($role2);
        Permission::create(['name' => 'ver adopciones'])->assignRole($role2);
        Permission::create(['name' => 'ver usarios albergue'])->assignRole($role2);
        Permission::create(['name' => 'ver apadrinamientos'])->assignRole($role2);

    }
}
