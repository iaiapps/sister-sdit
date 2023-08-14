@extends('layouts.app')

@section('title', 'Tambah Data Orang Tua')
@section('content')
    <div class="card p-3">
        <div class="progress mb-3">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>

        <form action="{{ route('student-parent.store') }}" method="POST">
            @csrf

            <fieldset class="step">
                <p class="fw-bold fs-5">Formulir Ayah</p>

                <div class="mb-3">
                    <label class="form-label" for="nama_ayah">Nama Ayah</label>
                    <input class="form-control" type="text" id="nama_ayah" name="nama_ayah" placeholder="nama ayah" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nik_ayah">NIK Ayah</label>
                    <input class="form-control" type="text" id="nik_ayah" name="nik_ayah" placeholder="nik ayah" />
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                            <input class="form-control" type="text" id="tempat_lahir_ayah" name="tempat_lahir_ayah"
                                placeholder="tempat lahir ayah" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                            <input class="form-control" type="text" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah"
                                placeholder="tanggal lahir ayah" />
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="pendidikan_ayah">Pendidikan Ayah</label>
                    <input class="form-control" type="text" id="pendidikan_ayah" name="pendidikan_ayah"
                        placeholder="pendidikan ayah" />
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="pekerjaan_ayah">Pekerjaan Ayah</label>
                            <input class="form-control" type="text" id="pekerjaan_ayah" name="pekerjaan_ayah"
                                placeholder="pekerjaan ayah" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="penghasilan_ayah">Penghasilan Ayah</label>
                            <input class="form-control" type="text" id="penghasilan_ayah" name="penghasilan_ayah"
                                placeholder="penghasilan ayah" />
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="hp_ayah">No. HP Ayah</label>
                    <input class="form-control" type="text" id="hp_ayah" name="hp_ayah" placeholder="no. hp ayah" />
                </div>
            </fieldset>


            <fieldset class="step">
                <p class="fw-bold fs-5">Formulir Ibu</p>

                <div class="mb-3">
                    <label class="form-label" for="nama_ibu">Nama Ibu</label>
                    <input class="form-control" type="text" id="nama_ibu" name="nama_ibu" placeholder="nama ibu" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nik_ibu">NIK Ibu</label>
                    <input class="form-control" type="text" id="nik_ibu" name="nik_ibu" placeholder="nik ibu">
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                            <input class="form-control" type="text" id="tempat_lahir_ibu" name="tempat_lahir_ibu"
                                placeholder="tempat lahir ibu" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                            <input class="form-control" type="text" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu"
                                placeholder="tanggal lahir ibu" />
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <label class="form-label" for="pendidikan_ibu">Pendidikan Ibu</label>
                    <input class="form-control" type="text" id="pendidikan_ibu" name="pendidikan_ibu"
                        placeholder="pendidikan ibu" />
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="pekerjaan_ibu">Pekerjaan Ibu</label>
                            <input class="form-control" type="text" id="pekerjaan_ibu" name="pekerjaan_ibu"
                                placeholder="pekerjaan ibu" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="penghasilan_ibu">Penghasilan Ibu</label>
                            <input class="form-control" type="text" id="penghasilan_ibu" name="penghasilan_ibu"
                                placeholder="penghasilan ibu" />
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="hp_ibu">No. HP Ibu</label>
                    <input class="form-control" type="text" id="hp_ibu" name="hp_ibu"
                        placeholder="no. hp ibu" />
                </div>
            </fieldset>

            <button class="action back btn btn-outline-success float-start w-25">
                Sebelumnya
            </button>
            <button class="action next btn btn-success float-end w-25">
                Selanjutnya
            </button>
            <button type="submit" class="action submit btn btn-success float-end w-25">
                Simpan Data
            </button>
        </form>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/form.js') }}"></script>
@endpush
