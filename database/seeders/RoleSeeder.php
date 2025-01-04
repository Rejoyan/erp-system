<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Define permissions
        $permissions = [
            'users.manage',
            'jobs.manage',
            'tasks.manage',
            'inventory.manage', // Add inventory permission
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define roles and their permissions
        $rolesWithPermissions = [
            'admin' => [
                'users.manage',
                'jobs.manage',
                'tasks.manage',
                'inventory.manage', // Admin can manage everything
            ],
            'manager' => [
                'jobs.manage',
                'tasks.manage',
                'inventory.manage', // Manager can manage inventory
            ],
            'employee' => [
                'tasks.manage', // Employee has limited permissions
            ],
        ];

        // Create roles and assign permissions
        foreach ($rolesWithPermissions as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // Log success message (optional)
        $this->command->info('Roles and permissions have been seeded successfully.');
    }
}