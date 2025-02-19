<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset Cached Roles & Permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define Permissions
        $permissions = [
            'manage assets',
            'manage events',
            'see contributors',
            'see contributions',
            'group activities',
            'send messages',
            'monitor contributions',
            'generate reports',
            'oversee event planning',
            'track attendance',
            'manage users'
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define Roles and Assign Permissions
        $roles = [
            'super admin' => $permissions,
            'church administrator' => ['manage assets', 'manage events', 'see contributors', 'see contributions'],
            'volunteer coordinator' => ['group activities', 'send messages'],
            'financial officer' => ['monitor contributions', 'generate reports'],
            'event manager' => ['oversee event planning', 'track attendance'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // Define Users for Each Role
        $users = [
            'super admin' => [
                'first_name' => 'Super',
                'email' => 'superadmin@example.com',
                'password' => 'password',
            ],
            'church administrator' => [
                'first_name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'password',
            ],
            'volunteer coordinator' => [
                'first_name' => 'Volunteer',
                'email' => 'volunteer@example.com',
                'password' => 'password',
            ],
            'financial officer' => [
                'first_name' => 'Finance',
                'email' => 'finance@example.com',
                'password' => 'password',
            ],
            'event manager' => [
                'first_name' => 'Event',
                'email' => 'eventmanager@example.com',
                'password' => 'password',
            ],
        ];

        // Create Users and Assign Roles
        foreach ($users as $role => $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'first_name' => $userData['first_name'],
                    'church_name' => 'Main Church',
                    'password' => Hash::make($userData['password']),
                ]
            );
            foreach ($permissions as $permission) {
                $user->givePermissionTo($permission);
            }
            // Assign Role to User
            if (!$user->hasRole($role)) {
                $user->assignRole($role);
            }

            echo "User created: " . $user->email . " with role: " . $role . "\n";
        }
    }
}
