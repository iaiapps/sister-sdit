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
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class AnswerControllerM extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user)->first();
        $now = Carbon::now()->format('Y-m-d');
        $mutabaahs = Mutabaah::all();
        // $exist = Answer::where('mutabaah_id', $mutabaah_id)->where('teacher_id', $teacher->id)->exists();
        // $answer = Answer::where('teacher_id', $teacher->id);
        // dd($answer);
        return view('mutabaah.mobile.index', compact('mutabaahs', 'now', 'teacher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $mutabaah_id = $request->mutabaah;
        $id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $id)->first();
        $exist = Answer::where('mutabaah_id', $mutabaah_id)->where('teacher_id', $teacher->id)->exists();

        $categories = Category::all();
        return view('mutabaah.mobile.create', compact('teacher', 'categories', 'exist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teacher_id = $request->teacher_id;
        $mutabaah_id = $request->mutabaah_id;
        $question_id = $request->question_id;
        $option = $request->option;

        // ini untuk looping validasi input radio
        foreach ($question_id as $q) {
            // buatkan variabel untuk dimasukkan ke dalam array dari "name" di input radio
            $validate_array['option.' . $q] = 'required';
        };

        // pesan error custom
        $messages = [
            'required' => 'Ada jawaban yang masih kosong.',
        ];

        // setelah di looping masukkan ke method validate()
        $valid = $request->validate($validate_array, $messages);
        // dd($valid);
        $category_id = $request->category_id;
        // looping satu persatu untuk dimasukkan ke database
        foreach ($question_id as $q) {
            $fields = explode(',', $option[$q]);
            $data = [
                'teacher_id' => $teacher_id,
                'mutabaah_id' => $mutabaah_id,
                'category_id' => $category_id[$q],
                'question_id' => $question_id[$q],
                'option_id' => $option[$q],
                'answer' => $fields[0],
                'point' => $fields[1],
            ];
            Answer::create($data);
        }
        return redirect()->route('mutabaah-mobile.index')->with('msg', 'Berhasil menambahkan data!');
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
