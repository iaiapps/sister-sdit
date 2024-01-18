@extends('landing.layouts.app')
@section('title', 'Landing Page')

@section('content')
    <div id="beranda" class="landingbackground pb-4 bg-green">
        <div class="container pb-4 px-3">
            <div class="mt-3 text-center ">
                <img src="img/logo.svg" class="landinglogo bg-white p-2 rounded" alt="logo" />
            </div>
            <div class="py-3 pt-md-4 text-center m-0">
                <h2 class="display-4 d-inline-block fw-bold text-white">
                    SISTER SDIT
                </h2>
                <div class="card p-3 my-3">
                    <p class="mb-0 fs-4 fw-light">
                        Sistem Informasi Terpadu SDIT Harapan Umat Jember </p>
                </div>
                <div class="row mt-3 pt-2">
                    <div class="col-md-6 col-12 mx-auto">
                        <a href="/login" class="btn btn-lg btn-warning mb-3 w-100">
                            LOGIN GURU/TENDIK
                        </a>
                    </div>
                    {{-- <div class="col-md-6 col-12 mx-auto">
                        <a href="/student-login" class="btn btn-lg btn-light mb-3 w-100">
                            LOGIN SISWA
                        </a>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
    <div id="menu" class="bg-light">
        <div class="container">
            <div class="py-5">
                <h2 class="text-center display-6 mb-3">MENU SISTER LAINNYA</h2>
                <div class="row">
                    <div class="col-12 col-md-3 p-3">
                        <div class="card shadow border-0 p-3 align-items-center text-center">
                            <img src="{{ asset('img/document.svg') }}" class="img-menu p-2 mb-2 bg-white rounded"
                                alt="dbapps" />
                            <h4>VERVAL IJAZAH</h4>
                            <p>Aplikasi verifikasi data Ijazah kelas 6 </p>
                            <a href="#" class="btn btn-success rounded mb-2 w-100">
                                VERVAL
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 p-3">
                        <div class="card shadow border-0 p-3 align-items-center text-center">
                            <img src="{{ asset('img/logofull.svg') }}" class="img-menu p-2 mb-2 bg-white rounded"
                                alt="dbapps" />
                            <h4>SISTER PRESENCE</h4>
                            <p>Aplikasi presensi SDIT Harum Jember </p>
                            <a href="{{ asset('apk/sisterPresence.apk') }}" class="btn btn-success rounded mb-2 w-100">
                                APK Guru
                            </a>
                            <a href="{{ asset('apk/sisterPresenceK.apk') }}" class="btn btn-success rounded mb-2 w-100">
                                APK Karyawan
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 p-3">
                        <div class="card shadow border-0 p-3 align-items-center text-center">
                            <img src="{{ asset('img/report.svg') }}" class="img-menu p-2 mb-2 bg-white rounded"
                                alt="dbapps" />
                            <h4>ANITA</h4>
                            <p>Aplikasi nilai Tahfidz SDIT Harum Jember</p>
                            <a href="#" class="btn btn-success rounded mb-2 w-100" download="">
                                ANITA
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 p-3">
                        <div class="card shadow border-0 p-3 align-items-center text-center">
                            <img src="{{ asset('img/soon.svg') }}" class="img-menu p-2 mb-2 bg-white rounded"
                                alt="dbapps" />
                            <h4>SOON</h4>
                            <p>Aplikasi yang akan datang</p>
                            <a href="#" class="btn btn-success rounded mb-2 w-100">
                                DB Apps
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
                <h2 class="text-center display-6 mb-3 text-white">
                    KONTAK DEVELOPER
                </h2>
                <p class="fs-5 text-white">
                    Jika ada kendala dan menemukan bug dalam penggunaan aplikasi, silahkan untuk kontak developer
                </p>
                <a href="https://wa.me/6285232213939" class="btn btn-warning mt-2 mb-4">Hubungi Kami</a>
            </div>
        </div>
    </div>
@endsection
