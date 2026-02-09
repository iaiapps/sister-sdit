@extends('layouts.appmobile')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Penggantian Guru')
@section('content')
    @if (session('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <p class="m-0">{{ session('msg') }} </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter Toggle Button --}}
    <div class="card p-3 mb-3">
        <div class="d-inline-block">
            <div class="bg-white d-flex justify-content-between align-items-center mb-2">
                <div>
                    <p class="m-0"><strong>{{ $tid->full_name }}</strong></p>
                    <p class="m-0 text-muted" style="font-size: 0.85rem;">
                        Semester {{ ucfirst($semester) }} {{ $tahunAkademik }}
                    </p>
                </div>
                <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="collapse"
                    data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>

            {{-- Collapsible Filter Form --}}
            <div class="collapse mb-3" id="filterCollapse">
                <div class="card card-body p-2">
                    <form action="{{ route('pengganti-mobile.index') }}" method="GET">
                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <select name="tahun_akademik" id="tahun_akademik" class="form-select form-select-sm">
                                    <option value="2023-2024" {{ $tahunAkademik == '2023-2024' ? 'selected' : '' }}>
                                        2023-2024
                                    </option>
                                    <option value="2024-2025" {{ $tahunAkademik == '2024-2025' ? 'selected' : '' }}>
                                        2024-2025
                                    </option>
                                    <option value="2025-2026" {{ $tahunAkademik == '2025-2026' ? 'selected' : '' }}>
                                        2025-2026
                                    </option>
                                    <option value="2026-2027" {{ $tahunAkademik == '2026-2027' ? 'selected' : '' }}>
                                        2026-2027
                                    </option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="semester" id="semester" class="form-select form-select-sm">
                                    <option value="ganjil" {{ $semester == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                                    <option value="genap" {{ $semester == 'genap' ? 'selected' : '' }}>Genap</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <button type="submit" class="btn btn-success btn-sm w-100">Terapkan</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary btn-sm w-100" data-bs-toggle="collapse"
                                    data-bs-target="#filterCollapse">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <hr>
            {{-- Info Periode --}}
            <div class="text-center mb-2">
                <p class="m-0 text-muted" style="font-size: 0.8rem;">
                    {{ $carbon::parse($awal)->isoFormat('DD/MM/YY') }} -
                    {{ $carbon::parse($akhir)->isoFormat('DD/MM/YY') }}
                </p>
            </div>

            <a class="btn btn-success btn-sm w-100" href="{{ route('pengganti-mobile.create') }}">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>
    </div>
    {{-- Card-Based Data List --}}
    @if ($replacements->count() > 0)
        @foreach ($replacements->sortByDesc('tanggal') as $replacement)
            <div class="card mb-3 shadow-sm">
                <div class="card-body p-2">
                    {{-- Header: Tanggal & Mapel + Edit --}}
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <small class="text-muted">
                            <i class="bi bi-calendar3"></i>
                            {{ $carbon::parse($replacement->tanggal)->isoFormat('dddd, DD MMM YYYY') }}
                        </small>
                        <div class="d-flex align-items-center gap-1">
                            <span class="badge bg-primary p-2" style="font-size: 0.85rem;">{{ $replacement->mapel }}</span>
                            <a href="{{ route('pengganti-mobile.edit', $replacement->id) }}"
                                class="btn btn-warning btn-sm py-1" style="font-size: 0.85rem;"> <i
                                    class="bi bi-pencil-square"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Nama Guru & Jam --}}
                    <div class="mb-2">
                        <small>menggantikan</small> <br>
                        <strong style="font-size: 0.95rem;">{{ $replacement->menggantikan }}</strong>
                        <div class="text-muted" style="font-size: 0.8rem;"> pada jam
                            {{ $replacement->jp }}
                        </div>
                    </div>

                    {{-- Collapse Detail --}}
                    <div class="collapse" id="detail{{ $replacement->id }}">
                        <hr class="my-2">
                        <div style="font-size: 0.85rem;">
                            <div class="mb-1">
                                <span class="text-muted">Alasan:</span>
                                <span class="badge bg-secondary"
                                    style="font-size: 0.75rem;">{{ $replacement->alasan }}</span>
                            </div>
                            <div class="mb-1">
                                <span class="text-muted">Tugas:</span> {{ $replacement->bahan }}
                            </div>
                            <div>
                                <span class="text-muted">Kegiatan:</span><br>
                                <span class="fst-italic">{{ $replacement->diisi_dengan }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Toggle Button --}}
                    <div class="text-center mt-2">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse"
                            data-bs-target="#detail{{ $replacement->id }}" aria-expanded="false"
                            aria-controls="detail{{ $replacement->id }}"
                            style="font-size: 0.75rem; padding: 0.15rem 0.5rem;" onclick="toggleButtonText(this)">
                            <i class="bi bi-chevron-down"></i> Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-4 text-muted">
            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
            <p class="mt-2">Tidak ada data penggantian</p>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        function toggleButtonText(button) {
            const isExpanded = button.getAttribute('aria-expanded') === 'true';
            if (isExpanded) {
                button.innerHTML = '<i class="bi bi-chevron-up"></i> Tutup Detail';
            } else {
                button.innerHTML = '<i class="bi bi-chevron-down"></i> Lihat Detail';
            }
        }

        // Update button text on collapse events
        document.addEventListener('DOMContentLoaded', function() {
            const collapseElements = document.querySelectorAll('.collapse');
            collapseElements.forEach(function(collapseEl) {
                collapseEl.addEventListener('shown.bs.collapse', function() {
                    const button = document.querySelector('[data-bs-target="#' + this.id + '"]');
                    if (button) {
                        button.innerHTML = '<i class="bi bi-chevron-up"></i> Tutup Detail';
                    }
                });
                collapseEl.addEventListener('hidden.bs.collapse', function() {
                    const button = document.querySelector('[data-bs-target="#' + this.id + '"]');
                    if (button) {
                        button.innerHTML = '<i class="bi bi-chevron-down"></i> Lihat Detail';
                    }
                });
            });
        });
    </script>
@endpush
