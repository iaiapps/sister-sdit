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
        DB::table('presence_settings')->insert([
            [
                'name' => 'ontime_until',
                'value' => '07:15',
                'desc' => 'Jam masuk'
            ],
            [
                'name' => 'early_time_come',
                'value' => '06:30',
                'desc' => 'Awal jam presensi'
            ],
            [
                'name' => 'end_time_come',
                'value' => '08:30',
                'desc' => 'Akhir presensi jam datang'
            ],
            [
                'name' => 'early_time_leave',
                'value' => '14:00',
                'desc' => 'Awal jam pulang'
            ],
            [
                'name' => 'end_time_leave',
                'value' => '16:30',
                'desc' => 'Akhir presensi jam pulang'
            ],
            [
                'name' => 'timeline',
                'value' => true,
                'desc' => 'pembatasan waktu presensi'
            ],
            [
                'name' => 'late_a',
                'value' => '07:21',
                'desc' => 'kategori terlambat 1 (0-5 menit pertama)'
            ],
            [
                'name' => 'late_b',
                'value' => '07:46',
                'desc' => 'kategori terlambat 2 (dari 10 menit kedua)'
            ],
            [
                'name' => 'late_c',
                'value' => '08:00',
                'desc' => 'kategori terlambat 3 (15 menit ketiga)'
            ],
            [
                'name' => 'potongan_late_a',
                'value' => 0,
                'desc' => 'potongan terlambat a',
            ],
            [
                'name' => 'potongan_late_b',
                'value' => 3000,
                'desc' => 'potongan terlambat b',
            ],
            [
                'name' => 'potongan_late_c',
                'value' => 6000,
                'desc' => 'potongan terlambat c',
            ],
            [
                'name' => 'tepat_waktu',
                'value' => 25000,
                'desc' => 'tepat waktu',
            ],
            [
                'name' => 'qrcode',
                'value' => 'SDITQR' . '-' . date('Ymd'),
                'desc' => 'data qr code',
            ],


        ]);
    }
}
