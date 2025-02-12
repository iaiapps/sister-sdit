@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Guru Pengganti')
@section('content')
    <div class="card p-3">
        <form action="{{ route('replacement.index') }}" method="GET">
            <div class="row">
                <div class="col my-1">
                    <input type="date" name="awal" id="awal" class="form-control">
                </div>
                <div class="col my-1">
                    <input type="date" name="akhir" id="akhir" class="form-control">
                </div>
                <div class="col my-1">
                    <button type="submit" class="btn btn-success w-100">filter data</button>
                </div>
            </div>
        </form>
        <hr>
        @if (isset($awal) && isset($akhir))
            <p class="fs-5 text-center">Data bulan {{ $carbon::parse($awal)->isoFormat('MMMM YYYY') }} sampai
                {{ $carbon::parse($akhir)->isoFormat('MMMM YYYY') }}</p>
        @else
            <p class="m-0 fs-5 text-center">Data bulan : {{ $carbon::parse($now)->isoFormat('MMMM YYYY') }}</p>
        @endif
        <div class="d-inline-block">
            <a href="{{ route('replacement.create') }}" class="btn btn-warning btn-sm mb-3"><i
                    class="bi bi-plus-circle"></i>
                Data Pengganti</a>
        </div>
        <div class="table-responsive">
            <table id="#" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Pengganti</th>
                        <th scope="col">Menggantikan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Mapel</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Tugas</th>
                        <th scope="col">Diisi dengan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($replacements->sortByDesc('updated_at') as $replacement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $replacement->teacher->full_name }}</td>
                            <td>{{ $replacement->menggantikan }}</td>
                            <td>{{ $replacement->tanggal }}</td>
                            <td>{{ $replacement->jp }}</td>
                            <td>{{ $replacement->mapel }}</td>
                            <td>{{ $replacement->alasan }}</td>
                            <td>{{ $replacement->bahan }}</td>
                            <td>{{ $replacement->diisi_dengan }}</td>
                            <td>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('replacement.destroy', $replacement->id) }}" method="post"
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
