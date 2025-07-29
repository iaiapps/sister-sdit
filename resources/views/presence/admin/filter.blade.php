@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Filter Presensi')
@section('content')
    <div class="card p-3">
        <div class="align-items-center">
            <p class="fs-5 text-center ">Pilih tanggal Awal dan Akhir</p>
            <div id="filter">
                <form action="{{ route('presence.filter') }}" method="GET">
                    <div class="row mb-3">
                        <div class="col my-1">
                            <input class="form-control" type="date" name="start_date">
                        </div>
                        <div class="col my-1">
                            <input class="form-control" type="date" name="end_date">
                        </div>
                        <div class="col my-1">
                            <button type="submit" class="btn btn-success w-100">
                                Filter Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="col-12 col-md-6 ">
            <h6 class="d-inline border-bottom border-success pb-2 border-3"> Bulan Awal:
                {{ request('start_date') ? $carbon::parse(request('start_date'))->isoFormat('DD MMMM Y') : 'belum ditentukan' }}
            </h6> <br><br>
            <h6 class="d-inline border-bottom border-success pb-2 border-3"> Bulan Akhir:
                {{ request('start_date') ? $carbon::parse(request('end_date'))->isoFormat('DD MMMM Y') : 'belum ditentukan' }}
            </h6>
        </div>
        <hr>

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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presences as $presence)
                        <tr>
                            <td>{{ $presence->teacher_id }}</td>
                            <td>{{ $presence->teacher->full_name }}</td>
                            <td>{{ $presence->total_data_presensi - $presence->total_sakit - $presence->total_ijin }}</td>
                            <td>
                                {{ $presence->is_late }}
                            </td>
                            <td>{{ $presence->total_tidak_presensi_pulang - $presence->total_tugas_kedinasan - $presence->total_sakit - $presence->total_ijin }}
                            </td>
                            <td>{{ $presence->total_sakit }}</td>
                            <td>{{ $presence->total_ijin }}</td>
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
