@extends('layouts.app')

@section('title', 'Data Guru')
@section('content')
    <div class="card p-3 rounded">
        <div class="table-responsive">
            <div class="mb-3">
                <a href="http://" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i> Download Data</a>
            </div>
            <div class="table-responsive">
                <table id="table" class="table table-striped align-middle" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $teacher->full_name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>
                                    <a href="{{ route('teacher.show', $teacher->id) }}" class="btn btn-success btn-sm"><i
                                            class="bi bi-info-circle"></i>
                                        info</a>
                                    <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-warning btn-sm"><i
                                            class="bi bi-pencil-square"></i>
                                        edit</a>
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
            $('#table').DataTable();
        });
    </script>
@endpush
