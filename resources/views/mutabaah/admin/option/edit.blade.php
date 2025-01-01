@extends('layouts.app')

@section('title', 'Edit Data Kategori')
@section('content')
    <div class="card p-3">
        <form action="{{ route('mutabaah-option.update', $mutabaah_option->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="option_name">Pilihan Jawaban </label>
                            <input class="form-control bg-light" type="text" id="option_name" name="option_name"
                                placeholder="Nama Pilihan" value="{{ $mutabaah_option->option_name }}" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="option_point">Point </label>
                            <input class="form-control bg-light" type="number" id="option_point" name="option_point"
                                placeholder="Point" value="{{ $mutabaah_option->option_point }}" />
                        </div>
                    </div>
                    {{-- <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="question">Point Option </label>
                            <select name="question_id" id="question" class="form-select">
                                <option disabled>--- pilih pertanyaan ---</option>
                                @foreach ($questions as $q)
                                    <option value={{ $q->id }}>{{ $q->question }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
