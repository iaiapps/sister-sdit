@extends('layouts.app')

@section('title', 'Buat Data Presensi Karyawan')

@section('content')

    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('store.presencekar') }}">
                @csrf
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 200px;">Tanggal</td>
                            <td> <input type="date" class="form-control" name="date"
                                    value="{{ $tgl }}" required> </td>
                        </tr>
                        <tr>
                            <td>Nama Karyawan</td>
                            <td>
                                <select class="form-select" style="width: 100%" id="teacher" name="teacher_ids[]" multiple>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->teacher->id }}">{{ $user->teacher->full_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Waktu Datang</td>
                            <td> <input type="time" class="form-control" name="time_in" required step="1"> </td>
                        </tr>
                        <tr>
                            <td>Waktu Pulang</td>
                            <td> <input type="text" class="form-control" name="time_out" placeholder="contoh: 14:00:00 atau -"> </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-success w-50"> tambah data </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@include('layouts.partials.allscripts')

@push('scripts')
    <script>
        $('#teacher').select2({
            theme: 'bootstrap-5',
            placeholder: 'Pilih karyawan...',
            width: '100%',
        });
    </script>
@endpush
