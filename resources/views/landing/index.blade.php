@extends('landing.layouts.app')
@section('title', 'Landing Page')

@section('content')
    <div id="beranda" class="landingbackground pb-3 bg-green">
        <div class="container px-3">
            <div class="text-center mb-3">
                <img src="img/logo.svg" class="landinglogo bg-white p-2 rounded" alt="logo" />
            </div>
            <div class="py-3 pt-md-4 text-center m-0">
                <h2 class="display-6 d-inline-block fw-bold text-white">
                    PUSDATIN GURU SDIT
                </h2>
                <div class="row mt-3">
                    <div class="col-md-8 col-12 mx-auto">
                        <div class="card p-2 my-3 mb-4">
                            <p class="mb-0 fs-4 fw-light">
                                Pusat Data dan Informasi Guru SDIT Harapan Umat Jember </p>
                        </div>

                        <a href="/login" class="btn btn-lg btn-warning mb-3 w-100">
                            Login
                        </a>
                    </div>
                </div>
                <div>
                    <a href="#menu" class="d-inline-block btn btn-outline-light fs-1 border border-0"><i
                            class="bi bi-arrow-down-circle "></i></a>
                </div>
            </div>
        </div>
    </div>
    <div id="menu" class="bg-light">
        <div class="container">
            <div class="py-5">
                <h2 class="text-center fs-3 mb-3">DOWNLOAD APLIKASI</h2>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-4 p-3">
                        <div class="card shadow border-0 p-3 align-items-center text-center">
                            <img src="{{ asset('img/logofull.svg') }}" class="img-menu p-2 mb-2 bg-white rounded"
                                alt="dbapps" />
                            <h4>Untuk Guru </h4>
                            <p>Aplikasi presensi SDIT Harum Jember </p>
                            <a href="{{ asset('apk/sisterPresence.apk') }}"
                                class="position-relative btn btn-success rounded mb-2 w-100">
                                APK Guru
                                <span class="badge rounded bg-danger">
                                    new ver. 1.3.0
                                </span>
                            </a>

                        </div>
                    </div>
                    <div class="col-12 col-md-4 p-3">
                        <div class="card shadow border-0 p-3 align-items-center text-center">
                            <img src="{{ asset('img/logofull.svg') }}" class="img-menu p-2 mb-2 bg-white rounded"
                                alt="dbapps" />
                            <h4>Untuk Karyawan</h4>
                            <p>Aplikasi presensi SDIT Harum Jember </p>
                            <a href="{{ asset('apk/sisterPresenceK.apk') }}" class="btn btn-success rounded mb-2 w-100">
                                APK Karyawan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kontak" class="bg-success">
        <div class="container">
            <div class="py-5 text-center">
                <h2 class="text-center fs-3 mb-3 text-white">
                    KONTAK DEVELOPER
                </h2>
                <p class="fs-6 text-white">
                    Jika ada kendala dan menemukan bug dalam penggunaan aplikasi, silahkan untuk kontak developer
                </p>
                <a href="https://wa.me/6285232213939" class="btn btn-warning mt-2 mb-2">Hubungi Kami</a>
            </div>
        </div>
    </div>
@endsection
