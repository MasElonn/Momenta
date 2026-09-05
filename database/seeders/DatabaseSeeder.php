<?php

namespace Database\Seeders;

use App\Models\Acara;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@c.c',
            'password' => Hash::make('customer'),
            'role' => 'customer',
            'no_hp' => 80808080808
        ]);
        User::factory()->create([
            'name' => 'Fotografer',
            'email' => 'fotografer@f.f',
            'password' => Hash::make('fotografer'),
            'role' => 'fotografer',
            'no_hp' => 80808080808
        ]);
        Paket::factory()->create([
            'fotografer_id' => 2,
            'judul' => 'Paket 1',
            'deskripsi' => 'Paket 1 deskripsi lorem ipsum',
            'harga' => 100000,
        ]);
        Transaksi::factory()->create([
            'customer_id' => 1,
            'paket_id' => 1,
            'status' => 'paid',
            'verified_at' => now(),
            'paid_at' => now(),
        ]);
        Acara::factory()->create([
            'trans_id' => 1,
            'judul' => 'Acara 1',
            'lokasi' => 'SMK PGRI 3 Malang',
            'tanggal' => date('Y-m-d'),
            'deskripsi' => 'Acara 1 deskripsi lorem ipsum',
            'jam' => date('H:i:s'),
            'status' => 'completed',
        ]);
    }
}
