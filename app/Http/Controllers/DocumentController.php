<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nis = Auth::user()->nis;
        $id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $id)->get()->first();
        $student = Student::where('user_id', $id)->get()->first();

        if ($nis == null) {
            if ($request->id == null) {
                $teacher_id = $teacher->id;
            } else {
                $teacher_id = $request->id;
            }
            $documents = Document::where('teacher_id', $teacher_id)->get();
            return view('document.index', compact('teacher', 'documents'));
        } else {
            if ($request->id == null) {
                $student_id = $student->id;
            } else {
                $student_id = $request->id;
            }
            $documents = Document::where('student_id', $student_id)->get();
            return view('document.index', compact('student', 'documents'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //cek id
        $id = Auth::user()->id;
        $nis = Auth::user()->nis;
        if ($nis == '') {
            $teacher_id = Teacher::where('user_id', $id)->get()->first()->id;
        } else {
            $student_id = Student::where('user_id', $id)->get()->first()->id;
        }


        //validate
        $imgDocument = $request->validate([
            'type' => 'required',
            'file' => 'image|file|max:512',
        ]);

        if ($nis == '') {
            //beri nama
            $file = $request->file('file');
            $file_name = $teacher_id . '-teacher' . '-' . time() . '-' . $file->getClientOriginalName();
        } else {
            $file = $request->file('file');
            $file_name = $student_id . '-student' . '-' . time() . '-' . $file->getClientOriginalName();
        }
        //simpan ke folder
        // ini di folder public
        // $request->file('file')->move(public_path('img-document'), $file_name); 
        // ini di folder storage
        $request->file('file')->storeAs('public/img-document', $file_name);

        //masukkan ke array validate
        $imgDocument['file'] = $file_name;

        if ($nis == '') {
            $imgDocument['teacher_id'] = $teacher_id;
        } else {
            $imgDocument['student_id'] = $student_id;
        }

        //simpan ke database
        Document::create($imgDocument);

        return redirect()->route('document.index')->with('success', 'Data telah ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        // dd($document);
        $id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $id)->get()->first();
        return view('document.show', compact('teacher', 'document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {

        // if (Storage::exists('public/img-document/' . $document->file)) {
        //     dd('ada');
        // } else {
        //     dd('File does not exists.');
        // }

        // dd('/storage/img-document/' . $document->file);
        Storage::delete('/public/img-document/' . $document->file);
        $document->delete();

        return redirect()->route('document.index');
    }
}
