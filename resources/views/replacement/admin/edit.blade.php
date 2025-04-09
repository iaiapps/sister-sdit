@extends('layouts.app')

@section('title', 'Edit Pengganti')
@section('content')
    <div class="card p-3">
        <form action="{{ route('replacement.update', $replacement->id) }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Guru Pengganti</label>
                    <input type="text" class="form-control bg-light" id="teacher_id" name="teacher_id"
                        value="{{ $replacement->teacher_id }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="menggantikan" class="form-label">Menggantikan Guru</label>
                    <input type="text" class="form-control bg-light" id="menggantikan" name="menggantikan"
                        value="{{ $replacement->menggantikan }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal menggantikan</label>
                    <input type="text" class="form-control" id="tanggal" name="tanggal"
                        value="{{ $replacement->tanggal }}">
                </div>
                <div class="mb-3">
                    <label for="jp" class="form-label">Pada jam</label>
                    <select name="jp" id="jp" class="form-select">
                        <option selected>{{ $replacement->jp }}</option>
                        <hr>
                        <option disabled>--- Pilih jam ---</option>
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
                        <option selected>{{ $replacement->mapel }}</option>
                        <hr>
                        <option disabled>--- Pilih Mapel ---</option>
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
                        <option selected>{{ $replacement->alasan }}</option>
                        <hr>
                        <option disabled>--- Pilih alasan ---</option>
                        <option>Sakit</option>
                        <option>Ijin</option>
                        <option>Tanpa Keterangan</option>
                        <option>Tugas Kedinasan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bahan" class="form-label">Tugas dari guru yang digantikan</label>
                    <select name="bahan" id="bahan" class="form-select">
                        <option selected>{{ $replacement->bahan }}</option>
                        <hr>
                        <option disabled>--- Pilih tugas ---</option>
                        <option>Foto Copy</option>
                        <option>Arahan Saja</option>
                        <option>Tanpa Arahan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="diisi_dengan" class="form-label">Guru pengganti mengisi dengan</label>
                    <input type="text" name="diisi_dengan" id="diisi_dengan" class="form-control"
                        value="{{ $replacement->diisi_dengan }}">
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
