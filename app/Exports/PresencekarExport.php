<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Presence;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\Presence\PresencekaryawanController;

class PresencekarExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Presence::all();
    // }

    private $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function view(): View
    {
        $tanggal = $this->date;
        // dd(Carbon::parse($tanggal)->isoFormat('MMMM Y'));
        $data = new PresencekaryawanController();

        $presences = $data->groupTeacherFilterMonth($tanggal);
        // dd($presences);
        return view('presencekar.export', [
            'presences' => $presences,
            'date' => Carbon::parse($tanggal)->isoFormat('MMMM Y')

        ]);
    }
}
