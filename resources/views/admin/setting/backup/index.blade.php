@extends('layouts.app')

@section('title', 'Backup & Restore Database')
@section('content')
    <div class="card p-3">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-download"></i> Backup Database</h5>
                    </div>
                    <div class="card-body">
                        <p>Backup seluruh data database ke file SQL. File backup akan disimpan di server.</p>
                        <form action="{{ route('admin.setting.backup.backup') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Jalankan
                                Backup</button>
                        </form>
                    </div>

                    <h5 class="mb-3">Daftar Backup</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama File</th>
                                    <th>Tanggal</th>
                                    <th>Ukuran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($backups as $index => $backup)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $backup['filename'] }}</td>
                                        <td>{{ $backup['date']->format('d M Y H:i') }}</td>
                                        <td>{{ number_format($backup['size'] / 1024, 2) }} KB</td>
                                        <td>
                                            <a href="{{ route('admin.setting.backup.download', $backup['filename']) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                            <form action="{{ route('admin.setting.backup.delete', $backup['filename']) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin hapus?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada backup</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card border-warning">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-upload"></i> Restore Database</h5>
                    </div>
                    <div class="card-body">
                        <p>Pulihkan database dari file backup (.sql). <strong>Warning: Data existing akan ditimpa!</strong>
                        </p>
                        <form action="{{ route('admin.setting.backup.restore') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" name="file" class="form-control" accept=".sql" required>
                            </div>
                            <button type="submit" class="btn btn-warning"><i class="bi bi-arrow-counterclockwise"></i>
                                Restore</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
