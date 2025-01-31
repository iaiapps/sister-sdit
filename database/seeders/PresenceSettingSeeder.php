<?php

namespace Database\Seeders;

use App\Models\PresenceSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PresenceSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seeder presensi
        PresenceSetting::create([
            'name' => 'ontime_until',
            'value' => '07:16',
            'desc' => 'Jam masuk sekolah'
        ]);
        PresenceSetting::create([
            'name' => 'early_time_come',
            'value' => '06:00',
            'desc' => 'Awal jam presensi '
        ]);
        // PresenceSetting::create([
        //     'name' => 'end_time_come',
        //     'value' => '08:30',
        //     'desc' => 'Akhir presensi jam datang'
        // ]);
        PresenceSetting::create([
            'name' => 'early_time_leave',
            'value' => '15:15',
            'desc' => 'Awal jam presensi pulang'
        ]);
        PresenceSetting::create([
            'name' => 'end_time_leave',
            'value' => '18:00',
            'desc' => 'Akhir jam presensi'
        ]);
        PresenceSetting::create([
            'name' => 'timeline',
            'value' => true,
            'desc' => 'pembatasan waktu presensi'
        ]);

        //seeder waktu telat
        // PresenceSetting::create([
        //     'name' => 'late_a',
        //     'value' => '07:21',
        //     'desc' => 'kategori terlambat 1 (0-5 menit pertama)'
        // ]);
        // PresenceSetting::create([
        //     'name' => 'late_b',
        //     'value' => '07:46',
        //     'desc' => 'kategori terlambat 2 (dari 10 menit kedua)'
        // ]);
        // PresenceSetting::create([
        //     'name' => 'late_c',
        //     'value' => '08:00',
        //     'desc' => 'kategori terlambat 3 (15 menit ketiga)'
        // ]);

        //seeder fee dan potongan
        // PresenceSetting::create([
        //     'name' => 'fee_kehadiran',
        //     'value' => 25000,
        //     'desc' => 'tepat waktu',
        // ]);
        // PresenceSetting::create([
        //     'name' => 'potongan_late',
        //     'value' => 6000,
        //     'desc' => 'potongan keterlambatan',
        // ]);
        // PresenceSetting::create([
        //     'name' => 'potongan_late_b',
        //     'value' => 3000,
        //     'desc' => 'potongan terlambat b',
        // ]);
        // PresenceSetting::create([
        //     'name' => 'potongan_late_c',
        //     'value' => 6000,
        //     'desc' => 'potongan terlambat c',
        // ]);

        //seeder qrcode
        PresenceSetting::create([
            'name' => 'qrcode',
            'value' => 'SDITQR' . '-' . date('Ymd'),
            'desc' => 'data qr code',
        ]);

        // koordinat milik SDIT Harum
        PresenceSetting::create([
            'name' => 'latitude',
            'value' => '-8.154578',
            'desc' => 'kooridnat latitude',
        ]);
        PresenceSetting::create([
            'name' => 'longitude',
            'value' => '113.71743',
            'desc' => 'data qr code',
        ]);
        PresenceSetting::create([
            'name' => 'radius',
            'value' => '500',
            'desc' => 'batas radius (m)',
        ]);
    }
}
