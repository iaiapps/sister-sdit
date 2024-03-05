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
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
@endsection
