<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            // Store management
            'view stores', 'create stores', 'edit stores', 'delete stores',

            // Merchandiser management
            'view merchandisers', 'create merchandisers', 'edit merchandisers', 'delete merchandisers',

            // Attendance & Visits
            'log attendance', 'view attendance', 'assign store', 'view assigned stores', 'mark store visit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $supervisor = Role::firstOrCreate(['name' => 'supervisor']);
        $merchandiser = Role::firstOrCreate(['name' => 'merchandiser']);

        // Assign permissions
        $admin->givePermissionTo(Permission::all());

        $supervisor->givePermissionTo([
            'view stores', 'view merchandisers',
            'view attendance', 'assign store',
        ]);

        $merchandiser->givePermissionTo([
            'log attendance', 'view assigned stores', 'mark store visit',
        ]);
    }
}