@extends('landing.layouts.app')
@section('title', 'Beranda')

@section('content')

    {{-- ============ HERO ============ --}}
    <section class="hero" id="beranda">
        <div class="container position-relative">
            <div class="row align-items-center py-4 py-md-5">
                <div class="col-lg-6 text-center text-lg-start text-white py-4 py-md-5">
                    <img src="{{ asset('img/logo.svg') }}" class="hero-logo bg-white p-3 rounded-4 mb-4 shadow"
                        alt="SISTER SDIT">

                    <h1 class="hero-title fw-bold mb-3">
                        SISTER <span class="fw-light">SDIT</span>
                    </h1>

                    <p class="hero-sub mb-4">
                        Satu aplikasi untuk presensi digital, mutabaah bulanan,
                        Bina Pribadi Islami, dan manajemen guru pengganti.
                        Semua dalam satu aplikasi terpadu.
                    </p>

                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                        <a href="{{ url('/#download') }}" class="btn btn-warning btn-lg px-4 fw-semibold rounded-pill">
                            <i class="bi bi-download me-2"></i>Download Aplikasi
                        </a>
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-lg px-4 fw-semibold rounded-pill">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login Web
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/illustration.svg') }}" alt="Ilustrasi" class="hero-illustration img-fluid">
                </div>
            </div>
            <br>
            <div class="text-center pb-4 position-absolute bottom-0 start-50 translate-middle-x">
                <a href="#fitur" class="text-white fs-2">
                    <i class="bi bi-chevron-down"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ============ FITUR ============ --}}
    <section class="py-5 bg-white" id="fitur">
        <div class="container py-4">
            <div class="section-header">
                <h2 class="section-title">Mengapa SISTER SDIT?</h2>
                <p class="section-sub">Empat fitur utama untuk mendukung aktivitas guru dan tenaga kependidikan</p>
            </div>

            <div class="row g-3 g-md-4">
                {{-- Presensi --}}
                <div class="col-6 col-lg-3">
                    <div class="card feature-card shadow-sm h-100 text-center">
                        <div class="feature-icon-wrapper mx-auto mb-2 mb-md-3">
                            <img src="{{ asset('img/report.svg') }}" class="feature-icon" alt="Presensi">
                        </div>
                        <h5 class="feature-card-title fw-bold text-green">Presensi Digital</h5>
                        <p class="feature-card-text mb-0">
                            Scan QR code presensi harian. Riwayat otomatis tersimpan.
                        </p>
                    </div>
                </div>

                {{-- Mutabaah --}}
                <div class="col-6 col-lg-3">
                    <div class="card feature-card shadow-sm h-100 text-center">
                        <div class="feature-icon-wrapper mx-auto mb-2 mb-md-3">
                            <img src="{{ asset('img/book.png') }}" class="feature-icon" alt="Mutabaah">
                        </div>
                        <h5 class="feature-card-title fw-bold text-green">Mutabaah Bulanan</h5>
                        <p class="feature-card-text mb-0">
                            Evaluasi ibadah harian. Isi jawaban dan pantau progres.
                        </p>
                    </div>
                </div>

                {{-- BPI --}}
                <div class="col-6 col-lg-3">
                    <div class="card feature-card shadow-sm h-100 text-center">
                        <div class="feature-icon-wrapper mx-auto mb-2 mb-md-3">
                            <img src="{{ asset('img/database.svg') }}" class="feature-icon" alt="BPI">
                        </div>
                        <h5 class="feature-card-title fw-bold text-green">Bina Pribadi Islami</h5>
                        <p class="feature-card-text mb-0">
                            Monitoring BPI siswa tiap bulan. Pantau kehadiran pribadi.
                        </p>
                    </div>
                </div>

                {{-- Guru Pengganti --}}
                <div class="col-6 col-lg-3">
                    <div class="card feature-card shadow-sm h-100 text-center">
                        <div class="feature-icon-wrapper mx-auto mb-2 mb-md-3">
                            <img src="{{ asset('img/document.svg') }}" class="feature-icon" alt="Pengganti">
                        </div>
                        <h5 class="feature-card-title fw-bold text-green">Guru Pengganti</h5>
                        <p class="feature-card-text mb-0">
                            Manajemen jadwal guru pengganti. Sebagai catatan menggantikan guru.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ DOWNLOAD ============ --}}
    <section class="py-5 bg-green-soft" id="download">
        <div class="container py-4">
            <div class="section-header">
                <h2 class="section-title">Download Aplikasi</h2>
                <p class="section-sub">Satu aplikasi untuk semua peran — Guru, Tendik, Karyawan, Kasir, dan Ibu Dapur</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card download-card shadow text-center p-5">
                        <img src="{{ asset('img/logo.svg') }}"
                            class="download-icon-lg mx-auto mb-3 bg-success p-3 rounded-4" alt="SISTER SDIT">
                        <h4 class="fw-bold">SISTER SDIT</h4>
                        <br>
                        <p class="text-muted small mb-2">
                            Aplikasi Android <span class="badge bg-warning text-dark">1.5.0</span> &middot;
                            Android 13+ (Tiramisu) &middot; 5.4 MB
                        </p>
                        <p class="small text-muted mb-3">
                            Login dengan akun Email & Password yang sudah terdaftar. <br>
                            Role (Guru, Karyawan, dll) otomatis terdeteksi.
                        </p>
                        <a href="{{ asset('apk/sisterPresence.apk') }}" class="btn btn-success download-btn w-100 mb-2">
                            <i class="bi bi-google-play me-2"></i>Download APK v1.5.0
                        </a>
                        <small class="text-muted">
                            <i class="bi bi-shield-check me-1"></i>Aplikasi internal SDIT Harapan Umat Jember
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ KONTAK ============ --}}
    <section class="py-5 bg-success" id="kontak">
        <div class="container py-4">
            <div class="section-header">
                <h2 class="section-title text-white">Hubungi Kami</h2>
                <p class="section-sub text-white opacity-75">Ada kendala atau masukan? Tim kami siap membantu</p>
            </div>

            <div class="card contact-card shadow-sm border-0 p-4">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <h5 class="fw-bold text-green mb-2">Butuh Bantuan?</h5>
                        <p class="small text-muted mb-0">
                            Laporkan bug, ajukan fitur, atau konsultasi seputar aplikasi
                            melalui WhatsApp resmi kami.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                        <a href="https://wa.me/6285232213939" class="btn btn-success btn-lg rounded-pill px-4 fs-6"
                            target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp me-2"></i>Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
