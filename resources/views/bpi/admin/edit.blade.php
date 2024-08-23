@extends('layouts.app')

@section('title', 'Buat Jawaban')
@section('content')
    <div class="card p-3">
        <form action="{{ route('bpi.update', $bpi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset>
                <input type="text" value="{{ $bpi->teacher_id }}" name="teacher_id" hidden>
                <div class="mb-3">
                    <label for="start" class="form-label">Tanggal BPI</label>
                    <input type="date" class="form-control bg-light" id="start" name="date"
                        value="{{ $bpi->date }}">
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
