@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Presensi Hari Ini')
@section('content')
    <div class="card p-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 ">
                <h6 class="fs-5 d-inline border-bottom border-success pb-2 border-3">
                    {{ $carbon::parse($date)->isoFormat('dddd, DD MMMM Y') }}
                </h6>
            </div>

        </div>

        <hr>
        <div>

            <a href="{{ route('presence.index') }}" class="btn btn-secondary mb-1">kembali</a>
        </div>

        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        {{-- <th scope="col">Id</th> --}}
                        <th scope="col">Nama</th>
                        <th scope="col">Datang</th>
                        <th scope="col">Pulang</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Keterangan</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($presences->sortByDesc('created_at') as $presence)
                        <tr>
                            {{-- <td>{{ $presence->teacher_id }}</td> --}}
                            <td>{{ $presence->teacher->full_name }}</td>
                            <td>{{ $presence->time_in }}</td>
                            <td> {{ $presence->time_out }}</td>
                            <td>{{ $presence->note }}</td>
                            <td>{{ $presence->description }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
