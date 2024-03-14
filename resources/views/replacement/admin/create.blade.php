@extends('layouts.app')

@section('title', 'Buat Data Menggantikan')
@section('content')
    <div class="card p-3">
        <form action="{{ route('replacement.store') }}" method="POST">
            @csrf
            <fieldset>
                <div class="mb-3">
                    <label for="id" class="form-label">Guru Pengganti</label>
                    <select class="form-select" name="teacher_id" id="id">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="menggantikan" class="form-label">Menggantikan Guru</label>
                    <select class="form-select" name="menggantikan" id="menggantikan">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal menggantikan</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>
                <div class="mb-3">
                    <label for="jp" class="form-label">Jumlah JP</label>
                    <input type="input" class="form-control" id="jp" name="jp"
                        placeholder="Tuliskan total JP yang digantikan selama 1 hari">
                </div>
                <div class="mb-3">
                    <label for="mapel" class="form-label">Mapel yang digantikan</label>
                    <input type="input" class="form-control" id="mapel" name="mapel"
                        placeholder="Tuliskan semua mapel yang digantikan, pisahan dengan koma ( ',' )">
                </div>
                <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan guru tidak hadir </label>
                    <input type="input" class="form-control" id="alasan" name="alasan"
                        placeholder="Tuliskan alasan guru yang digantikan tidak masuk">
                </div>
                <div class="mb-3">
                    <label for="bahan" class="form-label">Guru meninggalkan tugas?</label>
                    <input type="input" class="form-control" id="bahan" name="bahan"
                        placeholder="Tuliskan semua bentuk tugas dari guru yang digantikan">
                </div>

            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
@endsection
