<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $name = fake()->name();

        return [
            'full_name' => $name,
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('07########'),
            'role' => 'witness',
            'is_active' => true,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function witness(): static
    {
        return $this->state(fn (array $attributes) => ['role' => 'witness']);
    }

    public function investigator(): static
    {
        return $this->state(fn (array $attributes) => ['role' => 'investigator']);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => ['role' => 'admin']);
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => ['email_verified_at' => null]);
    }
}
