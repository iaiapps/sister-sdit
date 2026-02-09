@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Penggantian Guru')
@section('content')
    <div class="card p-3">
        <form action="{{ route('guru.replacement.list') }}" method="GET">
            <div class="row">
                <div class="col-md-4 my-1">
                    <select name="tahun_akademik" id="tahun_akademik" class="form-select">
                        <option value="2023-2024" {{ $tahunAkademik == '2023-2024' ? 'selected' : '' }}>2023-2024</option>
                        <option value="2024-2025" {{ $tahunAkademik == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                        <option value="2025-2026" {{ $tahunAkademik == '2025-2026' ? 'selected' : '' }}>2025-2026</option>
                        <option value="2026-2027" {{ $tahunAkademik == '2026-2027' ? 'selected' : '' }}>2026-2027</option>
                    </select>
                </div>
                <div class="col-md-4 my-1">
                    <select name="semester" id="semester" class="form-select">
                        <option value="ganjil" {{ $semester == 'ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                        <option value="genap" {{ $semester == 'genap' ? 'selected' : '' }}>Semester Genap</option>
                    </select>
                </div>
                <div class="col-md-4 my-1">
                    <button type="submit" class="btn btn-success w-100">Filter Data</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="text-center mb-3">
            <p class="m-0 fs-5">
                <strong>Semester {{ ucfirst($semester) }} Tahun Akademik {{ $tahunAkademik }}</strong>
            </p>
            <p class="m-0 text-muted">
                <small>{{ $carbon::parse($awal)->isoFormat('DD MMMM YYYY') }} - {{ $carbon::parse($akhir)->isoFormat('DD MMMM YYYY') }}</small>
            </p>
        </div>
        <div class="d-inline-block">
            <a class="btn btn-success btn-sm mb-3" href="{{ route('guru.replacement.create') }}">Tambah data menggantikan
                guru lain</a>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Guru Yang Digantikan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jumlah JP</th>
                        <th scope="col">Mapel Yang Digantikan</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Guru Mapel Meninggalkan</th>
                        <th scope="col">Diisi dengan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($replacements as $replacement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $replacement->menggantikan }}</td>
                            <td>{{ $carbon::parse($replacement->tanggal)->isoFormat('DD/MM/YYYY') }}</td>
                            <td>{{ $replacement->jp }}</td>
                            <td>{{ $replacement->mapel }}</td>
                            <td>{{ $replacement->alasan }}</td>
                            <td>{{ $replacement->bahan }}</td>
                            <td>{{ $replacement->diisi_dengan }}</td>
                            <td>
                                <a href="{{ route('guru.replacement.edit', $replacement->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@include('layouts.partials.allscripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: true,
                pageLength: 50
            });
        });
    </script>
@endpush
