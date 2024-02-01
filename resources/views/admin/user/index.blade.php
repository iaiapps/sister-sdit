@extends('layouts.app')

@section('title', 'Data Master User')
@section('content')
    <div class="card p-3 rounded">
        <div class="table-responsive">
            <div class="mb-3">
                <div class="btn-group">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-outline-success"><i
                            class="bi bi-plus-circle"></i>
                        Tambah Data</a>
                    <a href="#" class="btn btn-outline-success"><i class="bi bi-plus-circle"></i> Import Guru</a>
                    <a href="#" class="btn btn-outline-success"><i class="bi bi-plus-circle"></i> Import
                        Siswa</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="table" class="table table-striped align-middle" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td> {{ $user->roles->first()->name ?? 'belum ditentukan' }}</td>
                                <td> {{ $user->active == 1 ? 'aktif' : 'tidak aktif' }}</td>
                                <td>
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm"><i
                                            class="bi bi-pencil-square"></i>
                                        edit</a>
                                    <form class="d-inline-block"
                                        onsubmit="return confirm('Apakah anda yakin untuk mereset password ?');"
                                        action="{{ route('admin.reset.pass', ['id' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-secondary btn-sm"><i
                                                class="bi bi-arrow-clockwise"></i> reset
                                        </button>
                                    </form>
                                    <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                        action="{{ route('admin.user.destroy', $user->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash3"></i> del
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
            $('#table').DataTable({
                "pageLength": 50
            });
        });
    </script>
@endpush
