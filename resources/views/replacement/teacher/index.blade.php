@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Kehadiran BPI')
@section('content')
    <div class="card p-3">
        {{-- <div class="d-inline-block">
            <p class="m-0 fs-5">Data BPI Tahun : {{ $carbon::parse($now)->isoFormat('YYYY') }}</p>
        </div> --}}
        <hr>
        <div class="d-inline-block">
            <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-circle"></i> Kehadiran BPI
            </button>

        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Guru Pengganti</th>
                        <th scope="col">Guru Yang Digantikan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jumlah JP</th>
                        <th scope="col">Mapel Yang Digantikan</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Guru Mapel Meninggalkan</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($replacements as $replacement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $replacement->teacher_id }}</td>
                            <td>{{ $replacement->menggantikan }}</td>
                            <td>{{ $replacement->tanggal }}</td>
                            <td>{{ $replacement->jp }}</td>
                            <td>{{ $replacement->mapel }}</td>
                            <td>{{ $replacement->alasan }}</td>
                            <td>{{ $replacement->bahan }}</td>
                            {{-- <td>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('replacement.destroy', $replacement->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i> del
                                    </button>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('bpi.teacher.create')
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
