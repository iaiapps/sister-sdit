@extends('layouts.app')

@section('title', 'Data List Pertanyaan')
@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ route('mutabaah-category.index') }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
        </div>

        <p class="mt-3 mb-0 fs-5 text-center">Kategori <span class="fw-bold"> {{ $mutabaah_category->nama_kategori }}</span>
        </p>
        <hr>
        <div>
            <a class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#question">
                <i class="bi bi-plus-circle"></i> Buat Pertanyaan
            </a>
        </div>
        <div class="table-responsive mt-3">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Pertanyaan</th>
                        <th scope="col">Pilihan Jawaban : Point</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mutabaah_category->question as $q)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="width: 50%">{{ $q->question }} <br>
                                <div class="btn-group">
                                    <a href="{{ route('mutabaah-option.create', ['id' => $q->id]) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i> pilihan jawaban</a>
                                    <a href="{{ route('mutabaah-question.edit', $q->id) }}"
                                        class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> edit
                                    </a>
                                </div>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('mutabaah-question.destroy', $q->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i> del
                                    </button>
                                </form>
                            </td>
                            <td>
                                <table class="table align-middle table-sm">
                                    @foreach ($q->option->sortByDesc('option_point') as $o)
                                        <tr>
                                            <td>{{ $o->option_name . ' : ' . $o->option_point }}</td>
                                            <td>
                                                <a class="btn btn-link p-1"
                                                    href="{{ route('mutabaah-option.edit', $o->id) }}">edit</a>
                                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                                    action="{{ route('mutabaah-option.destroy', $o->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-link p-1"> del
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @include('mutabaah.admin.category.create')

    {{-- create question from category --}}
    <div id="question" class="modal" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pertanyaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class=" p-3">
                    <form action="{{ route('mutabaah-question.store') }}" method="POST">
                        @csrf
                        <fieldset>
                            <input type="text" name="category_id" id="category_id" value="{{ $mutabaah_category->id }}"
                                readonly hidden>
                            <input type="text" name="category" value="category" hidden readonly>
                            <div class="mb-3">
                                <label class="form-label" for="question">Pertanyaan</label>
                                <input class="form-control" type="text" id="question" name="question"
                                    placeholder="tuliskan pertanyaan disini ..." />
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Pertanyaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
