@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'List Data Gaji')
@section('content')

    <div class="card p-3">

        <div class="row">
            <div class="col-12 col-md-6">
                <a href="{{ route('salary.index') }}" class="btn btn-success">
                    <i class="bi bi-arrow-left-circle"></i> kembali
                </a>
            </div>

        </div>

        <p class="fs-5">Data Gaji Bulan {{ $carbon::parse(request('date'))->isoFormat('MMMM Y') }} </p>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
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
                            <td>{{ $salary->teacher->full_name }}</td>

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
