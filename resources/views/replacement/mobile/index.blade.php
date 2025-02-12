@extends('layouts.appmobile')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Penggantian Guru')
@section('content')
    @if (session('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <p class="m-0">{{ session('msg') }} </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card p-3">
        <div class="d-inline-block">
            <p class="m-0 float-start">Guru pengganti : {{ $tid->full_name }}</p>
            <p class="m-0 float-sm-end float-start">Data bulan :
                {{ $carbon::parse($now)->isoFormat('MMMM YYYY') }}</p>
        </div>
        <hr>
        <a class="btn btn-success btn-sm" href="{{ route('pengganti-mobile.create') }}">Tambah data menggantikan guru
            lain</a>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menggantikan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Mapel</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Tugas</th>
                        <th scope="col">Diisi dengan</th>

                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($replacements as $replacement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $replacement->menggantikan }}</td>
                            <td>{{ $replacement->tanggal }}</td>
                            <td>{{ $replacement->jp }}</td>
                            <td>{{ $replacement->mapel }}</td>
                            <td>{{ $replacement->alasan }}</td>
                            <td>{{ $replacement->bahan }}</td>
                            <td>{{ $replacement->diisi_dengan }}</td>

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
@endsection

{{-- @include('layouts.partials.allscripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: true,
                // pageLength: 50,
                lengthChange: false,
                searching: false
            });
        });
    </script>
@endpush --}}
