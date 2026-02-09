<?php

namespace App\Http\Controllers\Replacement;

use App\Exports\ReplacementExport;
use App\Http\Controllers\Controller;
use App\Models\Replacement;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReplacementController extends Controller
{
    /**
     * Convert Tahun Akademik + Semester ke range tanggal
     */
    private function getSemesterRange($tahunAkademik, $semester)
    {
        $tahun = explode('-', $tahunAkademik);
        $tahunAwal = $tahun[0];
        $tahunAkhir = $tahun[1];

        if ($semester == 'ganjil') {
            return [
                'awal' => $tahunAwal.'-07-01',
                'akhir' => $tahunAwal.'-12-31',
            ];
        } else {
            return [
                'awal' => $tahunAkhir.'-01-01',
                'akhir' => $tahunAkhir.'-06-30',
            ];
        }
    }

    /**
     * Get Tahun Akademik dan Semester aktif saat ini
     */
    private function getSemesterAktif()
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;

        if ($month >= 7 && $month <= 12) {
            return [
                'tahun_akademik' => $year.'-'.($year + 1),
                'semester' => 'ganjil',
            ];
        } else {
            return [
                'tahun_akademik' => ($year - 1).'-'.$year,
                'semester' => 'genap',
            ];
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $now = Carbon::now();
        $semesterAktif = $this->getSemesterAktif();

        // Ambil parameter filter
        $tahunAkademik = $request->tahun_akademik ?? $semesterAktif['tahun_akademik'];
        $semester = $request->semester ?? $semesterAktif['semester'];

        // Convert ke range tanggal
        $range = $this->getSemesterRange($tahunAkademik, $semester);
        $awal = $range['awal'];
        $akhir = $range['akhir'];

        $replacements = Replacement::whereBetween('tanggal', [$awal, $akhir])->get();

        return view('replacement.admin.index', compact(
            'replacements',
            'now',
            'tahunAkademik',
            'semester',
            'awal',
            'akhir'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();

        return view('replacement.admin.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        Replacement::create($data);

        return redirect()->route('replacement.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Replacement $replacement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Replacement $replacement)
    {
        $teachers = Teacher::all();

        return view('replacement.admin.edit', compact('replacement', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Replacement $replacement)
    {
        $replacement->update($request->all());

        return redirect()->route('replacement.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Replacement $replacement)
    {
        $replacement->delete();

        return redirect()->route('replacement.index');
    }

    /**
     * Export data to Excel
     */
    public function export(Request $request)
    {
        $semesterAktif = $this->getSemesterAktif();

        $tahunAkademik = $request->tahun_akademik ?? $semesterAktif['tahun_akademik'];
        $semester = $request->semester ?? $semesterAktif['semester'];

        $range = $this->getSemesterRange($tahunAkademik, $semester);
        $awal = $range['awal'];
        $akhir = $range['akhir'];

        $filename = 'Data_Guru_Pengganti_'.str_replace('-', '_', $tahunAkademik).'_'.ucfirst($semester).'.xlsx';

        return Excel::download(new ReplacementExport($awal, $akhir), $filename);
    }

    // ------------------------------------- //
    // handle dari user
    public function list(Request $request)
    {
        $now = Carbon::now();
        $semesterAktif = $this->getSemesterAktif();

        // Ambil parameter filter
        $tahunAkademik = $request->tahun_akademik ?? $semesterAktif['tahun_akademik'];
        $semester = $request->semester ?? $semesterAktif['semester'];

        // Convert ke range tanggal
        $range = $this->getSemesterRange($tahunAkademik, $semester);
        $awal = $range['awal'];
        $akhir = $range['akhir'];

        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first()->id;
        $replacements = Replacement::where('teacher_id', $tid)
            ->whereBetween('tanggal', [$awal, $akhir])
            ->get();

        return view('replacement.teacher.index', compact(
            'replacements',
            'tid',
            'tahunAkademik',
            'semester',
            'awal',
            'akhir'
        ));
    }

    public function replacementCreate()
    {
        $teachers = Teacher::all();
        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first()->id;

        return view('replacement.teacher.create', compact('teachers', 'tid'));
    }

    public function replacementStore(Request $request)
    {
        $data = $request->all();
        // dd($data);
        Replacement::create($data);

        return redirect()->route('guru.replacement.list');
    }

    public function replacementEdit(Replacement $replacement)
    {
        $teachers = Teacher::all();
        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first()->id;

        return view('replacement.teacher.edit', compact('replacement', 'teachers', 'tid'));
    }

    public function replacementUpdate(Request $request, Replacement $replacement)
    {
        $replacement->update($request->all());

        return redirect()->route('guru.replacement.list')->with('msg', 'Data berhasil diperbarui!');
    }
}
