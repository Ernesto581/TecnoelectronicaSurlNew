<?php

namespace Database\Factories;

use App\Enums\Rol;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'rol' => Rol::Customer->value,
            'remember_token' => Str::random(10),
            'newsletter' => fake()->boolean(70),
            'is_active' => true,
        ];
    }

    public function admin(): static
    {
        return $this->state(fn () => ['rol' => Rol::Admin->value]);
    }

    public function customer(): static
    {
        return $this->state(fn () => ['rol' => Rol::Customer->value]);
    }

    public function unverified(): static
    {
        return $this->state(fn () => ['email_verified_at' => null]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }
}
