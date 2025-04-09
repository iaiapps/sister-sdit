<?php

namespace App\Http\Controllers\Replacement;

use App\Models\Teacher;
use App\Models\Replacement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReplacementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $now = Carbon::now();
        $month = Carbon::parse($now)->month;

        $awal = $request->awal;
        $akhir = $request->akhir;

        if (isset($awal) && isset($akhir)) {
            $replacements = Replacement::whereBetween('tanggal', [$awal, $akhir])->get();
        } else {
            $replacements = Replacement::whereMonth('tanggal', $month)->get();
        };
        return view('replacement.admin.index', compact('replacements', 'now', 'awal', 'akhir'));
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

    // ------------------------------------- //
    // handle dari user
    public function list()
    {
        $now = Carbon::now();
        $year = Carbon::parse($now)->year;
        // $month = Carbon::parse($now)->month;
        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first()->id;
        $replacements = Replacement::where('teacher_id', $tid)->whereYear('tanggal', $year)->get();
        // dd($replacements);
        return view('replacement.teacher.index', compact('replacements', 'tid'));
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
}
