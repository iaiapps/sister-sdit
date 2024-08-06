@extends('layouts.appmobile')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Presensi mengajar BPI')
@section('content')
    @if (session('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <p class="m-0">{{ session('msg') }} </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card p-3">
        <div class="d-inline-block">
            <p class="m-0">Presensi BPI Bulan : {{ $carbon::parse($now)->isoFormat('MMMM YYYY') }}</p>
        </div>
        <hr>
        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data Presensi Mengajar BPI
        </button>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Presensi mengajar BPI</th>
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
@endsection
@include('bpi.mobile.create')

{{-- @include('layouts.partials.allscripts') --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: true,
                // pageLength: 50,
                lengthChange: false,
                searching: false
            });
        });
    </script>
@endpush
