@extends('layouts.app')

@section('title', 'Tambah Data Riwayat Pendidikan')
@section('content')
    <div class="card p-3">
        <form action="{{ route('guru.training.store') }}" method="POST">
            @csrf
            <fieldset>
                <div class="mb-3">
                    <label class="form-label" for="training_type">Jenis Pelatihan</label><input class="form-control"
                        type="text" id="training_type" name="training_type" placeholder="jenis pelatihan" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">Nama Pelatihan </label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="nama pelatihan" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="organizer">Penyelenggara </label>
                    <input class="form-control" type="text" id="organizer" name="organizer"
                        placeholder="penyelenggara" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="year">Tahun </label><input class="form-control" type="text"
                        id="year" name="year" placeholder="tahun" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="training_role">Peran </label><input class="form-control" type="text"
                        id="training_role" name="training_role" placeholder="peran" />
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
