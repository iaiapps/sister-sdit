<?php

namespace App\Imports;

use App\Models\Salary;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


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
            'komponen_a' => $row['komponen_a'],
            'komponen_b' => $row['komponen_b'],
            'komponen_c' => $row['komponen_c'],
            'total' => $row['total'],
        ]);
    }
}
