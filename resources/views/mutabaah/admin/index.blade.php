@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Jawaban Mutabaah')
@section('content')
    <div class="card p-3">
        <div class="d-inline-block">
            <a href="{{ route('mutabaah.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Mutabaah</a>
            <a href="{{ route('mutabaah-category.index') }}" class="btn btn-success"><i class="bi bi-list-task"></i>
                Kategori</a>
            <a href="{{ route('mutabaah-question.index') }}" class="btn btn-success"><i class="bi bi-question-circle"></i>
                Pertanyaan</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Mulai Pengerjaan</th>
                        <th scope="col">Akhir Pengerjaan</th>
                        {{-- <th scope="col">Pengisian</th> --}}
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mutabaahs as $mutabaah)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mutabaah->name }}</td>
                            <td>{{ $carbon::parse($mutabaah->start)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                            <td>{{ $carbon::parse($mutabaah->end)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                            {{-- @if ($now >= $mutabaah->start && $now <= $mutabaah->end)
                                <td><a href="{{ route('mutabaah-answer.create', ['mutabaah' => $mutabaah->id]) }}"
                                        class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> tambah </a>
                                </td>
                            @else
                                <td>melewati deadline</td>
                            @endif --}}

                            <td>
                                <a href="{{ route('mutabaah.list', ['id' => $mutabaah->id]) }}"
                                    class="btn btn-success btn-sm"><i class="bi bi-info-circle"></i> lihat
                                </a>
                                <a href="{{ route('mutabaah.edit', $mutabaah->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('mutabaah.destroy', $mutabaah->id) }}" method="post" class="d-inline">
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
