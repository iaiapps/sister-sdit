@extends('layouts.app')

@section('title', 'Buat Pilihan Jawaban')
@section('content')
    <div class="card p-3">
        <form action="{{ route('mutabaah-option.store') }}" method="POST">
            @csrf
            <fieldset>
                {{-- <div class="mb-3">
                    <label class="form-label" for="question">Pertanyaan</label>
                    <input value="{{ $id }}" name="question_id" readonly hidden>
                    <input class="form-control bg-light" type="text" id="question" name="question"
                        value="{{ $question }}" readonly />
                </div> --}}
                <div class="mb-3">
                    <label class="form-label" for="option_name">Pilihan Jawaban</label>
                    <input class="form-control" type="text" id="option_name" name="option_name" placeholder="Nama pilihan" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="option_point">Point Pilihan</label>
                    <input class="form-control" type="number" id="option_point" name="option_point"
                        placeholder="Besar Point" />
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Pertanyaan</button>
        </form>
    </div>

@endsection