<?php

namespace App\Imports;

use App\Models\Salary;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


class SalaryImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Salary([
            'teacher_id' => $row['teacher_id'],
            'nomor_slip' => $row['nomor_slip'],
            'bulan' => $row['bulan'],
            'hadir' => $row['hadir'],
            'tepat' => $row['tepat'],
            'telat' => $row['telat'],
            'gaji_pokok' => $row['gaji_pokok'],
            'gaji_fungsional' => $row['gaji_fungsional'],
            'tot_fee_kehadiran' => $row['tot_fee_kehadiran'],
            'ekskul' => $row['ekskul'],
            'istri_anak' => $row['istri_anak'],
            'sukses_un_khotib' => $row['sukses_un_khotib'],
            'fee' => $row['fee'],
            'hari_raya' => $row['hari_raya'],
            'dpp' => $row['dpp'],
            'koperasi' => $row['koperasi'],
            'peminjaman' => $row['peminjaman'],
            'dansos' => $row['dansos'],
            'bpjs' => $row['bpjs'],
            'komponen_a' => $komponen_a = $row['gaji_pokok'] + $row['gaji_fungsional'] + $row['tot_fee_kehadiran'],
            'komponen_b' => $komponen_b = $row['ekskul'] + $row['istri_anak'] + $row['sukses_un_khotib'] + $row['fee'] + $row['hari_raya'],
            'komponen_c' => $komponen_c = $row['dpp'] + $row['koperasi'] + $row['peminjaman'] + $row['dansos'] + $row['bpjs'],
            'total' => $komponen_a + $komponen_b - $komponen_c,
        ]);
    }
}
