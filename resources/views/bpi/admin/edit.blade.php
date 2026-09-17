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
                <div class="mb-3">
                    <label for="presence_count" class="form-label">Jumlah Anak Hadir</label>
                    <input type="number" class="form-control" id="presence_count" name="presence_count" min="0" value="{{ $bpi->presence_count }}">
                </div>
                <div class="mb-3">
                    <label for="absence_info" class="form-label">Absensi (Tidak Hadir)</label>
                    <textarea class="form-control" id="absence_info" name="absence_info" rows="3">{{ $bpi->absence_info }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="material" class="form-label">Materi yang Disampaikan</label>
                    <textarea class="form-control" id="material" name="material" rows="3">{{ $bpi->material }}</textarea>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
