@extends('layouts.app')

@section('title', 'Data List Pertanyaan')
@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
        </div>

        <p class="mt-3 mb-0 fs-5 text-center">Kategori <span class="fw-bold"> {{ $mutabaah_category->nama_kategori }}</span>
        </p>
        <hr>
        <div class="table-responsive mt-3">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Pertanyaan</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mutabaah_category->question as $q)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $q->question }}</td>
                        </tr>
                    @endforeach
                    {{-- @foreach ($kategori as $k)
                        <tr>
                            <td>{{ $k->id }}</td>
                            <td>{{ $k->nama_kategori }}</td>
                            <td>{{ $k->question->count() }}
                                <a href="#" class="btn btn-primary btn-sm ms-2"><i class="bi bi-search"></i> lihat</a>
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
                    @endforeach --}}

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
