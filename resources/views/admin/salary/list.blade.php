@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'List Data Gaji')
@section('content')

    <div class="card p-3">
        @if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Keuangan')
            <div class="row">
                <div class="col-12 col-md-6">
                    <a href="{{ route('salary.index') }}" class="btn btn-success">
                        <i class="bi bi-arrow-left-circle"></i> kembali
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <form class="row" action="{{ route('salary.create') }}" method="GET">
                        @csrf
                        <input type="text" name="id" value="{{ $teacher->id }}" hidden>
                        <div class="col">
                            <label for="date" class="mt-2">Gaji untuk bulan</label>
                        </div>
                        <div class="col">
                            <input type="date" id="date" class="form-control" name="date">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">Buat Slip </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif


        <p class="text-center fs-5 mt-3">Data gaji <strong>{{ $teacher->full_name }}</strong></p>
        <hr class="mt-0">
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">Pokok</th>
                        <th scope="col">Fungsional</th>
                        <th scope="col">Kehadiran</th>
                        <th scope="col">Penambahan</th>
                        <th scope="col">Pengurangan</th>
                        <th scope="col">Total</th>
                        <th scope="col">Cetak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salaries->sortByDesc('created_at') as $salary)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $carbon::parse($salary->bulan)->isoFormat('MMMM Y') }}</td>
                            <td>{{ $salary->gaji_pokok }}</td>
                            <td>{{ $salary->gaji_fungsional }}</td>
                            <td>{{ $salary->tot_fee_kehadiran }}</td>
                            <td>{{ $salary->komponen_b }}</td>
                            <td>{{ $salary->komponen_c }}</td>
                            <td>{{ $salary->total }}</td>
                            <td>
                                <a href="{{ route('salary.show', $salary->id) }}" class="btn btn-success btn-sm"><i
                                        class="bi bi-info-circle"></i>
                                    detail</a>
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
