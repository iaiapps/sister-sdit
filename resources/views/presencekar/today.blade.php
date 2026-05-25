@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Presensi Hari Ini')
@section('content')
    <div class="card p-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 ">
                <h6 class="fs-5 d-inline border-bottom border-success pb-2 border-3">
                    {{ $carbon::parse($date)->isoFormat('dddd, DD MMMM Y') }}
                </h6>
            </div>

        </div>

        <hr>
        <div>
            <a href="{{ route('presencekaryawan.index') }}" class="btn btn-secondary mb-1">kembali</a>
            <button id="toggleEdit" class="btn btn-warning mb-1" onclick="toggleEditMode()">
                <i class="bi bi-pencil-square"></i> Edit Presensi
            </button>
        </div>

        <form id="presenceForm" method="POST" action="{{ route('presencekar.bulk-update') }}">
            @csrf
            @method('put')
            <div class="table-responsive mt-3">
                <table id="table" class="table table-striped align-middle" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Datang</th>
                            <th scope="col">Pulang</th>
                            <th scope="col">Terlambat</th>
                            <th scope="col">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presences->sortByDesc('created_at') as $presence)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="name-cell">{{ $presence->teacher->full_name }}</td>
                                <td>
                                    <input type="hidden" name="presences[{{ $presence->id }}][id]"
                                        value="{{ $presence->id }}">
                                    <span class="view-mode">{{ $presence->time_in }}</span>
                                    <input type="text" class="edit-mode form-control form-control-sm d-none"
                                        name="presences[{{ $presence->id }}][time_in]" value="{{ $presence->time_in }}">
                                </td>
                                <td>
                                    <span class="view-mode">{{ $presence->time_out }}</span>
                                    <input type="text" class="edit-mode form-control form-control-sm d-none"
                                        name="presences[{{ $presence->id }}][time_out]" value="{{ $presence->time_out }}">
                                </td>
                                <td>
                                    <span class="view-mode">{{ $presence->is_late }}</span>
                                    <select class="edit-mode form-select form-select-sm d-none"
                                        name="presences[{{ $presence->id }}][is_late]">
                                        <option value="0" {{ $presence->is_late == 0 ? 'selected' : '' }}>0</option>
                                        <option value="1" {{ $presence->is_late == 1 ? 'selected' : '' }}>1</option>
                                    </select>
                                </td>
                                <td>
                                    <span class="view-mode">{{ $presence->note }}</span>
                                    <select class="edit-mode form-select form-select-sm d-none"
                                        name="presences[{{ $presence->id }}][note]">
                                        <option value="Tepat waktu"
                                            {{ $presence->note == 'Tepat waktu' ? 'selected' : '' }}>Tepat waktu</option>
                                        <option value="Telat" {{ $presence->note == 'Telat' ? 'selected' : '' }}>Telat
                                        </option>
                                        <option value="Ijin" {{ $presence->note == 'Ijin' ? 'selected' : '' }}>Ijin
                                        </option>
                                        <option value="Sakit" {{ $presence->note == 'Sakit' ? 'selected' : '' }}>Sakit
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div id="saveButtons" class="d-none mt-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                </button>
                <button type="button" class="btn btn-secondary" onclick="toggleEditMode()">
                    <i class="bi bi-x-circle"></i> Batal
                </button>
            </div>
        </form>

    </div>
@endsection

@push('scripts')
    <script>
        let isEditMode = false;

        function toggleEditMode() {
            isEditMode = !isEditMode;
            const viewModes = document.querySelectorAll('.view-mode');
            const editModes = document.querySelectorAll('.edit-mode');
            const toggleBtn = document.getElementById('toggleEdit');
            const saveButtons = document.getElementById('saveButtons');

            if (isEditMode) {
                viewModes.forEach(el => el.classList.add('d-none'));
                editModes.forEach(el => el.classList.remove('d-none'));
                toggleBtn.classList.add('d-none');
                saveButtons.classList.remove('d-none');
            } else {
                viewModes.forEach(el => el.classList.remove('d-none'));
                editModes.forEach(el => el.classList.add('d-none'));
                toggleBtn.classList.remove('d-none');
                saveButtons.classList.add('d-none');
            }
        }
    </script>
@endpush
