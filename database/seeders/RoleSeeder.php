<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //reset cahed role and permissions
        app()[\Spatie\Permission\Models\Permission::class]->forgetCachedPermissions();
        
        //create 4 roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'PIC']);
        Role::create(['name' => 'Athlete']);
        Role::create(['name' => 'Normal User']);

    }
}
