{{-- @extends('layouts.app')

@section('title', 'Buat Jawaban')
@section('content')
    <div class="card p-3">
        <form action="{{ route('guru.bpi.store') }}" method="POST">
            @csrf
            <fieldset>
                <div class="mb-3">
                    <input type="text" value="{{ $tid }}" name="teacher_id" hidden>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal BPI</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
@endsection --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('guru.bpi.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kehadiran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div>
                            <input type="text" value="{{ $tid }}" name="teacher_id" hidden>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal BPI</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <label for="presence_count" class="form-label">Jumlah Anak Hadir</label>
                            <input type="number" class="form-control" id="presence_count" name="presence_count" min="0" placeholder="Contoh: 25">
                        </div>
                        <div class="mb-3">
                            <label for="absence_info" class="form-label">Absensi (Tidak Hadir)</label>
                            <textarea class="form-control" id="absence_info" name="absence_info" rows="2" placeholder="Contoh: Adib (sakit), Budi (izin)"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="material" class="form-label">Materi yang Disampaikan</label>
                            <textarea class="form-control" id="material" name="material" rows="2" placeholder="Materi pembelajaran hari ini"></textarea>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
