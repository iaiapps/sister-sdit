@extends('layouts.app')

@section('title', 'Detail Presensi')
{{-- <x-datatables /> --}}
@section('content')
    <div id="printarea" class="p-3 bg-white rounded">
        @if ($presences->count() == 0)
            <div class="text-center">
                <div class="alert alert-success m-0" role="alert">
                    <p class="fw-light fs-4">
                        Belum ada data yang tersimpan ...
                    </p>
                    <a href="{{ URL::previous() }}" class="btn btn-success">Kembali</a>
                </div>
            </div>
        @else
            @if (Auth::user()->hasRole('admin') or Auth::user()->hasRole('operator'))
                <button id="printbutton" class="btn btn-light rounded" onclick="print()">
                    <i class="bi bi-printer-fill fs-3 "></i>
                </button>
            @endif
            <div id="filter">
                <form action="{{ route('presence.show', $presences->first()->teacher_id) }}">
                    @php
                        $first = new Carbon\Carbon('first day of this month');
                        $end = Carbon\Carbon::now();
                    @endphp
                    {{-- <input type="hidden" name="teacher_id" value="{{ $id }}"> --}}
                    <div class="row mb-3">
                        <div class="col">
                            <input class="form-control" type="date" name="start_date" value="{{ date('Y-m-01') }}">
                        </div>
                        <div class="col">
                            <input class="form-control" type="date" name="end_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">
                                Filter Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="text-center header">
                <img class="img-header" src="{{ asset('img/koptengah.svg') }}" alt="">
            </div>
            <hr>
            <p class="text-center fs-5 mb-0">Presensi <strong> {{ $presences->first()->teacher->full_name }}</strong>, Bulan
                <strong>{{ Carbon\Carbon::parse(request('date'))->isoFormat('MMMM Y') }}</strong>
            </p>
            <hr>
            <div id="table" class="table-responsive">
                <table class="table align-middle" id="datatable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Datang</th>
                            <th>Pulang</th>
                            <th>Catatan</th>
                            <th>Keterangan</th>
                            @if (Auth::user()->hasRole('admin') or Auth::user()->hasRole('operator'))
                                <th id="edit">Edit</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($presences) --}}
                        @foreach ($presences->sortByDesc('created_at') as $presence)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Carbon\Carbon::parse($presence->created_at)->isoFormat('dddd, D MMMM Y') }}
                                </td>
                                <td>{{ $presence->time_in }}</td>
                                <td>{{ $presence->time_out }}</td>
                                <td>{{ $presence->note }}</td>
                                <td>{{ $presence->description }}</td>

                                @if (Auth::user()->hasRole('admin') or Auth::user()->hasRole('operator'))
                                    <td id="edit">
                                        <a href="{{ route('presence.edit', [$presence->id, 'date' => request('date')]) }}"
                                            data-toggle="modal" data-id="{!! $presence->id !!}"
                                            class="btn btn-sm btn-success editModalBtn"><i
                                                class="bi bi-pencil-square"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@push('css')
    <style>
        #printbutton {
            position: absolute;
            top: 80px;
            right: 16px;
        }

        .header {
            text-align: center;
            display: none;
        }

        .img-header {
            text-align: center;
            width: 85%;
        }

        @media print {
            body {
                visibility: hidden;
                background-color: white !important
            }

            #page {
                margin-left: 0px !important;
            }

            #printarea {
                visibility: visible !important;
                position: absolute !important;
                left: 0;
                right: 0;
                top: 0;
                /* border: 2px solid rgb(95, 222, 148); */
            }

            #filter {
                margin-top: -70px;
                visibility: hidden;
            }

            #printbutton {
                visibility: hidden;
            }

            #table {
                margin-top: -10px;
            }

            #edit {
                display: none;
            }

            .header {
                display: block;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        print() {
            window.print();
        },
    </script>
@endpush
