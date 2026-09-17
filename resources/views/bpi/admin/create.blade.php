@extends('layouts.app')

@section('title', 'Buat Jawaban')
@section('content')
    <div class="card p-3">
        <form action="{{ route('admin.bpi.store') }}" method="POST">
            @csrf
            <fieldset>
                <div class="mb-3">
                    <label for="id" class="form-label">Nama Guru</label>
                    <select class="form-select" name="teacher_id" id="id">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal BPI</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="mb-3">
                    <label for="presence_count" class="form-label">Jumlah Anak Hadir</label>
                    <input type="number" class="form-control" id="presence_count" name="presence_count" min="0" placeholder="Contoh: 25">
                </div>
                <div class="mb-3">
                    <label for="absence_info" class="form-label">Absensi (Tidak Hadir)</label>
                    <textarea class="form-control" id="absence_info" name="absence_info" rows="3" placeholder="Contoh: Adib (sakit), Budi (izin)"></textarea>
                </div>
                <div class="mb-3">
                    <label for="material" class="form-label">Materi yang Disampaikan</label>
                    <textarea class="form-control" id="material" name="material" rows="3" placeholder="Materi pembelajaran hari ini"></textarea>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
@endsection
