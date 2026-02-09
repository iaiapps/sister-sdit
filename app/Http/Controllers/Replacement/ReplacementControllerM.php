<?php

namespace App\Http\Controllers\Replacement;

use App\Http\Controllers\Controller;
use App\Models\Replacement;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReplacementControllerM extends Controller
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
                'awal' => $tahunAwal . '-07-01',
                'akhir' => $tahunAwal . '-12-31',
            ];
        } else {
            return [
                'awal' => $tahunAkhir . '-01-01',
                'akhir' => $tahunAkhir . '-06-30',
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
                'tahun_akademik' => $year . '-' . ($year + 1),
                'semester' => 'ganjil',
            ];
        } else {
            return [
                'tahun_akademik' => ($year - 1) . '-' . $year,
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
        $teachers = Teacher::all();

        // Ambil parameter filter
        $tahunAkademik = $request->tahun_akademik ?? $semesterAktif['tahun_akademik'];
        $semester = $request->semester ?? $semesterAktif['semester'];

        // Convert ke range tanggal
        $range = $this->getSemesterRange($tahunAkademik, $semester);
        $awal = $range['awal'];
        $akhir = $range['akhir'];

        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first();
        $replacements = Replacement::where('teacher_id', $tid->id)
            ->whereBetween('tanggal', [$awal, $akhir])
            ->get();

        return view('replacement.mobile.index', compact(
            'replacements',
            'teachers',
            'tid',
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
        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first()->id;

        return view('replacement.mobile.create', compact('teachers', 'tid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Replacement::create($data);

        return redirect()->route('pengganti-mobile.index')->with('msg', 'Berhasil menambahkan data !');
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
    public function edit(Replacement $pengganti_mobile)
    {
        $pengganti_mobile;
        $teachers = Teacher::all();
        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first()->id;

        return view('replacement.mobile.edit', compact('pengganti_mobile', 'teachers', 'tid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Replacement $pengganti_mobile)
    {
        $pengganti_mobile->update($request->all());

        return redirect()->route('pengganti-mobile.index')->with('msg', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Replacement $pengganti_mobile)
    {
        $pengganti_mobile->delete();

        return redirect()->route('pengganti-mobile.index')->with('msg', 'Data berhasil dihapus!');
    }

    // // ------------------------------------- //
    // // handle dari user
    // public function list()
    // {
    //     // $now = Carbon::now();
    //     // $year = Carbon::parse($now)->year;
    //     // $month = Carbon::parse($now)->month;
    //     $uid = Auth::user()->id;
    //     $tid = Teacher::where('user_id', $uid)->first()->id;
    //     $replacements = Replacement::where('teacher_id', $tid)->get();

    //     return view('replacement.teacher.index', compact('replacements', 'tid'));
    // }

    // // public function bpiCreate()
    // // {
    // //     $uid = Auth::user()->id;
    // //     $tid = Teacher::where('user_id', $uid)->first()->id;
    // //     return view('bpi.teacher.create', compact('tid'));
    // // }

    // public function replacementStore(Request $request)
    // {
    //     $data = $request->all();
    //     Replacement::create($data);
    //     return redirect()->route('guru.replacement.list');
    // }
}
