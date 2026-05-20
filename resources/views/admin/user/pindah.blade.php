@extends('layouts.app')

@section('title', 'User Nonaktif/Pindah')
@section('content')
    <div class="card p-3 rounded">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Data User Nonaktif (Pindah)</h5>
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary btn-sm">kembali</a>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->teacher->full_name ?? $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->entityOrder->role ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
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
            $('#table').DataTable({
                paging: false,
                order: []
            });
        });
    </script>
@endpush