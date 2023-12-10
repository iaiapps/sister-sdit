@extends('layouts.app')

@section('title', 'Edit Presensi')

@section('content')

    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('presence.update', [$presence->id, 'date' => $date]) }}">
                @csrf
                @method('put')

                <table class="table table-bordered">
                    <tbody class="align-middle">
                        <tr>
                            <td>
                                <label for="tanggal" class="form-label">Tanggal</label>
                            </td>
                            <td>
                                <input id="tanggal" type="date"
                                    class="form-control @error('time_in') is-invalid @enderror" name="date"
                                    value="{{ $tgl }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="jam_datang" class="form-label">{{ __('Jam Datang') }}</label>
                            </td>
                            <td>
                                <input id="jam_datang" type="time"
                                    class="form-control @error('time_in') is-invalid @enderror" name="time_in"
                                    value="{{ $presence->time_in }}" step="1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="jam_pulang" class="form-label">{{ __('Jam Pulang') }}</label>
                            </td>
                            <td>
                                <input id="jam_pulang" type="time"
                                    class="form-control @error('time_out') is-invalid @enderror" name="time_out"
                                    value="{{ $presence->time_out }}" step="1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="status" class="form-label">Terlambat?</label>
                            </td>
                            <td>
                                <select class="form-select" name="is_late">
                                    <option selected disabled>---</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="status" class="form-label">Status</label>
                            </td>
                            <td>
                                <select class="form-select" name="note">
                                    <option selected disabled>---</option>
                                    <option value="Tepat waktu">Tepat waktu</option>
                                    <option value="Telat">Telat</option>
                                    <option value="Tugas kedinasan">Tugas kedinasan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="keterangan" class="form-label">Keterangan</label>
                            </td>
                            <td>
                                <input id="keterangan" type="text"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ $presence->description }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class=" text-center mb-3">
                    <button type="submit" class="btn btn-success w-50"> Simpan Data </button>
                </div>
            </form>
        </div>
    </div>
@endsection
