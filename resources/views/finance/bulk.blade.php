@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Isi Massal Gaji Guru')
@section('content')
    <div class="card p-3 rounded mb-3">

        <div class="row">
            <div class="col">
                <p>Cara Input Massal Data Gaji</p>
                <ul class="list-group">
                    <li class="list-group-item">1. Download terlebih dahulu template excel dibawah</li>
                    <li class="list-group-item">2. Masukkan data gaji ke excel yang sudah didownload</li>
                    <li class="list-group-item">3. Upload file yang sudah diisi </li>
                </ul>
            </div>
            <div class="col">
                <p>Upload data gaji disini</p>
                <form action="{{ route('salary.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-0">
                        <div class="col-auto text-end">
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="col text-end">
                            <button class="btn btn-success">Upload Data Gaji</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="card p-3">
        <div class="mb-3">
            <p class="fs-5 d-inline">TABEL TEMPLATE</p>
            <a class="btn btn-warning float-end" href="{{ route('salary.export', ['date' => $date]) }}">
                Download template data bulan ini
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>teacher_id</th>
                        <th>nama</th>
                        <th>nomor_slip</th>
                        <th>bulan</th>
                        <th>hadir</th>
                        <th>tepat</th>
                        <th>telat</th>
                        <th>gaji_pokok</th>
                        <th>gaji_fungsional</th>
                        <th>tot_fee_kehadiran</th>
                        <th>ekskul </th>
                        <th>istri_anak </th>
                        <th>sukses_un_khotib </th>
                        <th>fee </th>
                        <th>hari_raya </th>
                        <th>dpp </th>
                        <th>koperasi </th>
                        <th>peminjaman </th>
                        <th>dansos </th>
                        <th>bpjs </th>
                        {{-- <th>komponen_a </th>
                        <th>komponen_b </th>
                        <th>komponen_c </th>
                        <th>total </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presences as $presence)
                        @php
                            // presensi
                            $kehadiran = $presence->total_data_presensi - $presence->total_sakit - $presence->total_ijin;
                            $telat = $presence->is_late;

                            $total_tepat = $kehadiran - $telat;
                            $total_telat = $telat;

                            //fee
                            $tot_kehadiran = $kehadiran * $fee_kehadiran;
                            $fee_telat = $telat * $potongan_late;

                            $total_fee_kehadiran = $tot_kehadiran - $fee_telat;
                        @endphp
                        <tr>
                            <td>{{ $presence->teacher->id }}</td>
                            <td>{{ $presence->teacher->full_name }}</td>
                            <td>{{ $presence->teacher->id . $carbon::parse($date)->format('dmY') }}</td>
                            <td>{{ $date }}</td>
                            <td>{{ $kehadiran }}</td>
                            <td>{{ $total_tepat }}</td>
                            <td>{{ $total_telat }}</td>
                            <td>{{ $presence->teacher->salary_position->salary_pokok->besarnya }}</td>
                            <td>{{ $presence->teacher->salary_position->salary_fungsional->besarnya }}</td>
                            <td>{{ $total_fee_kehadiran }}</td>
                            <td>{{ $presence->ekskul }}</td>
                            <td>{{ $presence->istri_anak }}</td>
                            <td>{{ $presence->sukses_un_khotib }}</td>
                            <td>{{ $presence->fee }}</td>
                            <td>{{ $presence->hari_raya }}</td>
                            <td>{{ $presence->dpp }}</td>
                            <td>{{ $presence->koperasi }}</td>
                            <td>{{ $presence->peminjaman }}</td>
                            <td>{{ $presence->dansos }}</td>
                            <td>{{ $presence->bpjs }}</td>
                            {{-- <td>{{ $presence->komponen_a }}</td>
                            <td>{{ $presence->komponen_b }}</td>
                            <td>{{ $presence->komponen_c }}</td>
                            <td>{{ $presence->total }}</td> --}}

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
