<?php

namespace App\Http\Controllers\Mutabaah;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        $categories = Category::all();
        return view('mutabaah.admin.question.index', compact('questions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Question::create($request->all());
        return redirect()->route('mutabaah-question.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $mutabaah_question)
    {
        return view('mutabaah.admin.question.edit', compact('mutabaah_question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $mutabaah_question)
    {
        $mutabaah_question->update($request->all());
        return redirect()->route('mutabaah-question.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $mutabaah_question)
    {
        $mutabaah_question->delete();
        return redirect()->route('mutabaah-question.index');
    }
}
