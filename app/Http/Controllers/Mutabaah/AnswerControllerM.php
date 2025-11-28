<?php

namespace App\Http\Controllers\Mutabaah;

use App\Models\Answer;
use App\Models\Teacher;
use App\Models\Category;
use App\Models\Mutabaah;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        // SOLUSI 1: Validasi di database - cek apakah sudah ada data
        $existingAnswer = Answer::where('teacher_id', $teacher_id)
            ->where('mutabaah_id', $mutabaah_id)
            ->first();

        if ($existingAnswer) {
            return response()->json([
                'success' => false,
                'message' => 'Data mutabaah sudah pernah disimpan sebelumnya.'
            ], 422);

            // Atau untuk redirect biasa:
            // return redirect()->route('mutabaah-mobile.index')
            //     ->with('error', 'Data mutabaah sudah pernah disimpan sebelumnya.');
        }

        $question_id = $request->question_id;
        $option = $request->option;

        // Validasi input required
        foreach ($question_id as $q) {
            $validate_array['option.' . $q] = 'required';
        };

        $messages = [
            'required' => 'Ada jawaban yang masih kosong.',
        ];

        $valid = $request->validate($validate_array, $messages);

        $category_id = $request->category_id;

        // Gunakan database transaction
        DB::beginTransaction();
        try {
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

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menambahkan data!',
                'redirect' => route('mutabaah-mobile.index')
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
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
