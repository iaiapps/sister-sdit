@extends('layouts.app')

@section('title', 'Data Jawaban Mutabaah')
@section('content')
    <div class="card p-3">
        <div class="d-inline-block">
            <a href="{{ route('mutabaah.index') }}" class="btn btn-success">kembali</a>
            {{-- <a href="{{ route('mutabaah-answer.create') }}" class="btn btn-success">Tambah Jawaban</a> --}}
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Mulai pengerjaan</th>
                        <th scope="col">Selesai pengerjaan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mutabaahs as $mutabaah)
                        <tr>
                            <td> {{ $mutabaah->id }} </td>
                            <td> {{ $mutabaah->name }} </td>
                            <td> {{ $mutabaah->start }} </td>
                            <td> {{ $mutabaah->end }} </td>
                            @if ($now >= $mutabaah->start && $now <= $mutabaah->end)
                                <td><a href="{{ route('mutabaah-answer.create', ['mutabaah' => $mutabaah->id]) }}"
                                        class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> tambah jawaban </a>
                                </td>
                            @else
                                <td>pengerjaan melewati deadline</td>
                            @endif

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
                paging: false
            });
        });
    </script>
@endpush
