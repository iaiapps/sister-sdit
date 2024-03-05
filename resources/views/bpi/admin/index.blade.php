@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Jawaban BPI')
@section('content')
    <div class="card p-3">
        <div class="d-inline-block">
            <p class="m-0 fs-5">Data BPI bulan : {{ $carbon::parse($now)->isoFormat('MMMM YYYY') }}</p>
        </div>
        <hr>
        {{-- <div class="d-inline-block">
            <a href="{{ route('bpi.create') }}" class="btn btn-warning btn-sm mb-3"><i class="bi bi-plus-circle"></i>
                Data BPI</a>
        </div> --}}
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama Guru</th>
                        <th scope="col">Kehadiran BPI</th>
                        <th scope="col">Action</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bpis as $bpi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bpi->teacher->full_name }}</td>
                            <td>{{ $bpi->total }}</td>
                            {{-- <td>{{ $carbon::parse($bpi->start)->isoFormat('dddd, DD MMMM YYYY') }}</td> --}}

                            <td>
                                <a href="{{ route('bpi.show', $bpi->teacher_id) }}" class="btn btn-success btn-sm">
                                    show all
                                </a>
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
