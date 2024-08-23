@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Semua Data')

@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
        </div>
        {{-- <p class="text-center fs-5 mb-0">Data Jawaban <strong> {{ $bpis->first()->teacher->full_name }}</strong> </p> --}}
        <hr>
        <div class="table-responsive">
            <table class="table align-middle" id="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bpis->sortByDesc('date') as $bpi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $carbon::parse($bpi->date)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                            <td>
                                <a href="{{ route('bpi.edit', $bpi->id) }}" data-toggle="modal"
                                    class="btn btn-sm btn-success "><i class="bi bi-pencil-square"></i></a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('bpi.destroy', $bpi->id) }}" method="post" class="d-inline">
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
{{--
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
@endpush --}}
