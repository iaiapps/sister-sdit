@extends('layouts.app')

@section('title', 'Setting Keuangan')
@section('content')
    <div class="card p-3">
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
                    <td>Pokok</td>
                    <td>Pengaturan Gaji Pokok </td>
                    <td>
                        <a href="{{ route('basic.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>Fungsional</td>
                    <td>Pengaturan Gaji Fungsional </td>
                    <td>
                        <a href="{{ route('functional.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                <tr>
                    <th>3</th>
                    <td>Penambahan</td>
                    <td>Pengaturan Penambahan/Tunjangan </td>
                    <td>
                        <a href="{{ route('addition.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                <tr>
                    <th>4</th>
                    <td>Pengurangan</td>
                    <td>Pengaturan Pengurangan/Tagihan </td>
                    <td>
                        <a href="{{ route('reduction.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
