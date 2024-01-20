@extends('layouts.app')

@section('title', 'Setting Presensi')
@section('content')
    <div class="card p-3 rounded mb-3">
        {{-- <div class="mb-3">
            <a href="/setting/create" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Data</a>
        </div> --}}
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">actions</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($presence_settings as $setting)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $setting->name }}</td>
                            <td>{{ $setting->value }}</td>
                            <td>{{ $setting->desc }}</td>

                            <td>
                                <a href="{{ route('admin.presenceset.edit', $setting->id) }}"
                                    class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>
                                    edit</a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="setting/{{ $setting->id }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i> del
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-success" role="alert">
                            <p class="text-center m-0">Belum Ada Data</p>
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card p-3 rounded">
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Value</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">actions</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $qrcode->name }}</td>
                        <td>{{ $qrcode->value }}</td>
                        <td>{{ $qrcode->desc }}</td>
                        <td>
                            <a href="{{ route('admin.presenceset.edit', $qrcode->id) }}" class="btn btn-warning btn-sm"><i
                                    class="bi bi-pencil-square"></i>
                                edit</a>

                            <a target="_blank"
                                href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&margin=20&data={{ $qrcode->value }}"
                                download="filename" class="btn btn-sm btn-outline-success"> <i class="bi bi-download"></i>
                                Save QR</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
