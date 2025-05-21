<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected static ?string $password;

    protected $model = User::class;

    public function definition(): array
    {
        return [
            'id' => 1,
            'name' => 'Wagner Oliveira',
            'email' => 'waggner.dev@gmail.com',
            'password' => Hash::make('W@gn3R13041994dev'),
            'active' => 1,
            'is_super' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
