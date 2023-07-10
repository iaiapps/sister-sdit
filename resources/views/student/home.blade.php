@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')

    @if ($student->full_name == 'student')
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <p class="m-0">Identitas anda belum lengkap! <a href="/student/{{ $student->id }}/edit"
                    class="btn btn-dark btn-sm">clik
                    untuk mengisi</a></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card rounded p-3 mb-3">
        <p class="fs-3 text-center m-0">
            Selamat Datang di Aplikasi Sister SDIT Harum
        </p>
    </div>
    <div class="bg-white rounded">
        <div class="col-12 col-md-4 float-start p-3 ">
            <div class="p-3 text-center align-items-center border-end">
                <img src="/img/logo.svg" class="profiluser mb-3" alt="profil">
                <p class="fs-5 mb-1">{{ $student->full_name }}</p>
                <p>no pegawai</p>
                <div class="btn-group">
                    {{-- <button>edit foto</button> --}}
                    <button class="btn btn-outline-success">edit profil</button>
                </div>
            </div>

        </div>

        <div class="">
            <div class="col-12 col-md-8 card p-3">
                <div class="table-responsive">
                    <table id="table" class="table table-striped align-middle" style="width: 100%">

                        <tbody>
                            <tr>
                                <td>NIS</td>
                                <td>{{ $student->nis }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>{{ $student->nis }}</td>
                            </tr>
                            <tr>
                                <td>Alamat Rumah</td>
                                <td>{{ $student->address }} | rt {{ $student->rt }} / rw {{ $student->rw }} |
                                    {{ $student->village }} | {{ $student->subdistrict }} |
                                    {{ $student->city }} | {{ $student->province }} | {{ $student->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
