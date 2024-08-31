<?php

namespace Database\Factories;

use App\Models\Mutasi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mutasi>
 */
class MutasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Mutasi::class;

    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->date(),
            'jenis_mutasi' => $this->faker->randomElement(['masuk', 'keluar']),
            'jumlah' => $this->faker->numberBetween(1, 100),
            'user_id' => null, 
            'barang_id' => null, 
        ];
    }
}
