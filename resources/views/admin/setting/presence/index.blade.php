@extends('layouts.app')

@section('title', 'Setting Presensi')
@section('content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="settingTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="umum-tab" data-bs-toggle="tab" data-bs-target="#umum" type="button" role="tab">Umum</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="grupA-tab" data-bs-toggle="tab" data-bs-target="#grupA" type="button" role="tab">Grup A (Guru/Tendik)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="karyawan-tab" data-bs-toggle="tab" data-bs-target="#karyawan" type="button" role="tab">Karyawan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="kasir-tab" data-bs-toggle="tab" data-bs-target="#kasir" type="button" role="tab">Kasir</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ibudapur-tab" data-bs-toggle="tab" data-bs-target="#ibudapur" type="button" role="tab">Ibu Dapur</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="settingTabContent">
                @php $tabs = ['umum' => $umum, 'grupA' => $grupA, 'karyawan' => $karyawan, 'kasir' => $kasir, 'ibudapur' => $ibudapur]; @endphp
                @foreach ($tabs as $key => $items)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nilai</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $setting)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $setting->name }}</td>
                                            <td>{{ $setting->value }}</td>
                                            <td>{{ $setting->desc }}</td>
                                            <td>
                                                <a href="{{ route('admin.presenceset.edit', $setting->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center">Belum Ada Data</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- QR Code --}}
    <div class="card p-3 rounded mt-3">
        <div class="table-responsive">
            <table class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Value</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $qrcode->name }}</td>
                        <td>{{ $qrcode->value }}</td>
                        <td>{{ $qrcode->desc }}</td>
                        <td>
                            <a href="{{ route('admin.presenceset.edit', $qrcode->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> edit</a>
                            <a target="_blank" href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&margin=20&data={{ $qrcode->value }}" download="filename" class="btn btn-sm btn-outline-success"> <i class="bi bi-download"></i> Save QR</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
