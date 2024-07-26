<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
        'user_id' => User::inRandomOrder()->first(),
        'profil' => 'profil.png',
        'nama_lengkap' => $this->faker->name(),
        'tentang' => $this->faker->paragraph(),
        'perusahaan' => $this->faker->company(),
        'pekerjaan' => $this->faker->jobTitle(),
        'kota' => $this->faker->city(),
        'alamat' => $this->faker->address(),
        'no_hp' => $this->faker->phoneNumber(),
        'email' => $this->faker->unique()->safeEmail(),
      ];
    }
}
