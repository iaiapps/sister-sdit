@extends('layouts.app')

@section('title', 'Data Gaji Guru')
@section('content')
    <div class="card p-3 rounded">

        <div class="row">
            <div class="col-12 col-md-6">
                <p class="fs-5 mb-1">Data Poisi Gaji Guru</p>
                <a href="{{ route('position.index') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Lihat</a>
            </div>
            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <p class="fs-5 mb-1">Buat Data Gaji Secara Massal</p>
                <form action="{{ route('bulk.create') }}">
                    @csrf
                    {{-- <label for="date" class="mt-2">Pilih bulan</label> --}}
                    <div class="input-group">
                        <button type="submit" class="input-group-text btn btn-success">Isi Massal Bulan</button>
                        <input type="date" name="date" class="form-control">
                    </div>
                </form>
            </div>
        </div>

        <hr class="mt-3">
        <div class="mb-3">
            <form action="{{ route('listmassal') }}" class="row">
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <button type="submit" class="input-group-text btn btn-outline-success">lihat massal gaji
                            bulan</button>
                        <input type="date" name="date" class="form-control">
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">L/P</th>
                        {{-- <th scope="col">Tambah slip</th> --}}
                        <th scope="col">Lihat gaji</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $teacher->full_name }}</td>
                            <td>{{ $teacher->gender }}</td>
                            {{-- <td>
                                <a href="{{ route('salary.create', ['id' => $teacher->id]) }}"
                                    class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i>
                                    slip</a>
                            </td> --}}
                            <td>
                                <a href="{{ route('list', ['id' => $teacher->id, 'year' => $year]) }}"
                                    class="btn btn-success btn-sm"><i class="bi bi-info-circle"></i>
                                    info</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
