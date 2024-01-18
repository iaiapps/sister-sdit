@extends('layouts.app')

@section('title', 'Biodata Guru')
@section('content')

    @if ($teacher->gender == null)
        <div class="bg-white rounded p-3 text-center">
            <div class="alert alert-success m-0" role="alert">
                <p class="fw-light fs-4">
                    Identitas anda tidak lengkap, mohon isi terlebih dahulu
                </p>
                <a href="{{ route('guru.teacher.edit', $teacher->id) }}" class="btn btn-success">isi identitas</a>
            </div>
        </div>
    @else
        <div class="card p-3">
            {{-- <div class="mb-3">
                <a href="{{ URL::previous() }}" class="btn btn-success btn-sm"><i class="bi bi-arrow-left-circle"></i>
                    Kembali</a>
            </div> --}}

            {{-- tab menu --}}
            <ul class="nav nav-pills" id="myTab">
                <li class="nav-item">
                    <a href="{{ url('profil#profil_guru') }}" class="nav-link active" data-bs-toggle="tab">Profil
                        Guru</a>
                </li>
                {{-- <li class="nav-item">
                        <a href="#identitas_pribadi" class="nav-link" data-bs-toggle="tab">Identitas Pribadi</a>
                    </li> --}}
                <li class="nav-item">
                    <a href="#education" class="nav-link" data-bs-toggle="tab">Riwayat Pendidikan</a>
                </li>
                <li class="nav-item">
                    <a href="#child" class="nav-link {{ request()->is('profile#child') ? 'active' : null }}"
                        data-bs-toggle="tab">Data Anak</a>
                </li>
                <li class="nav-item">
                    <a href="#training" class="nav-link" data-bs-toggle="tab">Data Diklat</a>
                </li>
            </ul>
            <hr>

            {{-- tab content --}}
            <div class="tab-content">
                <div class="tab-pane show active" id="profil_guru">
                    {{-- @dd($teacher->user_id); --}}
                    @if ($teacher->user_id == $id)
                        <a href="{{ route('guru.editTeacher', $teacher->id) }}" class="btn btn-success mb-3"><i
                                class="bi bi-pencil-square"></i>
                            edit data</a>
                    @endif
                    <table id="table" class="table table-striped align-middle" style="width: 100%">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>{{ $teacher->full_name }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>{{ $teacher->gender }}</td>
                            </tr>
                            <tr>
                                <td>Tempat & Tanggal Lahir</td>
                                <td>{{ $teacher->place_of_birth }}, {{ $teacher->date_of_birth }}</td>
                            </tr>

                            <tr>
                                <td>Alamat Rumah</td>
                                <td>{{ $teacher->address }} | rt {{ $teacher->rt }} / rw {{ $teacher->rw }} |
                                    {{ $teacher->village }} </td>
                            </tr>

                            <tr>
                                <td>Kecamatan</td>
                                <td>{{ $teacher->subdistrict }}</td>
                            </tr>
                            <tr>
                                <td>Kabupaten/Kota</td>
                                <td>{{ $teacher->city }}</td>
                            </tr>
                            <tr>
                                <td>Provinsi</td>
                                <td>{{ $teacher->province }}</td>
                            </tr>
                            <tr>
                                <td>Kode Pos</td>
                                <td>{{ $teacher->postal_code }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $teacher->email }}</td>
                            </tr>
                            <tr>
                                <td>No Hp</td>
                                <td>{{ $teacher->no_hp }}</td>
                            </tr>
                            {{-- </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="identitas_pribadi">
                        <table id="table" class="table table-striped align-middle" style="width: 100%">
                            <tbody> --}}
                            <tr>
                                <td>NIK</td>
                                <td>{{ $teacher->nik }}</td>
                            </tr>
                            <tr>
                                <td>NPWP</td>
                                <td>{{ $teacher->npwp }}</td>
                            </tr>
                            <tr>
                                <td>Status Pernikahan</td>
                                <td>{{ $teacher->marriage_status }}</td>
                            </tr>
                            <tr>
                                <td>Nama Suami/Istri </td>
                                <td>{{ $teacher->partner_name }}</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan Suami/Istri</td>
                                <td>{{ $teacher->partner_job }} </td>
                            </tr>
                            <tr>
                                <td>Jumlah Anak</td>
                                <td>{{ $teacher->children_number }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @include('teacher.education.index')
                @include('teacher.child.index')
                @include('teacher.training.index')

            </div>
        </div>
    @endif

@endsection

@push('css')
    <style>
        a.active {
            background: #198754 !important;
        }

        .nav-link {
            color: #198754
        }

        .nav-link:hover {
            color: #0d5433;
        }
    </style>
@endpush

@push('scripts')
    <script>
        //redirect to specific tab
        $(document).ready(function() {
            $('#myTab a[href="#{{ old('tab') }}"]').tab('show')
        });
    </script>
@endpush
