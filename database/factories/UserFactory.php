<?php

namespace Database\Factories;

use App\Enums\User\Status;
use App\Enums\User\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'type' => fake()->randomElement(Type::cases()),
            'status' => fake()->randomElement(Status::cases()),
            'profile_photo' => fake()->word() .'.'. fake()->randomElement(['png', 'jpeg']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's type should be internal.
     */
    public function internal(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Type::INTERNAL->value,
        ]);
    }

    /**
     * Indicate that the model's type should be external.
     */
    public function external(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Type::EXTERNAL->value,
        ]);
    }

    /**
     * Indicate that the model's status should be active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Status::ACTIVE->value,
        ]);
    }

    /**
     * Indicate that the model's status should be inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Status::INACTIVE->value,
        ]);
    }

    /**
     * Indicate that the model's status should be pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Status::PENDING->value,
        ]);
    }
}
