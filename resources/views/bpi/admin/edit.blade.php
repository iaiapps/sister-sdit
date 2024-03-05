@extends('layouts.app')

@section('title', 'Buat Jawaban')
@section('content')
    <div class="card p-3">
        <form action="{{ route('mutabaah.update', $mutabaah->id) }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="mb-3">
                    <label for="start" class="form-label">Nama Mutabaah</label>
                    <input type="text" class="form-control bg-light" id="start" name="name"
                        value="{{ $mutabaah->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="start" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="start" name="start">
                </div>
                <div class="mb-3">
                    <label for="end" class="form-label">Tanggal Berakhir</label>
                    <input type="date" class="form-control" id="end" name="end">
                </div>

            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
