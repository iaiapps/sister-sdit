@extends('layouts.app')

@section('title', 'Formulir Data Guru')
@section('content')
    <div class="bg-white p-3 rounded">
        <div class="progress mb-3">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>

        <form action="{{ route('teacher.update', $teacher->id) }}" method="POST">
            @csrf
            @method('put')

            {{-- -----halaman satu----- --}}
            <fieldset class="step">
                <div class="d-flex justify-content-between mb-3">
                    <h2 class="">Identitas Guru/Karyawan</h2>
                    <p class="fs-4">1/2</p>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="full_name">Nama Lengkap</label>
                    <input
                        class="form-control @error('full_name')
                        is-invalid
                    @enderror"
                        id="full_name" name="full_name" type="text" placeholder="nama lengkap"
                        value="{{ old('full_name', $teacher->full_name) }}" />
                    @error('full_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="gender">Jenis Kelamin</label>
                    <select class="form-select" id="gender" name="gender">
                        <option>---</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>

                    </select>
                </div>

                <div class="row g-3">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label" for="place_of_birth">Tempat Lahir</label>
                            <input
                                class="form-control @error('place_of_birth') is-invalid
                            @enderror"
                                id="place_of_birth" name="place_of_birth" type="text" placeholder="tempat lahir"
                                value="{{ old('place_of_birth', $teacher->place_of_birth) }}" />
                            @error('place_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label " for="date_birth">Tanggal Lahir</label>
                            <input
                                class="form-control @error('date_of_birth')
                            is-invalid
                            @enderror"
                                name="date_of_birth" type="date" id="date_birth" placeholder="Bulan/Hari/Tahun"
                                value="{{ old('date_of_birth', $teacher->date_of_birth) }}" />
                            @error('date_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="last_education">Pendidikan Terakhir</label>
                    <input
                        class="form-control @error('last_education')
                    is-invalid
                    @enderror"
                        type="text" id="last_education" placeholder="pendidikan terakhir" name="last_education"
                        value="{{ old('last_education', $teacher->last_education) }}" />
                    @error('last_education')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="bulantahunmasuk" class="form-label">Tahun Masuk SDIT Harapan Umat Jember (diisi bulan dan
                        tahun)</label>
                    <div class="row g-3">
                        <div class="col-6">
                            <select class="form-select" id="gender" name="month_enter">
                                <option>---</option>
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="Nopember">Nopember</option>
                                <option value="Desember">Desember</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <input type="text"
                                class="form-control @error('year_enter')
                            is-invalid
                            @enderror"
                                id="bulantahunmasuk" name="year_enter" placeholder="tahun masuk" required />
                            @error('year_enter')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="handphone"
                        class="form-label @error('no_hp')
                    is-invalid
                    @enderror">No.Telephon
                        (WA aktif)</label>
                    <input type="text" class="form-control" id="handphone" name="no_hp" placeholder="0821xxxxxx"
                        value="{{ old('no_hp', $teacher->no_hp) }}" />
                    @error('no_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="e-mail"
                        value="{{ $teacher->email }}" readonly="readonly" disabled />
                </div>
            </fieldset>

            {{-- -----halaman dua----- --}}
            <fieldset class="step">
                <div class="d-flex justify-content-between mb-3">
                    <h2 class="">Data Pribadi Guru/Karyawan</h2>
                    <p class="fs-4">2/2</p>
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label ">NIK (Nomor Induk Kependudukan)</label>
                    <input type="number"
                        class="form-control @error('nik')
                    is-invalid
                    @enderror"
                        id="nik" name="nik" placeholder="NIK" value="{{ old('nik', $teacher->nik) }}" />
                    @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="npwp">NPWP (jika memiliki)</label>
                    <input class="form-control" type="number" id="npwp" name="npwp" placeholder="NPWP"
                        value="{{ old('npwp', $teacher->npwp) }}" />

                </div>
                <div class="mb-3">
                    <label class="form-label " for="alamatjalan">Alamat Jalan</label>
                    <input
                        class="form-control @error('address')
                    is-invalid
                    @enderror"
                        type="text" id="alamatjalan" name="address" placeholder="alamat"
                        value="{{ old('address', $teacher->address) }}" />
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label " for="rt">RT </label>
                        <input
                            class="form-control @error('rt')
                        is-invalid
                        @enderror"
                            type="number" id="rt" name="rt" placeholder="RT"
                            value="{{ old('rt', $teacher->rt) }}" />
                        @error('rt')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label " for="rw">RW</label>
                        <input
                            class="form-control @error('rw')
                        is-invalid
                        @enderror"
                            type="number" id="rw" name="rw" placeholder="RW"
                            value="{{ old('rw', $teacher->rw) }}" />
                        @error('rw')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label " for="desa/kelurahan">Desa/Kelurahan</label>
                        <input
                            class="form-control @error('village')
                        is-invalid
                        @enderror"
                            type="text" id="desa/kelurahan" name="village" placeholder="village"
                            value="{{ old('village', $teacher->village) }}" />
                        @error('village')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="kecamatan">Kecamatan</label>
                        <input
                            class="form-control  @error('subdistrict')
                        is-invalid
                        @enderror"
                            type="text" id="kecamatan" name="subdistrict" placeholder="subdistrict"
                            value="{{ old('subdistrict', $teacher->subdistrict) }}" />
                        @error('subdistrict')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="kabupaten/kota">Kabupaten / Kota</label>
                        <input
                            class="form-control @error('city')
                        is-invalid
                        @enderror"
                            type="text" id="kabupaten/kota" name="city" placeholder="city"
                            value="{{ old('city', $teacher->city) }}" />
                        @error('city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label " for="province">Provinsi</label>
                        <input
                            class="form-control @error('province')
                        is-invalid
                        @enderror"
                            type="text" id="province" name="province" placeholder="province"
                            value="{{ old('province', $teacher->province) }}" />
                        @error('province')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kodepos">Kode POS</label>
                    <input
                        class="form-control @error('postal_code')
                    is-invalid
                    @enderror"
                        type="number" id="kodepos" name="postal_code" placeholder="kode pos"
                        value="{{ old('postal_code', $teacher->postal_code) }}" />
                    @error('postal_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <hr />
                <div class="mb-3">
                    <label class="form-label" for="statusperkawinan">Status Pernikahan
                    </label>
                    <select class="form-select" name="marriage_status" id="statusperkawinan">
                        <option>---</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Janda atau Duda"> Janda atau Duda</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label " for="namasuami/istri">Nama Suami/Istri</label>
                    <input
                        class="form-control @error('partner_name')
                    is-invalid
                    @enderror"
                        type="text" id="namasuami/istri" name="partner_name" placeholder="nama suami/istri"
                        value="{{ old('partner_name', $teacher->partner_name) }}" />
                    @error('partner_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label " for="pekerjaansuami/istri">Pekerjaan Suami/Istri
                    </label>
                    <input
                        class="form-control @error('partner_job')
                    is-invalid
                    @enderror"
                        type="text" id="pekerjaansuami/istri" name="partner_job" placeholder="pekerjaan suami/istri"
                        value="{{ old('partner_job', $teacher->partner_job) }}" />
                    @error('partner_job')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label " for="jumlah_anak">Jumlah Anak
                    </label>
                    <input
                        class="form-control @error('children_number')
                    is-invalid
                    @enderror"
                        type="number" id="jumlah_anak" name="children_number" placeholder="xx"
                        value="{{ old('children_number', $teacher->children_number) }}" />
                    @error('children_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
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
