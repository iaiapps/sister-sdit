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