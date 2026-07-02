@extends('landing.layouts.app')
@section('title', 'Download Aplikasi')

@section('content')

    {{-- Hero Download --}}
    <section class="download-hero text-white pt-5 pb-0 mt-5">
        <div class="container text-center py-5">
            <img src="{{ asset('img/logo.svg') }}" class="app-icon-lg bg-white p-3 shadow mb-3" alt="SISTER SDIT">
            <h1 class="fw-bold fs-2 mb-1">Download SISTER SDIT</h1>
            <p class="opacity-75 mb-0">
                Aplikasi Android <span class="badge bg-warning text-dark">1.5.0</span> &middot;
                Android 13 (Tiramisu)+
            </p>
        </div>
    </section>

    {{-- Download Card --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-sm border-0 rounded-4 p-4 text-center">
                        <img src="{{ asset('img/logo.svg') }}"
                            class="download-icon-lg mx-auto mb-3 bg-success p-3 rounded-4" alt="SISTER SDIT">

                        <h3 class="fw-bold mb-1">SISTER SDIT</h3>
                        <p class="text-muted small mb-3">
                            v1.5.0 &middot; 5.4 MB &middot; APK
                        </p>

                        <a href="{{ asset('apk/sisterPresence.apk') }}"
                            class="btn btn-success btn-lg download-btn w-100 mb-3">
                            <i class="bi bi-google-play me-2"></i>Download APK (5.4 MB)
                        </a>

                        <hr>

                        <div class="section-header">
                            <h5 class="section-title fs-5">Yang Baru di v1.5.0</h5>
                        </div>
                        <div class="text-start changelog">
                            <div class="changelog-item">
                                <small class="fw-semibold">Aplikasi Unified</small>
                                <p class="small text-muted mb-0">
                                    Satu aplikasi untuk semua peran — login menentukan role secara otomatis.
                                </p>
                            </div>
                            <div class="changelog-item">
                                <small class="fw-semibold">Role-Aware</small>
                                <p class="small text-muted mb-0">
                                    Grup A (Guru/Tendik) dan Grup B (Karyawan/Kasir/Ibu Dapur) dengan fitur sesuai peran.
                                </p>
                            </div>
                            <div class="changelog-item">
                                <small class="fw-semibold">Presensi QR Code</small>
                                <p class="small text-muted mb-0">
                                    Scan QR presensi harian, riwayat tersimpan otomatis.
                                </p>
                            </div>
                            <div class="changelog-item">
                                <small class="fw-semibold">Mutabaah & BPI Mobile</small>
                                <p class="small text-muted mb-0">
                                    Isi mutabaah bulanan dan monitoring BPI langsung dari smartphone.
                                </p>
                            </div>
                        </div>

                        <hr>

                        <h5 class="fw-bold text-green">Persyaratan Sistem</h5>
                        <ul class="list-unstyled small text-muted text-start">
                            <li><i class="bi bi-android2 me-2 text-success"></i>Android 13.0+ (Tiramisu) atau lebih baru
                            </li>
                            <li><i class="bi bi-wifi me-2 text-success"></i>Koneksi internet untuk presensi dan sinkronisasi
                            </li>
                            <li><i class="bi bi-geo-alt me-2 text-success"></i>GPS/Lokasi harus aktif untuk presensi</li>
                            <li><i class="bi bi-camera me-2 text-success"></i>Izin kamera untuk scan QR code</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
