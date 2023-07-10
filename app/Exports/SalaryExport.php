<?php

namespace App\Exports;

use App\Models\Salary;
use App\Models\Presence;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Http\Controllers\SalaryController;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

// class SalaryExport implements FromCollection, WithHeadings
class SalaryExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     dd(Salary::all());
    //     return Salary::all();
    // }

    // public function headings(): array
    // {
    //     return ["teacher_id", "nomor_slip", "bulan"];
    // }

    //ini passing parameter
    private $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function view(): View
    {
        $tanggal = $this->date;
        $data = new SalaryController();

        $presences = $data->_getPresenceMonth($tanggal);

        //fee tepat waktu
        $fee_kehadiran = $data->_settingValue('fee_kehadiran');
        //potongan
        $potongan_late_a = $data->_settingValue('potongan_late_a');
        $potongan_late_b = $data->_settingValue('potongan_late_b');
        $potongan_late_c = $data->_settingValue('potongan_late_c');

        return view('admin.salary.export', [
            'presences' => $presences,
            'date' => $tanggal,
            'fee_kehadiran' => $fee_kehadiran,
            'potongan_late_a' => $potongan_late_a,
            'potongan_late_b' => $potongan_late_b,
            'potongan_late_c' => $potongan_late_c,
        ]);
    }
}
