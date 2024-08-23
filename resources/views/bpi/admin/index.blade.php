@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Presensi BPI')
@section('content')
    <div class="card p-3">
        {{-- <div class="d-inline-block">
            <p class="m-0 fs-5">Data BPI bulan : {{ $carbon::parse($date)->isoFormat('MMMM YYYY') }}</p>
        </div>
        <hr> --}}
        {{-- <div class="d-inline-block">
            <a href="{{ route('bpi.create') }}" class="btn btn-warning btn-sm mb-3"><i class="bi bi-plus-circle"></i>
                Data BPI</a>
        </div> --}}
        <div class="row align-items-center">
            <div class="col-12 col-md-6 ">
                <h6 class="d-inline border-bottom border-success pb-2 border-3"> Data BPI Bulan :
                    {{ request('date') ? $carbon::parse($date)->isoFormat('MMMM Y') : $carbon::parse($date)->isoFormat('MMMM Y') }}
                </h6>
            </div>
            <div class="col-12 col-md-6 mt-3 mt-md-0 ">
                <form action="{{ route('bpi.index') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="input-group">
                        <button type="button" class="input-group-text btn btn-secondary" disabled>filter</button>
                        <input type="month" id="start" name="date" class="form-control"
                            value="{{ request('date') ? request('date') : $date }}">
                        <button type="submit" class="input-group-text btn btn-success">Terapkan</button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama Guru</th>
                        <th scope="col">Presensi Mengajar BPI</th>
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
