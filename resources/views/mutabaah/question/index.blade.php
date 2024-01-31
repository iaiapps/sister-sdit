@extends('layouts.app')

@section('title', 'Data Kategori')
@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ route('mutabaah.index') }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
            <a class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#question">
                <i class="bi bi-plus-circle"></i> Buat Pertanyaan
            </a>
            <a href="{{ route('mutabaah-option.index') }}" class="btn btn-success">Pilihan Pertanyaan</a>

        </div>

        <div class="table-responsive mt-3">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Pertanyaan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td>{{ $question->id }}</td>
                            <td>{{ $question->category->nama_kategori }}</td>
                            <td>{{ $question->question }}</td>

                            <td><a href="{{ route('mutabaah-question.edit', $question->id) }}"
                                    class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('mutabaah-question.destroy', $question->id) }}" method="post"
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

    @include('mutabaah.question.create')
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
