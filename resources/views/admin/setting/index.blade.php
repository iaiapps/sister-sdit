@extends('layouts.app')

@section('title', 'Setting Aplikasi')
@section('content')
    <div class="card p-3">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">Setting</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Presensi</td>
                    <td>Pengaturan presensi</td>
                    <td><a href="{{ route('presenceset.index') }}" class="btn btn-success btn-sm">Lihat</a></td>
                </tr>
                <tr>
                    <td>Pokok</td>
                    <td>Pengaturan Gaji Pokok </td>
                    <td>
                        <a href="{{ route('basic.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                <tr>
                    <td>Fungsional</td>
                    <td>Pengaturan Gaji Fungsional </td>
                    <td>
                        <a href="{{ route('functional.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                <tr>
                    <td>Penambahan</td>
                    <td>Pengaturan Penambahan/Tunjangan </td>
                    <td>
                        <a href="{{ route('addition.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                <tr>
                    <td>Pengurangan</td>
                    <td>Pengaturan Pengurangan/Tagihan </td>
                    <td>
                        <a href="{{ route('reduction.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>

                <tr>
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
