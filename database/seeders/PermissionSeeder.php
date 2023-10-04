<?php

namespace Database\Seeders;

use App\Enums\SpatiePermission\Guard;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission related to User model
        Permission::create([
            'name' => 'view-user',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to view user information.'
        ]);
        Permission::create([
            'name' => 'create-user',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to create user information.'
        ]);
        Permission::create([
            'name' => 'edit-user',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to edit user information.'
        ]);
        Permission::create([
            'name' => 'delete-user',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to delete user information.'
        ]);

        // Permission related to Role model
        Permission::create([
            'name' => 'view-role',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to view role information.'
        ]);
        Permission::create([
            'name' => 'create-role',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to create role information.'
        ]);
        Permission::create([
            'name' => 'edit-role',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to edit role information.'
        ]);
        Permission::create([
            'name' => 'delete-role',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to delete role information.'
        ]);

        // Permission related to Permission model
        Permission::create([
            'name' => 'view-permission',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to view permission information.'
        ]);
        Permission::create([
            'name' => 'create-permission',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to create permission information.'
        ]);
        Permission::create([
            'name' => 'edit-permission',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to edit permission information.'
        ]);
        Permission::create([
            'name' => 'delete-permission',
            'guard_name' => Guard::WEB->value,
            'description' => 'It will give permission to delete permission information.'
        ]);
    }
}
