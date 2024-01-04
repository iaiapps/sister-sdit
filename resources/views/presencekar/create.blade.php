@extends('layouts.app')

@section('title', 'Buat Data Presensi')

@section('content')

    <div class="card">
        {{-- <div class="card-header bg-success">{{ __('Register') }}</div> --}}
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('store.presencekar') }}">
                @csrf
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Tanggal</td>
                            <td> <input id="name" type="date" class="form-control" name="date" required </td>
                        </tr>
                        <tr>
                            <td>Nama Karyawan</td>
                            <td> <select class="form-select" id="role" name="teacher_id">
                                    <option selected disabled>---</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Waktu Datang</td>
                            <td> <input id="name" type="time" class="form-control" name="time_in" required
                                    step="1"> </td>
                        </tr>
                        <tr>
                            <td>Waktu Pulang</td>
                            <td> <input id="name" type="time" class="form-control" name="time_out" required
                                    step="1"> </td>
                        </tr>
                        {{-- <tr>
                            <td>Terlambat?</td>
                            <td><select class="form-select" id="is_late" name="is_late">
                                    <option selected disabled>---</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><select class="form-select" id="note" name="note">
                                    <option selected disabled>---</option>
                                    <option value="Tepat waktu">Tepat waktu</option>
                                    <option value="Telat">Telat</option>
                                    <option value="Tugas kedinasan">Tugas kedinasan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Deskripsi ( jika "Tugas Kedinasan" )</td>
                            <td> <input id="name" type="text" class="form-control" name="description">
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-success w-50"> tambah data </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#nis').hide();
        });
        $("#role").change(function(event) {
            if (event.target.value === '3') {
                $('#nis').show()
            }
        });
    </script>
@endpush
