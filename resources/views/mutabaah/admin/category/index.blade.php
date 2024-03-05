@extends('layouts.app')

@section('title', 'Data Kategori')
@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ route('mutabaah.index') }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#kategori">
                <i class="bi bi-plus-circle"></i> Buat Data Kategori
            </a>

        </div>

        <div class="table-responsive mt-3">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Id Kategori</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Jumlah pertanyaan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $k)
                        <tr>
                            <td>{{ $k->id }}</td>
                            <td>{{ $k->nama_kategori }}</td>
                            <td>{{ $k->question->count() }}
                                <a href="{{ route('mutabaah-category.show', $k->id) }}"
                                    class="btn btn-primary btn-sm ms-2"><i class="bi bi-search"></i> lihat</a>
                            </td>

                            <td><a href="{{ route('mutabaah-category.edit', $k->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('mutabaah-category.destroy', $k->id) }}" method="post"
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

    @include('mutabaah.admin.category.create')
@endsection

@include('layouts.partials.allscripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: false,
                searching: false,
                // 'columnDefs': [{
                //     'searchable': false,
                //     'targets': [0, 1, 2, 3]
                // }, ]
            });
        });
    </script>
@endpush
