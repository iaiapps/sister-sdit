@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Presensi mengajar BPI')
@section('content')
    <div class="card p-3">
        <div class="d-inline-block">
            <p class="m-0 fs-5">Presensi BPI Tahun : {{ $carbon::parse($now)->isoFormat('YYYY') }}</p>
        </div>
        <hr>
        <div class="d-inline-block">
            <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-circle"></i> Tambah Data Presensi Mengajar BPI
            </button>

        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Presensi Mengajar BPI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bpis->sortByDesc('date') as $bpi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $carbon::parse($bpi->date)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('bpi.teacher.create')
@endsection

@include('layouts.partials.allscripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: true,
                pageLength: 50
            });
        });
    </script>
@endpush
