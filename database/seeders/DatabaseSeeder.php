<?php

namespace Database\Seeders;

use App\Models\Acara;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Momenta',
            'email' => 'admin@momenta.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status_akun' => 'active',
            'no_hp' => '081234567890',
        ]);

        $fotografer1 = User::create([
            'name' => 'Dimas Arya',
            'email' => 'fotografer@f.f',
            'password' => Hash::make('fotografer'),
            'role' => 'fotografer',
            'status_akun' => 'active',
            'no_hp' => '081234567891',
            'lokasi' => 'Malang',
            'bio' => 'Spesialis foto acara sekolah dan wisuda dengan gaya natural serta hangat. Siap mengabadikan setiap momen terbaik siswa dan guru.',
            'instagram' => '@dimasarya.lens',
        ]);

        $fotografer2 = User::create([
            'name' => 'Raka Wicaksono',
            'email' => 'raka@momenta.id',
            'password' => Hash::make('fotografer'),
            'role' => 'fotografer',
            'status_akun' => 'active',
            'no_hp' => '081234567892',
            'lokasi' => 'Malang & Batu',
            'bio' => 'Menangkap aksi dinamis dan ekspresi kompetitif pada turnamen olahraga sekolah serta classmeeting.',
            'instagram' => '@rakawicaksono_',
        ]);

        $fotografer3 = User::create([
            'name' => 'Bayu Pratama',
            'email' => 'bayu@momenta.id',
            'password' => Hash::make('fotografer'),
            'role' => 'fotografer',
            'status_akun' => 'active',
            'no_hp' => '081234567895',
            'lokasi' => 'Malang',
            'bio' => 'Spesialis liputan pensi, konser sekolah, dan malam inaugurasi dengan pencahayaan panggung dramatis.',
            'instagram' => '@bayupratama.shots',
        ]);

        $fotografer4 = User::create([
            'name' => 'Siti Rahmawati',
            'email' => 'siti@momenta.id',
            'password' => Hash::make('fotografer'),
            'role' => 'fotografer',
            'status_akun' => 'active',
            'no_hp' => '081234567896',
            'lokasi' => 'Surabaya & Malang',
            'bio' => 'Fokus pada foto potret yearbook kelas XII dan seremoni perpisahan angkatan yang penuh kenangan.',
            'instagram' => '@sitirahma.portrait',
        ]);

        $fotograferPending = User::create([
            'name' => 'Bima Sena Photography',
            'email' => 'bima.sena@gmail.com',
            'password' => Hash::make('fotografer'),
            'role' => 'fotografer',
            'status_akun' => 'pending',
            'no_hp' => '082198765432',
            'lokasi' => 'Malang',
        ]);

        $customer1 = User::create([
            'name' => 'Riendra Abimanyu',
            'email' => 'customer@c.c',
            'password' => Hash::make('customer'),
            'role' => 'customer',
            'status_akun' => 'active',
            'no_hp' => '081234567893',
        ]);

        $customer2 = User::create([
            'name' => 'Sarah Paramitha',
            'email' => 'sarah@gmail.com',
            'password' => Hash::make('customer'),
            'role' => 'customer',
            'status_akun' => 'active',
            'no_hp' => '081234567894',
        ]);

        $paket1 = Paket::create([
            'fotografer_id' => $fotografer1->user_id,
            'judul' => 'Paket Wisuda Lengkap',
            'deskripsi' => 'Dokumentasi prosesi wisuda, foto angkatan, hingga seremoni bersama keluarga.',
            'harga' => 650000,
            'durasi' => '4 Jam',
            'jumlah_foto' => '150+ Foto Edit',
            'jumlah_fotografer' => '1 Fotografer',
            'durasi_galeri' => '30 Hari Online',
            'is_populer' => true,
            'tersedia' => true,
        ]);

        $paket2 = Paket::create([
            'fotografer_id' => $fotografer1->user_id,
            'judul' => 'Paket Pentas Seni & Festival',
            'deskripsi' => 'Dokumentasi dinamis panggung pensi, aksi panggung siswa, dan antusiasme penonton.',
            'harga' => 950000,
            'durasi' => '6 Jam',
            'jumlah_foto' => '300+ Foto Edit',
            'jumlah_fotografer' => '2 Fotografer',
            'durasi_galeri' => '60 Hari Online',
            'is_populer' => false,
            'tersedia' => true,
        ]);

        $paket3 = Paket::create([
            'fotografer_id' => $fotografer1->user_id,
            'judul' => 'Paket Classmeeting & Sport',
            'deskripsi' => 'Liputan foto aksi pertandingan dan seremoni penghargaan pemenang lomba sekolah.',
            'harga' => 500000,
            'durasi' => '3 Jam',
            'jumlah_foto' => '120+ Foto Edit',
            'jumlah_fotografer' => '1 Fotografer',
            'durasi_galeri' => '30 Hari Online',
            'is_populer' => false,
            'tersedia' => true,
        ]);

        $paket4 = Paket::create([
            'fotografer_id' => $fotografer2->user_id,
            'judul' => 'Paket Olahraga & Turnamen Sekolah',
            'deskripsi' => 'Dokumentasi turnamen futsal, basket, dan lomba atletik sekolah berkecepatan tinggi.',
            'harga' => 450000,
            'durasi' => '3 Jam',
            'jumlah_foto' => '100+ Foto Edit',
            'jumlah_fotografer' => '1 Fotografer',
            'durasi_galeri' => '30 Hari Online',
            'is_populer' => true,
            'tersedia' => true,
        ]);

        $paket5 = Paket::create([
            'fotografer_id' => $fotografer3->user_id,
            'judul' => 'Paket Konser & Panggung Pensi',
            'deskripsi' => 'Liputan panggung audio-visual, live performance siswa & bintang tamu dengan angle sinematik.',
            'harga' => 850000,
            'durasi' => '5 Jam',
            'jumlah_foto' => '250+ Foto Edit',
            'jumlah_fotografer' => '2 Fotografer',
            'durasi_galeri' => '60 Hari Online',
            'is_populer' => false,
            'tersedia' => true,
        ]);

        $paket6 = Paket::create([
            'fotografer_id' => $fotografer4->user_id,
            'judul' => 'Paket Potret Angkatan & Yearbook',
            'deskripsi' => 'Sesi foto outdoor maupun indoor per kelas, pose santai serta formil untuk album kenangan sekolah.',
            'harga' => 700000,
            'durasi' => '4 Jam',
            'jumlah_foto' => '180+ Foto Edit',
            'jumlah_fotografer' => '1 Fotografer',
            'durasi_galeri' => '45 Hari Online',
            'is_populer' => true,
            'tersedia' => true,
        ]);

        $trans1Id = 'BK-' . $customer1->user_id . '-' . $paket1->paket_id . '-' . Str::random(5);
        $trans1 = Transaksi::create([
            'trans_id' => $trans1Id,
            'customer_id' => $customer1->user_id,
            'paket_id' => $paket1->paket_id,
            'status' => 'paid',
            'verified_at' => now()->subDays(2),
            'paid_at' => now()->subDays(2),
        ]);

        Acara::create([
            'trans_id' => $trans1->trans_id,
            'judul' => 'Wisuda Akbar SMK PGRI 3 Malang',
            'lokasi' => 'Aula Utama SMK PGRI 3 Malang',
            'tanggal' => now()->subDays(2)->toDateString(),
            'jam' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'deskripsi' => 'Dokumentasi prosesi pelepasan wisudawan kelas XII dan foto bersama keluarga.',
            'status' => 'completed',
        ]);

        $trans2Id = 'BK-' . $customer1->user_id . '-' . $paket2->paket_id . '-' . Str::random(5);
        $trans2 = Transaksi::create([
            'trans_id' => $trans2Id,
            'customer_id' => $customer1->user_id,
            'paket_id' => $paket2->paket_id,
            'status' => 'paid',
            'verified_at' => now()->subDay(),
            'paid_at' => now()->subDay(),
        ]);

        Acara::create([
            'trans_id' => $trans2->trans_id,
            'judul' => 'Pentas Seni & Festival Budaya 2026',
            'lokasi' => 'Lapangan Indoor SMK PGRI 3 Malang',
            'tanggal' => now()->addDays(5)->toDateString(),
            'jam' => '09:00:00',
            'jam_selesai' => '15:00:00',
            'deskripsi' => 'Liputan penampilan band sekolah, tari tradisional, dan bazar OSIS.',
            'status' => 'upcoming',
        ]);

        $trans3Id = 'BK-' . $customer2->user_id . '-' . $paket3->paket_id . '-' . Str::random(5);
        $trans3 = Transaksi::create([
            'trans_id' => $trans3Id,
            'customer_id' => $customer2->user_id,
            'paket_id' => $paket3->paket_id,
            'status' => 'pending',
            'paid_at' => now(),
            'bukti_bucket' => $trans3Id . '/bukti',
            'bukti_key' => 'sample_receipt.jpg',
        ]);

        Acara::create([
            'trans_id' => $trans3->trans_id,
            'judul' => 'Final Classmeeting Futsal Antar Jurusan',
            'lokasi' => 'GOR Pertiwi Malang',
            'tanggal' => now()->addDays(12)->toDateString(),
            'jam' => '13:00:00',
            'jam_selesai' => '16:00:00',
            'deskripsi' => 'Pertandingan final futsal putra RPL vs TKJ dan serah terima piala.',
            'status' => 'upcoming',
        ]);
    }
}
