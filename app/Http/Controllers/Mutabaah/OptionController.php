<?php

namespace App\Http\Controllers\Mutabaah;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = Option::all();
        return view('mutabaah.admin.option.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $question = Question::find($id);
        return view('mutabaah.admin.option.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Option::create($request->all());
        return redirect()->route('mutabaah-question.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $mutabaah_option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $mutabaah_option)
    {
        $questions = Question::all();
        return view('mutabaah.admin.option.edit', compact('mutabaah_option', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $mutabaah_option)
    {
        $mutabaah_option->update($request->all());
        return redirect()->route('mutabaah-option.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $mutabaah_option)
    {
        $mutabaah_option->delete();
        return redirect()->route('mutabaah-option.index');
    }

    // public function createOption(Request $request)
    // {
    //     $id = $request->id;
    //     $question = Question::find($id);
    //     return view('mutabaah.question.create_option', $question);
    // }
    // public function storeOption(Request $request)
    // {
    //     Option::create($request->all());
    //     return redirect()->route('mutabaah-option.index');
    // }
}
