@extends('layouts.app')

@section('title', 'Biodata Siswa')
@section('content')

    @if ($student->full_name == 'student')
        <div class="bg-white rounded p-3 text-center">
            <h4 class="fw-light mb-4">
                Identitas anda tidak lengkap, mohon isi terlebih dahulu
            </h4>
            <a href="{{ route('student.edit', $student->id) }}" class="btn btn-success">isi identitas</a>
        </div>
    @else
        <div class="card">
            <div class="m-4">
                {{-- tab menu --}}
                <ul class="nav nav-pills mb-3" id="myTab">
                    <li class="nav-item">
                        <a href="#profil_siswa"
                            class="nav-link active {{ request()->is('profile#profil_siswa') ? 'active' : null }}"
                            data-bs-toggle="tab">Profil
                            Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a href="#parent" class="nav-link {{ request()->is('profile#parent') ? 'active' : null }}"
                            data-bs-toggle="tab">Identitas Orang Tua</a>
                    </li>
                </ul>
                <hr>

                {{-- tab content --}}
                <div class="tab-content">
                    <div class="tab-pane show active" id="profil_siswa">
                        {{-- @dd($student->user_id) --}}
                        @if ($student->user_id == $id)
                            <a href="{{ route('student.edit', $student->id) }}" class="btn btn-success mb-3"><i
                                    class="bi bi-pencil-square"></i>
                                edit data</a>
                        @endif
                        <table id="table" class="table table-striped align-middle" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td>NIS</td>
                                    <td>{{ $student->nis }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $student->full_name }}</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>{{ $student->nik }}</td>
                                </tr>
                                <tr>
                                    <td>No. KK</td>
                                    <td>{{ $student->kk }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>{{ $student->gender }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat & Tanggal Lahir</td>
                                    <td>{{ $student->place_of_birth }}, {{ $student->date_of_birth }}</td>
                                </tr>

                                <tr>
                                    <td>Alamat Rumah</td>
                                    <td>{{ $student->address }} | rt {{ $student->rt }} / rw {{ $student->rw }} |
                                        {{ $student->village }} | {{ $student->subdistrict }} |
                                        {{ $student->city }} | {{ $student->province }} | {{ $student->address }}</td>
                                </tr>
                                <tr>
                                    <td>Kode Pos</td>
                                    <td>{{ $student->postal_code }}</td>
                                </tr>

                                <tr>
                                    <td>Tinggal Bersama</td>
                                    <td>{{ $student->jenis_tinggal }}</td>
                                </tr>
                                <tr>
                                    <td>Alat Transportasi</td>
                                    <td>{{ $student->alat_transportasi }}</td>
                                </tr>
                                <tr>
                                    <td>Anak ke</td>
                                    <td>{{ $student->anak_ke }}</td>
                                </tr>
                                <tr>
                                    <td>Jumalah Saudara</td>
                                    <td>{{ $student->jumlah_saudara }} </td>
                                </tr>
                                <tr>
                                    <td>Jarak Rumah Ke Sekolah </td>
                                    <td>{{ $student->jarak_ke_sekolah }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @include('student.parent.index')
                </div>
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
