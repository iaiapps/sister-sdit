@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('content')
    <div class="card p-3 rounded">
        <div class="table-responsive">
            <div class="table-responsive">
                <table id="table" class="table table-striped align-middle" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @if (empty($user->teacher->full_name))
                                <tr>
                                    <td colspan="4" class="text-center">data belum ada</td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->teacher->full_name }}</td>
                                    <td>{{ $user->teacher->user->email }}</td>
                                    <td>{{ $user->teacher->user->roles->first()->name ?? 'belum ditentukan' }}</td>
                                    <td>
                                        <a href="{{ route('admin.teacher.show', $user->teacher->id) }}"
                                            class="btn btn-success btn-sm"><i class="bi bi-info-circle"></i>
                                            info</a>
                                        <a href="{{ route('admin.teacher.edit', $user->teacher->id) }}"
                                            class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>
                                            edit</a>

                                        <a href="{{ route('document.index', ['id' => $user->teacher->id]) }}"
                                            class="btn btn-primary btn-sm"><i class="bi bi-image"></i> doc</a>
                                    </td>
                                </tr>
                            @endif
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
