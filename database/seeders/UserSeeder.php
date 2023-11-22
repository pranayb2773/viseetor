<?php

namespace Database\Seeders;

use App\Enums\User\Status;
use App\Enums\User\Type;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->superAdmin();
        $this->internalUsers();
        $this->externalUsers();
    }

    private function superAdmin(): void
    {
        $superAdmin = User::create([
            'first_name' => 'Pranay',
            'last_name' => 'Baddam',
            'email' => 'pranay.teja.baddam@gmail.com',
            'password' => 'Baddam@#6',
            'type' => Type::INTERNAL->value,
            'status' => Status::ACTIVE->value,
        ]);

        $superAdmin->assignRole(Role::superAdmin()->first()->name);
    }

    private function internalUsers(): void
    {
        User::factory(20)->internal()->active()->create()->each(function (User $user) {
            $user->assignRole(
                Role::whereIn('name', ['Receptionist', 'Employee'])->pluck('name')->toArray()
            );
        });
    }

    private function externalUsers(): void
    {
        User::factory(200)->external()->active()->create()->each(function (User $user) {
            $user->assignRole(
                Role::whereIn('name', ['Visitor'])->pluck('name')->toArray()
            );
        });
    }
}
