@extends('layouts.app')

@section('title', 'Data Type Gaji')
@section('content')
    <div class="card p-3 rounded">
        <div class="mb-3">
            <a href="{{ route('salary.index') }}" class="btn btn-success">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
            <a href="{{ route('position.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> buat
            </a>
        </div>
        <hr>

        {{-- <div class="row">
            <div class="col">
                <p class="text-center m-0">Table Gaji Pokok</p>
                <hr>
                <div class="table-responsive">
                    <table id="" class="table table-striped align-middle" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Guru</th>
                                <th scope="col">Gaji</th>
                                <th scope="col">besarnya</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gaji_pokok as $gp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $gp->teacher->full_name }}</td>
                                    <td>{{ $gp->nama }}</td>
                                    <td>{{ $gp->besarnya }}</td>
                                    <td>
                                        <a href="{{ route('position.edit', $gp->id) }}" class="btn btn-warning btn-sm"><i
                                                class="bi bi-pencil-square"></i>
                                        </a>
                                        <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                            action="{{ route('position.destroy', $gp->id) }}" method="post"
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
            <div class="col">
                <p class="text-center m-0">Table Gaji Fungsional</p>
                <hr>
                <div class="table-responsive">
                    <table id="" class="table table-striped align-middle" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Guru</th>
                                <th scope="col">Gaji</th>
                                <th scope="col">besarnya</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gaji_fungsional as $gf)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $gf->teacher->full_name }}</td>
                                    <td> {{ $gf->nama }} </td>
                                    <td> {{ $gf->besarnya }} </td>
                                    <td>
                                        <a href="{{ route('position.edit', $gf->id) }}" class="btn btn-warning btn-sm"><i
                                                class="bi bi-pencil-square"></i>
                                        </a>
                                        <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                            action="{{ route('position.destroy', $gf->id) }}" method="post"
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
        </div> --}}

        @if (session('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table id="" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Guru</th>
                        <th scope="col">Gaji pokok</th>
                        <th scope="col">Gaji Fungsional</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->teacher->full_name }}</td>
                            <td>{{ $data->salary_pokok->nama }} : {{ $data->salary_pokok->besarnya }}</td>
                            <td>{{ $data->salary_fungsional->nama }} : {{ $data->salary_fungsional->besarnya }} </td>
                            <td>
                                <a href="{{ route('position.edit', $data->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('position.destroy', $data->id) }}" method="post" class="d-inline">
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
    {{-- @include('admin.salary.position.create') --}}

@endsection
@include('layouts.partials.allscripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
