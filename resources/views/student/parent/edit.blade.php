@extends('layouts.app')

@section('title', 'Edit Data Anak')
@section('content')
    <div class="card p-3">

        <form action="{{ route('student-parent.update', $parent->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="row">
                <div class="col">
                    <fieldset>
                        <p class="fw-bold fs-5">Formulir Ayah</p>
                        <div class="mb-3">
                            <label class="form-label" for="nama_ayah">Nama Ayah</label>
                            <input class="form-control" type="text" id="nama_ayah" name="nama_ayah"
                                placeholder="nama ayah" value="{{ old('nama_ayah', $parent->nama_ayah) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nik_ayah">NIK Ayah</label>
                            <input class="form-control" type="text" id="nik_ayah" name="nik_ayah" placeholder="nik ayah"
                                value="{{ old('nik_ayah', $parent->nik_ayah) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                            <input class="form-control" type="text" id="tempat_lahir_ayah" name="tempat_lahir_ayah"
                                placeholder="tempat lahir ayah"
                                value="{{ old('tempat_lahir_ayah', $parent->tempat_lahir_ayah) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                            <input class="form-control" type="text" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah"
                                placeholder="tanggal lahir ayah"
                                value="{{ old('tanggal_lahir_ayah', $parent->tanggal_lahir_ayah) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pendidikan_ayah">Pendidikan Ayah</label>
                            <input class="form-control" type="text" id="pendidikan_ayah" name="pendidikan_ayah"
                                placeholder="pendidikan ayah"
                                value="{{ old('pendidikan_ayah', $parent->pendidikan_ayah) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pekerjaan_ayah">Pekerjaan Ayah</label>
                            <input class="form-control" type="text" id="pekerjaan_ayah" name="pekerjaan_ayah"
                                placeholder="pekerjaan ayah" value="{{ old('pekerjaan_ayah', $parent->pekerjaan_ayah) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="penghasilan_ayah">Penghasilan Ayah</label>
                            <input class="form-control" type="text" id="penghasilan_ayah" name="penghasilan_ayah"
                                placeholder="penghasilan ayah"
                                value="{{ old('penghasilan_ayah', $parent->penghasilan_ayah) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="hp_ayah">No. HP Ayah</label>
                            <input class="form-control" type="text" id="hp_ayah" name="hp_ayah"
                                placeholder="no. hp ayah" value="{{ old('hp_ayah', $parent->hp_ayah) }}" />
                        </div>
                    </fieldset>

                </div>
                <div class="col">
                    <fieldset>
                        <p class="fw-bold fs-5">Formulir Ibu</p>

                        <div class="mb-3">
                            <label class="form-label" for="nama_ibu">Nama Ibu</label>
                            <input class="form-control" type="text" id="nama_ibu" name="nama_ibu" placeholder="nama ibu"
                                value="{{ old('nama_ibu', $parent->nama_ibu) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nik_ibu">NIK Ibu</label>
                            <input class="form-control" type="text" id="nik_ibu" name="nik_ibu" placeholder="nik ibu"
                                value="{{ old('nik_ibu', $parent->nik_ibu) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                            <input class="form-control" type="text" id="tempat_lahir_ibu" name="tempat_lahir_ibu"
                                placeholder="tempat lahir ibu"
                                value="{{ old('tempat_lahir_ibu', $parent->tempat_lahir_ibu) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                            <input class="form-control" type="text" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu"
                                placeholder="tanggal lahir ibu"
                                value="{{ old('tanggal_lahir_ibu', $parent->tanggal_lahir_ibu) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pendidikan_ibu">Pendidikan Ibu</label>
                            <input class="form-control" type="text" id="pendidikan_ibu" name="pendidikan_ibu"
                                placeholder="pendidikan ibu"
                                value="{{ old('pendidikan_ibu', $parent->pendidikan_ibu) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pekerjaan_ibu">Pekerjaan Ibu</label>
                            <input class="form-control" type="text" id="pekerjaan_ibu" name="pekerjaan_ibu"
                                placeholder="pekerjaan ibu" value="{{ old('pekerjaan_ibu', $parent->pekerjaan_ibu) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="penghasilan_ibu">Penghasilan Ibu</label>
                            <input class="form-control" type="text" id="penghasilan_ibu" name="penghasilan_ibu"
                                placeholder="penghasilan ibu"
                                value="{{ old('penghasilan_ibu', $parent->penghasilan_ibu) }}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="hp_ibu">No. HP Ibu</label>
                            <input class="form-control" type="text" id="hp_ibu" name="hp_ibu"
                                placeholder="no. hp ibu" value="{{ old('hp_ibu', $parent->hp_ibu) }}" />
                        </div>
                    </fieldset>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
@endsection
