<?php

namespace App\Exports;

use App\Models\Replacement;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReplacementExport implements FromView
{
    private $awal;

    private $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function view(): View
    {
        $replacements = Replacement::whereBetween('tanggal', [$this->awal, $this->akhir])
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('replacement.admin.export', [
            'replacements' => $replacements,
            'awal' => $this->awal,
            'akhir' => $this->akhir,
        ]);
    }
}
