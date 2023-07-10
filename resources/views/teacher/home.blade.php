@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')

    {{-- @dd(Auth::user()->role->name) --}}
    @if ($teacher->gender == null)
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <span class="m-0">Identitas anda belum lengkap!</span>
            <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-dark btn-sm">clik
                untuk mengisi</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card rounded p-3 mb-3">
        <p class="fs-4 text-center m-0">
            Selamat Datang di Aplikasi Sister SDIT Harum
        </p>
    </div>

    <div class="container text-center mb-3">
        <div class="row">
            <div class="col-6 col-md-3 bg-primary p-3">
                <a href="" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-person fs-2"></i>
                    <span class="d-block">Profil</span>
                </a>
            </div>
            <div class="col-6 col-md-3 bg-light p-3">
                <a href="" class="nav-link btn btn-outline text-dark">
                    <i class="bi bi-card-image fs-2"></i>
                    <span class="d-block">Dokumen</span>
                </a>
            </div>
            <div class="col-6 col-md-3 bg-danger p-3">
                <a href="" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-calendar-check fs-2"></i>
                    <span class="d-block">Presensi</span>
                </a>
            </div>
            <div class="col-6 col-md-3 bg-warning p-3">
                <a href="" class="nav-link btn btn-outline text-white ">
                    <i class="bi bi-coin fs-2"></i>
                    <span class="d-block">Gaji</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded container">
        <p class="fs-4 text-center pt-3">Profil Pengguna</p>
        <hr>
        <div class="row">
            <div class="col-12 col-md-4 p-3 ">
                <div class="text-center align-items-center">
                    <i class="bi bi-person-circle display-2"></i>
                    {{-- <img src="/img/logo.svg" class="profiluser mb-3" alt="profil"> --}}
                    <p class="fs-5 mt-3">{{ $teacher->full_name }}</p>
                    <div class="btn-group">
                        {{-- <a href="{{ route('profile.index') }}" class="btn btn-sm btn-success">detail</a> --}}
                        <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-sm btn-outline-success">edit</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-12 p-3">
                <div class="table-responsive">
                    <table id="table" class="table table-striped align-middle">
                        <tbody>
                            <tr>
                                <td class="widtht">Jabatan</td>
                                <td>{{ $teacher->salary_basic->nama_jabatan }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Handphone</td>
                                <td>{{ $teacher->no_hp }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $teacher->email }}</td>
                            </tr>
                            <tr>
                                <td>Pendidikan Terakhir</td>
                                <td>{{ $teacher->last_education }}</td>
                            </tr>
                            <tr>
                                <td>Masuk SDIT sejak</td>
                                <td>{{ $teacher->month_enter }} {{ $teacher->year_enter }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .widtht {
            width: 170px;
        }
    </style>
@endpush
