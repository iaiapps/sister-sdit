@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Data Guru Pengganti')
@section('content')
    <div class="card p-3">
        <form action="{{ route('replacement.index') }}" method="GET">
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="{{ route('replacement.create') }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-plus-circle"></i> Data Pengganti
                </a>
            </div>
            <div>
                <a href="{{ route('replacement.export', ['tahun_akademik' => $tahunAkademik, 'semester' => $semester]) }}" 
                   class="btn btn-success btn-sm">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Pengganti</th>
                        <th scope="col">Menggantikan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Mapel</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Tugas</th>
                        <th scope="col">Diisi dengan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($replacements->sortByDesc('created_at') as $replacement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $replacement->teacher->full_name }}</td>
                            <td>{{ $replacement->menggantikan }}</td>
                            <td>{{ $carbon::parse($replacement->tanggal)->isoFormat('DD/MM/YYYY') }}</td>
                            <td>{{ $replacement->jp }}</td>
                            <td>{{ $replacement->mapel }}</td>
                            <td>{{ $replacement->alasan }}</td>
                            <td>{{ $replacement->bahan }}</td>
                            <td>{{ $replacement->diisi_dengan }}</td>
                            <td>
                                <a href="{{ route('replacement.edit', $replacement->id) }}"
                                    class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>
                                </a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="{{ route('replacement.destroy', $replacement->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
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
