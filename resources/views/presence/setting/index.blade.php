@extends('layouts.app')

@section('title', 'Setting Aplikasi')
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-4 col-6">
                <div class="card">
                    <div class="card-header">
                        <p class="m-0">Setting Aplikasi</p>
                    </div>
                    <div class="card-body text-center">
                        <p> Setting sekolah dan aplikasi </p>
                        <a href="{{ route('school.index') }}" class="btn btn-success">Atur</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="card">
                    <div class="card-header">
                        <p class="m-0">Setting Presensi</p>
                    </div>
                    <div class="card-body text-center">
                        <p> Atur Jam Presensi </p>
                        <a href="{{ route('presenceset.index') }}" class="btn btn-success">Atur</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="card">
                    <div class="card-header">
                        <p class="m-0">Setting Keuangan</p>
                    </div>
                    <div class="card-body text-center">
                        <p> Atur gaji, potongan, dan fee </p>
                        <a href="" class="btn btn-success">Atur</a>
                    </div>
                </div>
            </div>

        </div>


        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Setting</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <td>Presensi</td>
                    <td>Pengaturan presensi</td>
                    <td><a href="{{ route('presenceset.index') }}" class="btn btn-success btn-sm">Lihat</a></td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>Pokok</td>
                    <td>Pengaturan Gaji Pokok </td>
                    <td>
                        <a href="{{ route('basic.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                <tr>
                    <th>3</th>
                    <td>Fungsional</td>
                    <td>Pengaturan Gaji Fungsional </td>
                    <td>
                        <a href="{{ route('functional.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                <tr>
                    <th>4</th>
                    <td>Penambahan</td>
                    <td>Pengaturan Penambahan/Tunjangan </td>
                    <td>
                        <a href="{{ route('addition.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                <tr>
                    <th>5</th>
                    <td>Pengurangan</td>
                    <td>Pengaturan Pengurangan/Tagihan </td>
                    <td>
                        <a href="{{ route('reduction.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>

                <tr>
                    <th>6</th>
                    <td>Kontak</td>
                    <td>Pusat Informasi</td>
                    <td>
                        <a href="#" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

@endsection
