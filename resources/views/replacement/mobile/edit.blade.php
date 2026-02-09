@extends('layouts.appmobile')
@section('title', 'Edit Data Pengganti')
@section('content')
    <div class="card p-3">
        <div class="mb-3">
            <h5 class="mb-0">Edit Data Pengganti</h5>
            <small class="text-muted">Ubah data menggantikan guru</small>
        </div>

        <form action="{{ route('pengganti-mobile.update', $pengganti_mobile->id) }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="mb-3 d-none">
                    <label for="id" class="form-label">Guru Pengganti</label>
                    <input type="input" class="form-control" id="id" name="teacher_id" value="{{ $tid }}"
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="menggantikan" class="form-label">Menggantikan guru</label>
                    <select class="form-select" name="menggantikan" id="menggantikan">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->full_name }}"
                                {{ $pengganti_mobile->menggantikan == $teacher->full_name ? 'selected' : '' }}>
                                {{ $teacher->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Pada tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                        value="{{ $pengganti_mobile->tanggal }}">
                </div>
                <div class="mb-3">
                    <label for="jp" class="form-label">Pada jam</label>
                    <select name="jp" id="jp" class="form-select">
                        <option value="II [08.00 - 08.30]"
                            {{ $pengganti_mobile->jp == 'II [08.00 - 08.30]' ? 'selected' : '' }}>II [08.00 - 08.30]
                        </option>
                        <option value="III [08.30 - 09.00]"
                            {{ $pengganti_mobile->jp == 'III [08.30 - 09.00]' ? 'selected' : '' }}>III [08.30 - 09.00]
                        </option>
                        <option value="IV [09.00 - 09.30]"
                            {{ $pengganti_mobile->jp == 'IV [09.00 - 09.30]' ? 'selected' : '' }}>IV [09.00 - 09.30]
                        </option>
                        <option value="V [09.30 - 10.00]"
                            {{ $pengganti_mobile->jp == 'V [09.30 - 10.00]' ? 'selected' : '' }}>V [09.30 - 10.00]</option>
                        <option value="VI [10.15 - 10.45]"
                            {{ $pengganti_mobile->jp == 'VI [10.15 - 10.45]' ? 'selected' : '' }}>VI [10.15 - 10.45]
                        </option>
                        <option value="VII [10.45 - 11.15]"
                            {{ $pengganti_mobile->jp == 'VII [10.45 - 11.15]' ? 'selected' : '' }}>VII [10.45 - 11.15]
                        </option>
                        <option value="VIII [12.25 - 12.55]"
                            {{ $pengganti_mobile->jp == 'VIII [12.25 - 12.55]' ? 'selected' : '' }}>VIII [12.25 - 12.55]
                        </option>
                        <option value="IX [12.55 - 13.25]"
                            {{ $pengganti_mobile->jp == 'IX [12.55 - 13.25]' ? 'selected' : '' }}>IX [12.55 - 13.25]
                        </option>
                        <option value="X [13.40 - 14.10]"
                            {{ $pengganti_mobile->jp == 'X [13.40 - 14.10]' ? 'selected' : '' }}>X [13.40 - 14.10]</option>
                        <option value="XI [14.10 - 14.40]"
                            {{ $pengganti_mobile->jp == 'XI [14.10 - 14.40]' ? 'selected' : '' }}>XI [14.10 - 14.40]
                        </option>
                        <option value="STS SESI 1" {{ $pengganti_mobile->jp == 'STS SESI 1' ? 'selected' : '' }}>STS SESI 1
                        </option>
                        <option value="STS SESI 2" {{ $pengganti_mobile->jp == 'STS SESI 2' ? 'selected' : '' }}>STS SESI 2
                        </option>
                        <option value="SAS/SAT SESI 1" {{ $pengganti_mobile->jp == 'SAS/SAT SESI 1' ? 'selected' : '' }}>
                            SAS/SAT SESI 1</option>
                        <option value="SAS/SAT SESI 2" {{ $pengganti_mobile->jp == 'SAS/SAT SESI 2' ? 'selected' : '' }}>
                            SAS/SAT SESI 2</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mapel" class="form-label">Mapel yang digantikan</label>
                    <select name="mapel" id="mapel" class="form-select">
                        <option value="PAI" {{ $pengganti_mobile->mapel == 'PAI' ? 'selected' : '' }}>PAI</option>
                        <option value="B. Indonesia" {{ $pengganti_mobile->mapel == 'B. Indonesia' ? 'selected' : '' }}>B.
                            Indonesia</option>
                        <option value="PKN/Pancasila" {{ $pengganti_mobile->mapel == 'PKN/Pancasila' ? 'selected' : '' }}>
                            PKN/Pancasila</option>
                        <option value="Matematika" {{ $pengganti_mobile->mapel == 'Matematika' ? 'selected' : '' }}>
                            Matematika</option>
                        <option value="IPAS" {{ $pengganti_mobile->mapel == 'IPAS' ? 'selected' : '' }}>IPAS</option>
                        <option value="Science" {{ $pengganti_mobile->mapel == 'Science' ? 'selected' : '' }}>Science
                        </option>
                        <option value="SDB" {{ $pengganti_mobile->mapel == 'SDB' ? 'selected' : '' }}>SDB</option>
                        <option value="PJOK" {{ $pengganti_mobile->mapel == 'PJOK' ? 'selected' : '' }}>PJOK</option>
                        <option value="B. Jawa" {{ $pengganti_mobile->mapel == 'B. Jawa' ? 'selected' : '' }}>B. Jawa
                        </option>
                        <option value="B. Inggris" {{ $pengganti_mobile->mapel == 'B. Inggris' ? 'selected' : '' }}>B.
                            Inggris</option>
                        <option value="B. Arab" {{ $pengganti_mobile->mapel == 'B. Arab' ? 'selected' : '' }}>B. Arab
                        </option>
                        <option value="Tahfidz" {{ $pengganti_mobile->mapel == 'Tahfidz' ? 'selected' : '' }}>Tahfidz
                        </option>
                        <option value="SKI" {{ $pengganti_mobile->mapel == 'SKI' ? 'selected' : '' }}>SKI</option>
                        <option value="Akhlak" {{ $pengganti_mobile->mapel == 'Akhlak' ? 'selected' : '' }}>Akhlak</option>
                        <option value="Tematik" {{ $pengganti_mobile->mapel == 'Tematik' ? 'selected' : '' }}>Tematik
                        </option>
                        <option value="Proyek P5" {{ $pengganti_mobile->mapel == 'Proyek P5' ? 'selected' : '' }}>Proyek P5
                        </option>
                        <option value="Bina Kelas" {{ $pengganti_mobile->mapel == 'Bina Kelas' ? 'selected' : '' }}>Bina
                            Kelas</option>
                        <option value="Jaga PTS" {{ $pengganti_mobile->mapel == 'Jaga PTS' ? 'selected' : '' }}>Jaga PTS
                        </option>
                        <option value="Jaga PAS/PAT" {{ $pengganti_mobile->mapel == 'Jaga PAS/PAT' ? 'selected' : '' }}>
                            Jaga PAS/PAT</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan guru tidak hadir</label>
                    <select name="alasan" id="alasan" class="form-select">
                        <option value="Sakit" {{ $pengganti_mobile->alasan == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="Ijin" {{ $pengganti_mobile->alasan == 'Ijin' ? 'selected' : '' }}>Ijin</option>
                        <option value="Tanpa Keterangan"
                            {{ $pengganti_mobile->alasan == 'Tanpa Keterangan' ? 'selected' : '' }}>Tanpa Keterangan
                        </option>
                        <option value="Tugas Kedinasan"
                            {{ $pengganti_mobile->alasan == 'Tugas Kedinasan' ? 'selected' : '' }}>Tugas Kedinasan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bahan" class="form-label">Tugas dari guru yang digantikan</label>
                    <select name="bahan" id="bahan" class="form-select">
                        <option value="Foto Copy" {{ $pengganti_mobile->bahan == 'Foto Copy' ? 'selected' : '' }}>Foto Copy
                        </option>
                        <option value="Arahan Saja" {{ $pengganti_mobile->bahan == 'Arahan Saja' ? 'selected' : '' }}>
                            Arahan Saja</option>
                        <option value="Tanpa Arahan" {{ $pengganti_mobile->bahan == 'Tanpa Arahan' ? 'selected' : '' }}>
                            Tanpa Arahan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="diisi_dengan" class="form-label">Guru pengganti mengisi dengan</label>
                    <input type="text" name="diisi_dengan" id="diisi_dengan" class="form-control"
                        value="{{ $pengganti_mobile->diisi_dengan }}">
                </div>
            </fieldset>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Update Data</button>
                <a href="{{ route('pengganti-mobile.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
