@extends('layouts.app')

@section('title', 'Data Sekolah')
@section('content')
    <div class="card p-3 rounded">
        <div class="table-responsive">
            {{-- <div class="mb-3">
                <a href="/school/create" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Data</a>
            </div> --}}
            <div class="table-responsive">
                <table id="table" class="table table-striped align-middle" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schools as $school)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> <i class="{{ $school->icon }}"></i></td>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->description }}</td>

                                <td>
                                    <a href="school/{{ $school->id }}/edit" class="btn btn-warning btn-sm"><i
                                            class="bi bi-pencil-square"></i>
                                        edit</a>
                                    {{-- <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                        action="school/{{ $school->id }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash3"></i> del
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-success" role="alert">
                                <p class="text-center m-0">Belum Ada Data</p>
                            </div>
                        @endforelse
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
