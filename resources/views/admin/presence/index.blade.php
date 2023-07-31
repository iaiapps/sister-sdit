@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Presensi')
@section('content')
    <div class="card p-3">
        <div class="row mb-1">
            <div class="col-12 col-md-6">
                <a href="{{ route('presence.excel', ['date' => $date]) }}" class="btn btn-success rounded ">
                    <i class="bi bi-download"></i> Download Data</a>

                <h6 class="d-inline border-bottom border-success pb-2 border-3"> Bulan :
                    {{ request('date') ? $carbon::parse($date)->isoFormat('MMMM Y') : $carbon::parse($date)->isoFormat('MMMM Y') }}
                </h6>
            </div>
            <div class="col-12 col-md-6 text-end">
                <form action="/presence" method="GET">
                    {{-- @csrf --}}
                    <div class="row">
                        <div class="col">
                            <label for="start" class="mt-2">filter bulan</label>
                        </div>
                        <div class="col-auto">
                            <input type="month" id="start" name="date"
                                value="{{ request('date') ? request('date') : $date }}" class="form-control" />
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success">Terapkan</button>
                        </div>
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
                        <th scope="col">Nama</th>
                        <th scope="col">Kehadiran</th>
                        <th scope="col">Golongan</th>
                        <th scope="col">Terlambat</th>
                        <th scope="col">Sakit</th>
                        <th scope="col">Ijin</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presences as $presence)
                        <tr>
                            {{-- @dd($presences) --}}
                            {{-- <td>{{ $loop->iteration }}</td> --}}
                            <td>{{ $presence->teacher_id }}</td>
                            <td>{{ $presence->teacher->full_name }}</td>
                            <td>{{ $presence->total_kehadiran - $presence->total_sakit - $presence->total_ijin }}</td>
                            <td>
                                <span class="m-0">telat a : {{ $presence->is_late_a }}</span>
                                <br> <span class="m-0">telat b : {{ $presence->is_late_b }}</span>
                                <br> <span class="m-0">telat c : {{ $presence->is_late_c }}</span>
                            </td>
                            <td>
                                {{ $presence->is_late_a + $presence->is_late_b + $presence->is_late_c }}
                            </td>
                            <td>{{ $presence->total_sakit }}</td>
                            <td>{{ $presence->total_ijin }}</td>
                            <td>
                                <a href="{{ route('presence.show', [$presence->teacher->id, 'date' => $date]) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="bi bi-info-circle"></i> detail</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
