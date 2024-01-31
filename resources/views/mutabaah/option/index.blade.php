@extends('layouts.app')

@section('title', 'Data Pilihan')
@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ route('mutabaah-question.index') }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pilihan">
                <i class="bi bi-plus-circle"></i> Buat Data Pilihan
            </a>
        </div>

        <div class="table-responsive mt-3">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Pilihan</th>
                        <th scope="col">Nama Pilihan</th>
                        <th scope="col">Point Pilihan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($options as $option)
                        <tr>
                            <td>{{ $option->id }}</td>
                            <td>{{ $option->option_code }}</td>
                            <td>{{ $option->option_name }}</td>
                            <td>{{ $option->option_point }} </td>

                            <td><a href="{{ route('mutabaah-option.edit', $option->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('mutabaah-option.destroy', $option->id) }}" method="post"
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

    @include('mutabaah.option.create')
@endsection

@include('layouts.partials.allscripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: true,
                pageLength: 50
            });
        });
    </script>
@endpush
