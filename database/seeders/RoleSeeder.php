<?php

namespace Database\Seeders;

use App\Enums\SpatiePermission\Guard;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Super Admin',
            'guard_name' => Guard::WEB->value,
            'description' => 'This role will contain permissions for Super Admin.',
        ]);

        Role::create([
            'name' => 'Receptionist',
            'guard_name' => Guard::WEB->value,
            'description' => 'This role will contain permissions for Receptionist.',
        ]);

        Role::create([
            'name' => 'Employee',
            'guard_name' => Guard::WEB->value,
            'description' => 'This role will contain permissions for User.',
        ]);

        Role::create([
            'name' => 'Visitor',
            'guard_name' => Guard::WEB->value,
            'description' => 'This role will contain permissions for Visitor.',
        ]);
    }
}
