@extends('layouts.app')

@section('title', 'Data Jabatan')
@section('content')
    <div class="card p-3 rounded">
        <div class="mb-3">
            <a href="{{ route('salary.index') }}" class="btn btn-success">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Guru</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $teacher->full_name }}</td>

                            <td>{{ $teacher->salary_basic->nama_jabatan ?? 'belum ditentukan' }}</td>

                            <td>
                                <a href="{{ route('position.edit', $teacher->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i>
                                </a>
                                {{-- <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('position.destroy', $teacher->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- @include('admin.salary.position.create') --}}

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
