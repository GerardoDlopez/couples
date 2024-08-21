<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear Roles
        $singleRole = Role::create(['name' => 'single']);
        $coupleRole = Role::create(['name' => 'couple']);

        // Crear Permisos
        Permission::create(['name' => 'single-dashboard']);
        Permission::create(['name' => 'couple-dashboard']);
        Permission::create(['name' => 'medias']);
        Permission::create(['name' => 'gifts']);
        // Asignar Permisos a Roles
        $singleRole->givePermissionTo('single-dashboard');
        $coupleRole->givePermissionTo('couple-dashboard');
        $coupleRole->givePermissionTo('medias');
        $coupleRole->givePermissionTo('gifts');
    }
}
