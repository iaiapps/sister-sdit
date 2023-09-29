<?php

namespace App\Exports;

use App\Models\Salary;
use App\Models\Presence;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Http\Controllers\Finance\SalaryController;
use App\Http\Controllers\Presence\PresenceController;

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
        $datae = new PresenceController();
        $presences = $datae->groupTeacherFilterMonth($tanggal);

        $data = new SalaryController();

        //fee tepat waktu
        $fee_kehadiran = $data->_settingValue('fee_kehadiran');
        //potongan
        $potongan_late = $data->_settingValue('potongan_late');


        return view('finance.export', [
            'presences' => $presences,
            'date' => $tanggal,
            'fee_kehadiran' => $fee_kehadiran,
            'potongan_late' => $potongan_late,

        ]);
    }
}
