<?php

namespace App\Http\Controllers\Finance;

use App\Models\Salary;
use App\Models\Teacher;
use App\Models\Presence;
use App\Models\SalaryBasic;
use Illuminate\Http\Request;
use App\Exports\SalaryExport;
use App\Imports\SalaryImport;
use App\Models\SalaryAddition;
use Illuminate\Support\Carbon;
use App\Models\PresenceSetting;
use App\Models\SalaryReduction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Presence\PresenceController;
use App\Models\SalaryType;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $teachers = Teacher::get()->all();
        return view('finance.index', compact('teachers', 'year', 'month'));
    }

    public function listsalary(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $year = $request->year;
        $salaries = Salary::whereYear('created_at', $year)->where('teacher_id', $id)->get();
        $teacher = Teacher::where('id', $id)->get()->first();

        return view('finance.list', compact('salaries', 'teacher'));
    }

    // fungsi panggil jumlah presensi
    // public function _getPresenceMonth($date)
    // {
    //     $year = Carbon::parse($date)->year;
    //     $month = Carbon::parse($date)->month;
    //     $presences = Presence::whereYear('created_at', $year)->whereMonth('created_at', $month)
    //         ->select(
    //             'teacher_id',
    //             DB::raw("COUNT(*) as total_data_presensi"),
    //             DB::raw("SUM(is_late = 1) as is_late_a"),
    //             DB::raw("SUM(is_late = 2) as is_late_b"),
    //             DB::raw("SUM(is_late = 3) as is_late_c"),
    //             DB::raw("SUM(note = 'Sakit') as total_sakit"),
    //             DB::raw("SUM(note = 'Ijin') as total_ijin"),
    //         )->groupBy('teacher_id')->get();

    //     return $presences;
    // }

    //fungsi panggil setting presence
    public function _settingValue($for)
    {
        $presenceSetting = PresenceSetting::where('name', '=', $for)->first()->value;
        return $presenceSetting;
    }

    /**
     * Show the form for creating a new resource.
     */
    // buat gaji individual
    public function create(Request $request)
    {
        $date = $request->date;
        $id = $request->id;

        // ini ambil function dari PresenceController 
        $data = new PresenceController();
        $presence = $data->groupTeacherFilterMonth($date)->where('teacher_id', $id)->first();
        // $data = $presence->where('teacher_id', 3)->first();
        // dd($presence);

        //presensi
        // $presence = $this->_getPresenceMonth($date)->first();
        // $data = $presence->where('teacher_id', 3)->first();
        // dd($presence);

        //fee tepat waktu
        $fee_kehadiran = $this->_settingValue('fee_kehadiran');

        //potongan
        $potongan_late = $this->_settingValue('potongan_late');
        // $potongan_late_a = $this->_settingValue('potongan_late_a');
        // $potongan_late_b = $this->_settingValue('potongan_late_b');
        // $potongan_late_c = $this->_settingValue('potongan_late_c');

        $teacher = Teacher::where('id', $id)->get()->first();
        $basics = SalaryType::get()->all();
        // $additions = SalaryAddition::get()->all();
        // $reductions = SalaryReduction::get()->all();

        return view('finance.create', compact(
            'teacher',
            'basics',
            // 'additions',
            // 'reductions',
            'presence',
            'fee_kehadiran',
            'potongan_late',
            // 'potongan_late_a',
            // 'potongan_late_b',
            // 'potongan_late_c',
            'date'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi
        $validate = $request->validate([
            'tot_fee_kehadiran' => 'required',
            'gaji_pokok' => 'required',
            'komponen_a' => 'required',
            'komponen_b' => 'required',
            'komponen_c' => 'required',
            'total' => 'required',
        ]);

        $validate = $request->all();

        $time = Carbon::now()->format('Hi');
        $day = Carbon::parse($request->bulan)->day;
        $month = Carbon::parse($request->bulan)->month;
        $year = Carbon::parse($request->bulan)->year;
        $id = $request->id;

        $validate['bulan'] = $year . '-' . $month . '-' . $day;
        $validate['teacher_id'] = $id;
        $validate['nomor_slip'] = $id . $day . $month . $year;
        // dd($validate);

        Salary::create($validate);

        return redirect()->route('list', ['id' => $id, 'year' => $year]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Salary $salary)
    {
        $id = $request->id;
        // dd($request);
        $teacher = Teacher::where('id', $id)->get()->first();
        return view('finance.show', compact('salary', 'teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        //
    }

    public function bulkcreate(Request $request)
    {
        $date = Carbon::parse($request->date)->format('Y-m-d');
        // dd($date);
        $id = $request->id;
        //fee tepat waktu
        $fee_kehadiran = $this->_settingValue('fee_kehadiran');
        //potongan
        $potongan_late = $this->_settingValue('potongan_late');

        //presensi ambil dari Presence Controller
        $data = new PresenceController();
        $presences = $data->groupTeacherFilterMonth($date);

        return view('finance.bulk', compact(
            'presences',
            'date',
            'fee_kehadiran',
            'potongan_late',
        ));
    }

    public function salaryexport(Request $request)
    {
        $date = $request->date;
        $month = Carbon::parse($request->date)->isoFormat('MMMM');
        return Excel::download(new SalaryExport($date),  'template-gaji' . '-' . $month . '.xlsx');
    }

    public function salaryimport()
    {
        Excel::import(new SalaryImport, request()->file('file'));
        return redirect()->route('listmassal');
    }

    public function listmassal(Request $request)
    {
        $date = $request->date;
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $salaries = Salary::whereYear('created_at', $year)->whereMonth('bulan', $month)->get();
        // dd($salaries);
        return view('finance.listmassal', compact('salaries'));
    }


    // .......................................//
    //handle dari user
    //salary
    public function teacherSalary(Request $request)
    {
        // dd($request);
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->get()->first();
        $teacher_id = $teacher->id;
        $year = Carbon::now();


        $salaries = Salary::whereYear('created_at', $year)->where('teacher_id', $teacher_id)->get();
        // $teacher = Teacher::where('id', $id)->get()->first();

        return view('finance.list', compact('salaries', 'teacher', 'user_id'));
    }
}
