<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barang;
use App\Models\Mutasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MutasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $barangs = Barang::all();

        Mutasi::factory()->count(50)->create([
            'user_id' => $users->random()->id,
            'barang_id' => $barangs->random()->id,
        ]);
    }
}
