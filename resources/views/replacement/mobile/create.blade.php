@extends('layouts.appmobile')
@section('title', 'Buat Data Guru Pengganti')
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
                    <label for="menggantikan" class="form-label">Menggantikan Guru</label>
                    <select class="form-select" name="menggantikan" id="menggantikan">
                        <option disabled>---- pilih nama guru ---</option>
                        @foreach ($teachers as $teacher)
                            <option>{{ $teacher->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal menggantikan</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>
                <div class="mb-3">
                    <label for="jp" class="form-label">Jumlah JP</label>
                    <input type="input" class="form-control" id="jp" name="jp"
                        placeholder="Total JP yang digantikan selama 1 hari">
                </div>
                <div class="mb-3">
                    <label for="mapel" class="form-label">Mapel yang digantikan</label>
                    <input type="input" class="form-control" id="mapel" name="mapel"
                        placeholder="Tuliskan semua mapel yang digantikan">
                </div>
                <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan guru tidak hadir </label>
                    <input type="input" class="form-control" id="alasan" name="alasan"
                        placeholder="Alasan guru yang digantikan tidak masuk">
                </div>
                <div class="mb-3">
                    <label for="bahan" class="form-label">Guru meninggalkan tugas?</label>
                    <input type="input" class="form-control" id="bahan" name="bahan"
                        placeholder="Bentuk tugas dari guru yang digantikan">
                </div>

            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
    </div>
@endsection

@include('layouts.partials.allscripts')

@push('scripts')
    <script>
        $('#menggantikan').select2({
            theme: 'bootstrap-5',
        });
    </script>
@endpush
