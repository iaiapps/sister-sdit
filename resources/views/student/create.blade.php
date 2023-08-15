@extends('layouts.app')

@section('title', 'Formulir Data Siswa')
@section('content')
    <div class="bg-white p-3 rounded">

        <form action="{{ route('student.store') }}" method="POST">
            @csrf

            {{-- -----halaman satu----- --}}
            <fieldset class="step">
                <div class="d-flex justify-content-between mb-3">
                    <h2 class="">Identitas Siswa</h2>
                    <p class="fs-4">1/2</p>
                </div>

                {{-- @dd($data->id) --}}
                <input type="text" value="{{ $data->id }}" name="user_id" hidden>
                <div class="mb-3">
                    <label class="form-label" for="nis">NIS</label>
                    <input class="form-control" id="nis" name="nis" type="text" placeholder="nis"
                        value="{{ $data->nis }}" readonly />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="full_name">Nama Lengkap</label>
                    <input
                        class="form-control @error('full_name')
                        is-invalid
                    @enderror"
                        id="full_name" name="full_name" type="text" placeholder="nama lengkap"
                        value="{{ old('full_name', $data->name) }}" />
                    @error('full_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="row g-3">
                    <div class="col-md-4 col-12">
                        <div class="mb-3">
                            <label for="nik" class="form-label ">NIK (Nomor Induk Kependudukan)</label>
                            <input type="number"
                                class="form-control @error('nik')
                            is-invalid
                            @enderror"
                                id="nik" name="nik" placeholder="nik" />
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-3">
                            <label for="kk" class="form-label ">No. KK</label>
                            <input type="number"
                                class="form-control @error('kk')
                            is-invalid
                            @enderror"
                                id="kk" name="kk" placeholder="no. kk" />
                            @error('kk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="mb-3">
                            <label for="akte" class="form-label ">No. Akte Kelahiran</label>
                            <input type="number"
                                class="form-control @error('akte')
                            is-invalid
                            @enderror"
                                id="akte" name="akte" placeholder="no. akte kelahiran" />
                            @error('akte')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
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
                                value="{{ old('place_of_birth') }}" />
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
                                name="date_of_birth" type="date" id="date_birth" placeholder="Bulan/Hari/Tahun" />
                            @error('date_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label " for="alamatjalan">Alamat Jalan</label>
                    <input
                        class="form-control @error('address')
                    is-invalid
                    @enderror"
                        type="text" id="alamatjalan" name="address" placeholder="alamat" />
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
                            type="number" id="rt" name="rt" placeholder="RT" />
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
                            type="number" id="rw" name="rw" placeholder="RW" />
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
                            type="text" id="desa/kelurahan" name="village" placeholder="village" />
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
                            type="text" id="kecamatan" name="subdistrict" placeholder="subdistrict" />
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
                            type="text" id="kabupaten/kota" name="city" placeholder="city" />
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
                            type="text" id="province" name="province" placeholder="province" />
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
                        type="number" id="kodepos" name="postal_code" placeholder="kode pos" />
                    @error('postal_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="sekolah_asal">Sekolah Asal</label>
                    <input
                        class="form-control @error('sekolah_asal')
                    is-invalid
                    @enderror"
                        type="text" id="sekolah_asal" name="sekolah_asal" placeholder="sekolah asal" />
                    @error('sekolah_asal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="jenis_tinggal">Tinggal Bersama</label>
                    <input
                        class="form-control @error('jenis_tinggal')
                    is-invalid
                    @enderror"
                        type="text" id="jenis_tinggal" name="jenis_tinggal" placeholder="tinggal bersama" />
                    @error('jenis_tinggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="alat_transportasi">Alat Transportasi</label>
                    <input
                        class="form-control @error('alat_transportasi')
                    is-invalid
                    @enderror"
                        type="text" id="alat_transportasi" name="alat_transportasi"
                        placeholder="alat transportasi" />
                    @error('alat_transportasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="anak_ke">Anak Ke</label>
                    <input
                        class="form-control @error('anak_ke')
                    is-invalid
                    @enderror"
                        type="number" id="anak_ke" name="anak_ke" placeholder="xx" />
                    @error('anak_ke')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="jumlah_saudara">Jumlah Sudara</label>
                    <input
                        class="form-control @error('jumlah_saudara')
                    is-invalid
                    @enderror"
                        type="number" id="jumlah_saudara" name="jumlah_saudara" placeholder="jumlah saudara" />
                    @error('jumlah_saudara')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="jarak_ke_sekolah">Jarak Rumah ke Sekolah</label>
                    <input
                        class="form-control @error('jarak_ke_sekolah')
                    is-invalid
                    @enderror"
                        type="text" id="jarak_ke_sekolah" name="jarak_ke_sekolah"
                        placeholder="jarak rumah ke sekolah" />
                    @error('jarak_ke_sekolah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>



                <button type="submit" class="action submit btn btn-success float-end w-25">
                    Simpan Data
                </button>
        </form>
    </div>

@endsection
