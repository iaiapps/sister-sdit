@extends('layouts.app')

@section('title', 'Data Gaji Guru')
@section('content')
    <div class="card p-3 rounded">

        <div class="row">
            <div class="col">
                <p class="fs-5 mb-1">Data Guru</p>
                <a href="{{ route('position.index') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Data Jabatan</a>
                <a href="{{ route('pfunctional.index') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Data Fungsional</a>
            </div>
            <div class="col">
                <p class="fs-5 mb-1">Buat Data Gaji Secara Massal</p>
                <form action="{{ route('bulk.create') }}" class="row">
                    @csrf
                    <div class="col">
                        <label for="date" class="mt-2">Pilih bulan</label>
                    </div>
                    <div class="col">
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-success">Isi Massal</button>
                    </div>
                </form>

                {{-- <a href="{{ route('bulk.create') }}" class="btn btn-outline-success">
                    <i class="bi bi-plus-circle"></i> Isi Massal</a> --}}
            </div>
        </div>

        <hr class="mt-3">
        <div class="mb-3">
            <form action="{{ route('listmassal') }}" class="row">
                <div class="col-3">
                    <button type="submit" class="btn btn-outline-success">lihat massal gaji bulan</button>
                </div>
                <div class="col-3">
                    <input type="date" name="date" class="form-control">
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        {{-- <th scope="col">Tambah slip</th> --}}
                        <th scope="col">Lihat gaji</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $teacher->full_name }}</td>
                            <td>{{ $teacher->email }}</td>
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
