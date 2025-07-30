<?php

namespace App\Http\Controllers\Mutabaah;

use App\Models\Answer;
use App\Models\Teacher;
use App\Models\Category;
use App\Models\Mutabaah;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MutabaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $mutabaahs = Mutabaah::all();
        return view('mutabaah.admin.index', compact('mutabaahs', 'now'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mutabaah.admin.create');
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

        return view('mutabaah.admin.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mutabaah $mutabaah)
    {
        return view('mutabaah.admin.edit', compact('mutabaah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mutabaah $mutabaah)
    {
        $data = $request->all();
        $mutabaah->update($data);
        return redirect()->route('mutabaah.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mutabaah $mutabaah)
    {
        $mutabaah->delete();
        return redirect()->route('mutabaah.index');
    }

    // lihat list guru masing-masing
    public function mutabaahList(Request $request)
    {
        $mutabaah_id = $request->id;
        $name_mutabaah = Mutabaah::where('id', $mutabaah_id)->first()->name;
        $categories = Category::all();
        $answer_all = Answer::where('mutabaah_id', $mutabaah_id)->get();

        // ini untuk mencari tanggal dan total point
        $answers = Answer::where('mutabaah_id', $mutabaah_id)
            ->select(
                'teacher_id',
                DB::raw("SUM(point) AS t_point"),
                DB::raw("DATE(created_at) AS tanggal"),
            )
            ->groupBy('teacher_id', 'tanggal')->get();
        return view('mutabaah.admin.list', compact('answers', 'name_mutabaah', 'categories', 'answer_all'));
    }

    // lihat list all
    public function mutabaahListall(Request $request)
    {
        $mutabaah_id = $request->id;
        $name_mutabaah = Mutabaah::where('id', $mutabaah_id)->first()->name;
        $categories = Category::all();
        $answer_all = Answer::where('mutabaah_id', $mutabaah_id)->get();

        // ini untuk mencari tanggal dan total point
        $answers = Answer::where('mutabaah_id', $mutabaah_id)
            ->select(
                'teacher_id',
                DB::raw("SUM(point) AS t_point"),
                DB::raw("DATE(created_at) AS tanggal"),
            )
            ->groupBy('teacher_id', 'tanggal')->get();
        return view('mutabaah.admin.listall', compact('answers', 'name_mutabaah', 'categories', 'answer_all'));
    }


    public function mutabaahShow(Request $request)
    {
        $mutabaah_id = $request->m_id;
        $teacher_id = $request->t_id;
        $question = Question::all();
        $answers = Answer::where('mutabaah_id', $mutabaah_id)->where('teacher_id', $teacher_id)->get();
        return view('mutabaah.admin.show', compact('answers', 'mutabaah_id', 'question'));
    }
}
