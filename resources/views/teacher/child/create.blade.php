@extends('layouts.app')

@section('title', 'Tambah Data Anak')
@section('content')
    <div class="card p-3">
        <form action="/child" method="POST">
            @csrf
            <fieldset>
                <div class="mb-3">
                    <label class="form-label" for="name">Nama Anak</label><input class="form-control" type="text"
                        id="name" name="name" placeholder="Nama Anak" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="education_level">Jenjang Pendidikan </label>
                    <input class="form-control" type="text" id="education_level" name="education_level"
                        placeholder="jenjang pendidikan" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="gender">Jenis Kelamin</label>
                    <select class="form-select" id="gender" name="gender">
                        <option>---</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>

                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="place_of_birth">Tempat Lahir </label>
                    <input class="form-control" type="text" id="place_of_birth" name="place_of_birth"
                        placeholder="tempat lahir" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="date_of_birth">Tanggal Lahir </label>
                    <input class="form-control" type="date" id="date_of_birth" name="date_of_birth"
                        placeholder="tanggal lahir" />
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
