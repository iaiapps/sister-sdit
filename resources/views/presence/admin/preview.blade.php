@extends('layouts.app')

@section('title', 'Preview Bulk Add Presensi')

@section('content')
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Preview Bulk Add Presensi Guru / Tendik</h5>
            <a href="{{ route('presence.bulk-add') }}" class="btn btn-secondary btn-sm">kembali</a>
        </div>

        <div class="alert alert-info">
            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($date)->isoFormat('DD MMMM Y') }}
            &nbsp;|&nbsp;
            <strong>Total data:</strong> {{ count($rows) }}
            &nbsp;|&nbsp;
            <strong>Valid:</strong> <span class="text-success">{{ collect($rows)->where('status', 'OK')->count() }}</span>
            &nbsp;|&nbsp;
            <strong>Error:</strong> <span class="text-danger">{{ collect($rows)->where('status', '!=', 'OK')->count() }}</span>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Teacher ID</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Datang</th>
                        <th>Pulang</th>
                        <th>Terlambat</th>
                        <th>Catatan</th>
                        <th>created_at</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $i => $row)
                        <tr class="{{ $row['status'] === 'OK' ? '' : 'table-danger' }}">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $row['teacher_id'] }}</td>
                            <td>{{ $row['teacher_name'] ?? '-' }}</td>
                            <td>{{ $row['date'] }}</td>
                            <td>{{ $row['time_in'] }}</td>
                            <td>{{ $row['time_out'] }}</td>
                            <td>{{ $row['is_late'] }}</td>
                            <td>{{ $row['note'] }}</td>
                            <td><code>{{ $row['date'] }} {{ $row['time_in'] }}</code></td>
                            <td>
                                @if ($row['status'] === 'OK')
                                    <span class="badge bg-success">OK</span>
                                @else
                                    <span class="badge bg-danger">{{ $row['status'] }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @php $hasValid = collect($rows)->where('status', 'OK')->isNotEmpty(); @endphp

        @if ($hasValid)
            <form method="POST" action="{{ route('presence.bulk-store') }}">
                @csrf
                <input type="hidden" name="data" value="{{ $rawData }}">
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="confirmed" value="1">
                <div class="text-center mt-3">
                    <a href="{{ route('presence.bulk-add') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Konfirmasi Simpan
                    </button>
                </div>
            </form>
        @else
            <div class="text-center mt-3">
                <a href="{{ route('presence.bulk-add') }}" class="btn btn-warning">Kembali Perbaiki Data</a>
            </div>
        @endif
    </div>
@endsection

@include('layouts.partials.allscripts')
