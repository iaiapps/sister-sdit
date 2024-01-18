@extends('layouts.app')

@section('title', 'Edit Data Pelatihan')
@section('content')
    <div class="card p-3">
        <form action="/training/{{ $training->id }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="mb-3">
                    <label class="form-label" for="training_type">Jenis Pelatihan</label><input class="form-control"
                        type="text" id="training_type" name="training_type" placeholder="jenis pelatihan"
                        value="{{ old('training_type', $training->training_type) }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">Nama Pelatihan </label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="nama pelatihan"
                        value="{{ old('name', $training->name) }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="organizer">Penyelenggara</label>
                    <input class="form-control" type="text" id="organizer" name="organizer"
                        placeholder="fakultas/jurusan" value="{{ old('organizer', $training->organizer) }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="year">Tahun </label><input class="form-control" type="text"
                        id="year" name="year" placeholder="tahun" value="{{ old('year', $training->year) }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="training_role">Peran </label><input class="form-control" type="text"
                        id="training_role" name="training_role" placeholder="peran"
                        value="{{ old('training_role', $training->training_role) }}" />
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
