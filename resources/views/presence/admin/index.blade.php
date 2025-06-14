@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Presensi')
@section('content')
    <div class="card p-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 ">
                <a href="{{ route('presence.export', ['date' => $date]) }}" class="btn btn-success rounded ">
                    <i class="bi bi-download"></i> Download Data</a>

                <h6 class="d-inline border-bottom border-success pb-2 border-3"> Bulan :
                    {{ request('date') ? $carbon::parse($date)->isoFormat('MMMM Y') : $carbon::parse($date)->isoFormat('MMMM Y') }}
                </h6>
            </div>
            <div class="col-12 col-md-6 mt-3 mt-md-0 ">
                <form action="{{ route('presence.index') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="d-flex align-items-center ">
                        <label for="start">filter bulan</label>
                        <div class="input-group">
                            <input type="month" id="start" name="date" class="form-control"
                                value="{{ request('date') ? request('date') : $date }}">
                            <button type="submit" class="input-group-text btn btn-success">Terapkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr>
        <div class="d-inline-block">
            <a href="{{ route('add.presence') }}" class="btn btn-warning mb-3">tambah data presensi</a>
            <a href="{{ route('presence.today') }}" class="btn btn-secondary mb-3">presensi hari ini</a>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kehadiran</th>
                        <th scope="col">Terlambat</th>
                        <th scope="col">Tidak Presensi Pulang</th>
                        <th scope="col">Sakit</th>
                        <th scope="col">Ijin</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presences as $presence)
                        <tr>
                            <td>{{ $presence->teacher_id }}</td>
                            <td>{{ $presence->teacher->full_name }}</td>
                            <td>{{ $presence->total_data_presensi - $presence->total_sakit - $presence->total_ijin }}</td>
                            {{-- <td>
                                <span class="m-0">telat a : {{ $presence->is_late_a }}</span>
                                <br> <span class="m-0">telat b : {{ $presence->is_late_b }}</span>
                                <br> <span class="m-0">telat c : {{ $presence->is_late_c }}</span>
                            </td> --}}
                            <td>
                                {{-- {{ $presence->is_late_a + $presence->is_late_b + $presence->is_late_c }} --}}
                                {{ $presence->is_late }}
                            </td>
                            <td>{{ $presence->total_tidak_presensi_pulang - $presence->total_tugas_kedinasan - $presence->total_sakit - $presence->total_ijin }}
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
