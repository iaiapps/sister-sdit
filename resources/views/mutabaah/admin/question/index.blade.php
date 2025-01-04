@extends('layouts.app')

@section('title', 'Daftar Semua Pertanyaan')
@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ route('mutabaah.index') }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
            <a class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#question">
                <i class="bi bi-plus-circle"></i> Buat Pertanyaan
            </a>
            {{-- <a href="{{ route('mutabaah-option.index') }}" class="btn btn-success">Lihat Semua Pilihan Pertanyaan</a> --}}
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Untuk</th>
                        <th scope="col">Pertanyaan</th>
                        <th scope="col">Maks Point</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions->sortBy('category_id') as $question)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $question->category->nama_kategori }} </td>
                            <td>{{ $question->question_for }}
                            <td>{{ $question->question }}
                                {{-- <br>
                                <a href="{{ route('mutabaah-option.create', ['id' => $question->id]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> pilihan jawaban</a> --}}
                            </td>
                            <td>{{ $question->max_point }}</td>

                            {{-- <td>
                                @foreach ($question->option->sortByDesc('option_point') as $o)
                                    <div class="mb-2">
                                        <span class="btn btn-sm text-white bg-primary me-1">{{ $o->option_name }}
                                            :
                                            {{ $o->option_point }}</span> <a class="btn btn-sm btn-warning"
                                            href="{{ route('mutabaah-option.edit', $o->id) }}">edit</a>
                                        <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                            action="{{ route('mutabaah-option.destroy', $o->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"> del
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </td> --}}
                            <td>
                                <a href="{{ route('mutabaah-question.edit', $question->id) }}"
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
    @include('mutabaah.admin.question.create')
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
