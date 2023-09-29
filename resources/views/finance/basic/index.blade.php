@extends('layouts.app')

@section('title', 'Data Gaji Pokok')
@section('content')
    <div class="card p-3 rounded">
        <div class="mb-3">
            <a href="{{ route('setting.index') }}" class="btn btn-success">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>

            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basic">
                <i class="bi bi-plus-circle"></i> Buat Data
            </a>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Gaji Pokok</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($basics as $basic)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $basic->nama_jabatan }}</td>
                            <td>{{ $basic->gaji_pokok }}</td>
                            <td>
                                <a href="{{ route('basic.edit', $basic->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('basic.destroy', $basic->id) }}" method="post" class="d-inline">
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
    @include('finance.basic.create')

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
