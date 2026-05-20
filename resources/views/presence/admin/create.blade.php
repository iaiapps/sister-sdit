@extends('layouts.app')

@section('title', 'Buat Data Presensi')

@section('content')

    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('store.presence') }}">
                @csrf
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 200px;">Tanggal</td>
                            <td> <input type="date" class="form-control" name="date"
                                    value="{{ $tgl }}" required> </td>
                        </tr>
                        <tr>
                            <td>Nama Guru</td>
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
                        <tr>
                            <td>Terlambat?</td>
                            <td><select class="form-select" name="is_late">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><select class="form-select" name="note">
                                    <option value="Tepat waktu">Tepat waktu</option>
                                    <option value="Telat">Telat</option>
                                    <option value="Ijin">Ijin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Tugas kedinasan">Tugas kedinasan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Deskripsi ( jika "Tugas Kedinasan" )</td>
                            <td><select class="form-select" name="description">
                                    <option value="">--- pilih ---</option>
                                    <option>Mengerjakan tugas sekolah (4 jam efektif)</option>
                                    <option>Paguyuban kelas</option>
                                    <option>KKG</option>
                                    <option>Pelatihan/workshop/Webinar</option>
                                    <option>Mendampingi lomba</option>
                                    <option>Event sekolah/Yayasan</option>
                                </select> </td>
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
            placeholder: 'Pilih guru...',
        });
    </script>
@endpush
