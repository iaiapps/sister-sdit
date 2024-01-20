@extends('layouts.app')

@section('title', 'Data Type Gaji')
@section('content')
    <div class="card p-3 rounded">
        <div class="mb-3">
            <a href="{{ route('admin.setting.index') }}" class="btn btn-success">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>

            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#type">
                <i class="bi bi-plus-circle"></i> Buat Data
            </a>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Besar Nominal</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $type->type }}</td>
                            <td>{{ $type->nama }}</td>
                            <td>@currency($type->besarnya) </td>
                            <td>
                                <a href="{{ route('type.edit', $type->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('type.destroy', $type->id) }}" method="post" class="d-inline">
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
    @include('finance.type.create')

@endsection
@include('layouts.partials.allscripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
