@extends('layouts.app')

@section('title', 'Bulk Add Presensi Karyawan')

@section('content')
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Bulk Add Presensi Karyawan</h5>
            <a href="{{ route('presencekaryawan.index') }}" class="btn btn-secondary btn-sm">kembali</a>
        </div>

        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
                @if (session('errorDetails'))
                    <hr>
                    <pre class="mb-0" style="font-size: .85rem">{{ session('errorDetails') }}</pre>
                @endif
            </div>
        @endif

        <form method="POST" action="{{ route('presencekar.bulk-preview') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" name="date" id="date" class="form-control"
                        value="{{ old('date', date('Y-m-d')) }}" required>
                </div>
                <div class="col-md-8 d-flex align-items-end">
                    <div class="alert alert-info p-2 mb-0 w-100">
                        <strong>Format (tab-separated):</strong>
                        <code class="d-block mt-1">teacher_id &nbsp; time_in &nbsp; time_out &nbsp; is_late &nbsp; note</code>
                        <span class="small">cukup 2 kolom (teacher_id + time_in), sisanya otomatis</span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Paste data di sini:</label>
                <textarea name="data" id="data" rows="12" class="form-control font-monospace" placeholder="Tempel data dari spreadsheet...">{{ old('data') }}</textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-50">
                    <i class="bi bi-eye"></i> Preview
                </button>
            </div>
        </form>
    </div>
@endsection

@include('layouts.partials.allscripts')
