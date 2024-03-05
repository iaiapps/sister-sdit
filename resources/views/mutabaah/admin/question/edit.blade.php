@extends('layouts.app')

@section('title', 'Edit Data Kategori')
@section('content')
    <div class="card p-3">
        <form action="{{ route('mutabaah-question.update', $mutabaah_question->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="question">Pertanyaan </label>
                            <input class="form-control bg-light" type="text" id="question" name="question"
                                placeholder="question" value="{{ $mutabaah_question->question }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
