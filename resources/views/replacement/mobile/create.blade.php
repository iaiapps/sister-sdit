@extends('layouts.appmobile')
@section('title', 'Data Pengganti')
@section('content')
    <div class="card p-3">
        <form action="{{ route('pengganti-mobile.store') }}" method="POST">
            @csrf
            <fieldset>
                <div class="mb-3 d-none">
                    <label for="id" class="form-label">Guru Pengganti</label>
                    <input type="input" class="form-control" id="id" name="teacher_id" value="{{ $tid }}"
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="menggantikan" class="form-label">Menggantikan guru</label>
                    <select class="form-select" name="menggantikan" id="menggantikan">
                        <option disabled>---- pilih nama guru ---</option>
                        @foreach ($teachers as $teacher)
                            <option>{{ $teacher->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Pada tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>
                <div class="mb-3">
                    <label for="jp" class="form-label">Pada jam</label>
                    <select name="jp" id="jp" class="form-select">
                        <option disabled selected>--- Pilih jam ---</option>
                        <option>II [08.00 - 08.30]</option>
                        <option>III [08.30 - 09.00]</option>
                        <option>IV [09.00 - 09.30]</option>
                        <option>V [09.30 - 10.00]</option>
                        <option>VI [10.15 - 10.45]</option>
                        <option>VII [10.45 - 11.15]</option>
                        <option>VIII [12.25 - 12.55]</option>
                        <option>IX [12.55 - 13.25]</option>
                        <option>X [13.40 - 14.10]</option>
                        <option>XI [14.10 - 14.40]</option>
                        <option>STS SESI 1</option>
                        <option>STS SESI 2</option>
                        <option>SAS/SAT SESI 1</option>
                        <option>SAS/SAT SESI 2</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mapel" class="form-label">Mapel yang digantikan</label>
                    <select name="mapel" id="mapel" class="form-select">
                        <option disabled selected>--- Pilih Mapel ---</option>
                        <option>PAI </option>
                        <option>B. Indonesia </option>
                        <option>PKN/Pancasila </option>
                        <option>Matematika </option>
                        <option>IPAS </option>
                        <option>Science </option>
                        <option>SDB </option>
                        <option>PJOK </option>
                        <option>B. Jawa </option>
                        <option>B. Inggris </option>
                        <option>B. Arab </option>
                        <option>Tahfidz </option>
                        <option>SKI </option>
                        <option>Akhlak</option>
                        <option>Tematik </option>
                        <option>Proyek P5 </option>
                        <option>Bina Kelas </option>
                        <option>Jaga PTS </option>
                        <option>Jaga PAS/PAT </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan guru tidak hadir </label>
                    <select name="alasan" id="alasan" class="form-select">
                        <option disabled selected>--- Pilih alasan ---</option>
                        <option>Sakit</option>
                        <option>Ijin</option>
                        <option>Tanpa Keterangan</option>
                        <option>Tugas Kedinasan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bahan" class="form-label">Tugas dari guru yang digantikan</label>
                    <select name="bahan" id="bahan" class="form-select">
                        <option disabled selected>--- Pilih tugas ---</option>
                        <option>Foto Copy</option>
                        <option>Arahan Saja</option>
                        <option>Tanpa Arahan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="diisi_dengan" class="form-label">Guru pengganti mengisi dengan</label>
                    <input type="text" name="diisi_dengan" id="diisi_dengan" class="form-control">
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success w-100 mt-3">Simpan Data</button>
        </form>
    </div>
    </div>
@endsection
