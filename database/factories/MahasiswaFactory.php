<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => fake()->randomNumber(8),
            'nama' => fake()->name(),
            'alamat' => fake()->address(),
            'no_telp' => fake()->phoneNumber(),
            'id_jurusan_mahasiswa' => fake()->numberBetween(2, 4)
        ];
    }
}
