@extends('layouts.app')

@section('title', 'Tambah Data Riwayat Pendidikan')
@section('content')
    <div class="card p-3">
        <form action="/education" method="POST">
            @csrf
            <fieldset>
                <div class="mb-3">
                    <label class="form-label" for="education_level">Jenjang Pendidikan</label><input class="form-control"
                        type="text" id="education_level" name="education_level" placeholder="Jenjang Pendidikan" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="school_name">Nama Sekolah / Lembaga / Satuan Pendidikan </label>
                    <input class="form-control" type="text" id="school_name" name="school_name"
                        placeholder="nama sekolah/lembaga/satuan pendidikan" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="department">Fakultas/Jurusan </label>
                    <input class="form-control" type="text" id="department" name="department"
                        placeholder="fakultas/jurusan" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="enter_year">Tahun Masuk </label><input class="form-control"
                        type="text" id="enter_year" name="enter_year" placeholder="tahun masuk" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="graduation_year">Tahun Lulus </label><input class="form-control"
                        type="text" id="graduation_year" name="graduation_year" placeholder="tahun lulus" />
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
