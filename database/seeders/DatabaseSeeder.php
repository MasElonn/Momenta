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
        $customer = User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@c.c',
            'password' => Hash::make('customer'),
            'role' => 'customer',
            'no_hp' => 80808080808
        ]);
        $fotografer = User::factory()->create([
            'name' => 'Fotografer',
            'email' => 'fotografer@f.f',
            'password' => Hash::make('fotografer'),
            'role' => 'fotografer',
            'no_hp' => 80808080808
        ]);
        $paket = Paket::factory()->create([
            'fotografer_id' => $fotografer->user_id,
            'judul' => 'Paket 1',
            'deskripsi' => 'Paket 1 deskripsi lorem ipsum',
            'harga' => 100000,
        ]);
        $transaksi = Transaksi::factory()->create([
            'trans_id' => 'BK-1-1-l9iB9',
            'customer_id' => $customer->user_id,
            'paket_id' => $paket->paket_id,
            'status' => 'unpaid',
            'verified_at' => now(),
            'paid_at' => now(),
        ]);
        Acara::factory()->create([
            'trans_id' => $transaksi->trans_id,
            'judul' => 'Acara 1',
            'lokasi' => 'SMK PGRI 3 Malang',
            'tanggal' => date('Y-m-d'),
            'deskripsi' => 'Acara 1 deskripsi lorem ipsum',
            'jam' => date('H:i:s'),
            'status' => 'completed',
        ]);
    }
}
