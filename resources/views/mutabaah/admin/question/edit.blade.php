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
                    <label class="form-label mb-0" for="question_for">Kategori pertanyaan untuk? </label>
                    <br>
                    <small>
                        (jika pertanyaan untuk semua isi dengan all)
                        <br>
                        (jika pertanyaan untuk guru isi dengan guru)
                        <br>
                        (jika pertanyaan untuk tendik isi dengan tendik)
                        <br>
                        (jika pertanyaan untuk karyawan isi dengan karyawan)
                    </small>
                    <input class="form-control bg-light" type="text" id="question_for" name="question_for"
                        placeholder="Untuk ?" value="{{ $mutabaah_question->question_for }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="question">Pertanyaan </label>
                    <input class="form-control bg-light" type="text" id="question" name="question"
                        placeholder="question" value="{{ $mutabaah_question->question }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="max_point">Maksimal Point </label>
                    <input class="form-control bg-light" type="text" id="max_point" name="max_point"
                        placeholder="max_point" value="{{ $mutabaah_question->max_point }}" />
                </div>

            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
