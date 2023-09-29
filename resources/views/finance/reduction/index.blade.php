@extends('layouts.app')

@section('title', 'Data Pengurangan')
@section('content')
    <div class="card p-3 rounded">
        <div class="mb-3">
            <a href="{{ route('setting.index') }}" class="btn btn-success">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reduction">
                <i class="bi bi-plus-circle"></i> Buat Data
            </a>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Penambahan</th>
                        <th scope="col">Besarnya</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reductions as $reduction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reduction->nama_pengurangan }}</td>
                            <td>{{ $reduction->besarnya }}</td>
                            <td>
                                <a href="{{ route('reduction.edit', $reduction->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('reduction.destroy', $reduction->id) }}" method="post"
                                    class="d-inline">
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
    @include('finance.reduction.create')

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
