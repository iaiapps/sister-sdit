@extends('layouts.app')

@section('title', 'Edit Data Kategori')
@section('content')
    <div class="card p-3">
        <form action="{{ route('mutabaah-question.update', $mutabaah_question->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <input type="text" value="{{ $mutabaah_question->category_id }}" name="category_id" hidden readonly>
                <div class="mb-3">
                    <label class="form-label" for="question">Pertanyaan </label>
                    <input class="form-control bg-light" type="text" id="question" name="question" placeholder="question"
                        value="{{ $mutabaah_question->question }}" />
                </div>

            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
