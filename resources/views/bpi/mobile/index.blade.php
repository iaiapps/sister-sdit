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
            <p class="m-0">Presensi BPI Bulan : {{ $carbon::parse($date)->isoFormat('MMMM YYYY') }}</p>
        </div>
        <hr>
        <div class="col-12 col-md-6 ">
            <form action="{{ route('bpi-mobile.index') }}" method="GET" class="mb-0">
                {{-- @csrf --}}
                <div class="input-group">
                    <input type="month" id="start" name="date" class="form-control"
                        value="{{ request('date') ? request('date') : $date }}">
                    <button type="submit" class="input-group-text btn btn-success">Filter</button>
                </div>
            </form>
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
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bpis->sortByDesc('date') as $bpi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $carbon::parse($bpi->date)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                            <td>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('bpi-mobile.destroy', $bpi->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@include('bpi.mobile.create')
