<?php

namespace App\Http\Controllers\Mutabaah;

use App\Models\Answer;
use App\Models\Teacher;
use App\Models\Category;
use App\Models\Mutabaah;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $mutabaahs = Mutabaah::all();
        return view('mutabaah.answer.index', compact('mutabaahs', 'now'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $questions = Question::all();
        // dd($questions);
        $teachers = Teacher::all();
        $categories = Category::all();
        return view('mutabaah.answer.create', compact('teachers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $teacher_id = $request->teacher_id;
        $mutabaah_id = $request->mutabaah_id;
        $question_id = $request->question_id;
        // $category_id = $request->category_id;
        $option = $request->option;

        // $point = $request->point;
        // $point = 0;
        foreach ($question_id as $q) {
            $fields = explode(',', $option[$q]);
            $data = [
                'teacher_id' => $teacher_id,
                'mutabaah_id' => $mutabaah_id,
                // 'category_id' => $category_id[$q],
                'question_id' => $question_id[$q],
                'option_id' => $option[$q],
                'answer' => $fields[0],
                'point' => $fields[1],
            ];
            Answer::create($data);
        }

        // total point
        // foreach ($option as $o) {
        //     $o;
        //     $point += $o;
        // }
        return redirect()->route('mutabaah-answer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Answer $answer)
    {
        // $teacher_id = Answer::where('')
        // dd($request->all());
        // return view('mutabaah.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
