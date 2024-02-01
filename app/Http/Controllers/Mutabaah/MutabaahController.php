<?php

namespace App\Http\Controllers\Mutabaah;

use App\Models\Answer;
use App\Models\Mutabaah;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MutabaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $mutabaahs = Mutabaah::all();
        return view('mutabaah.index', compact('mutabaahs', 'now'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mutabaah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Mutabaah::create($request->all());
        return redirect()->route('mutabaah.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mutabaah $mutabaah)
    {

        return view('mutabaah.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mutabaah $mutabaah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mutabaah $mutabaah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mutabaah $mutabaah)
    {
        //
    }

    // lihat list guru masing-masing 
    public function mutabaahList(Request $request)
    {
        $mutabaah_id = $request->id;
        $answers = Answer::where('mutabaah_id', $mutabaah_id)->select('teacher_id', DB::raw("SUM(point) as t_point"),)->groupBy('teacher_id')->get();
        return view('mutabaah.list', compact('answers'));
    }

    public function mutabaahShow(Request $request)
    {
        $mutabaah_id = $request->m_id;
        $teacher_id = $request->t_id;
        $answers = Answer::where('mutabaah_id', $mutabaah_id)->where('teacher_id', $teacher_id)->get();
        // dd($answers);
        return view('mutabaah.show', compact('answers'));
    }
}
