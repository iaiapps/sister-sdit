@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'List Mengisi Mutabaah')
@section('content')
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('mutabaah.index') }}" class="btn btn-success">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
            <h5 class="mb-0 text-center flex-grow-1">Data Guru yang sudah mengisi<br>
                <small class="text-muted">{{ $name_mutabaah }}</small>
            </h5>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-hover table-sm" id="table">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama Guru</th>
                        <th>Jabatan</th>
                        <th>Tanggal</th>
                        <!-- Kolom untuk setiap kategori -->
                        @foreach ($categories as $category)
                            <th class="text-center">{{ $category->nama_kategori }}</th>
                        @endforeach
                        <th class="text-center">Rata-rata</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $index => $answer)
                        @php
                            $role = $answer->teacher->user->getRoleNames()->first();
                            $capaian_data = [];
                            $total_persentase = 0;
                            $kategori_count = 0;

                            foreach ($categories as $category) {
                                if ($role == 'guru') {
                                    $total_point = $answer_all
                                        ->where('category_id', $category->id)
                                        ->where('teacher_id', $answer->teacher->id)
                                        ->sum('point');
                                    $max_point = $category->question->sum('max_point');
                                    $percentage = $max_point > 0 ? ($total_point / $max_point) * 100 : 0;
                                } else {
                                    $total_point = $answer_all
                                        ->where('category_id', $category->id)
                                        ->where('teacher_id', $answer->teacher->id)
                                        ->sum('point');
                                    $max_point = $category->question->where('question_for', 'all')->sum('max_point');
                                    $percentage = $max_point > 0 ? ($total_point / $max_point) * 100 : 0;
                                }

                                $capaian_data[$category->id] = [
                                    'point' => $total_point,
                                    'max_point' => $max_point,
                                    'percentage' => $percentage,
                                    // Format untuk export
                                    'export_text' =>
                                        number_format($percentage, 1) . '% (' . $total_point . '/' . $max_point . ')',
                                ];

                                if ($total_point > 0 || $role == 'guru') {
                                    $total_persentase += $percentage;
                                    $kategori_count++;
                                }
                            }

                            $rata_rata = $kategori_count > 0 ? $total_persentase / $kategori_count : 0;
                        @endphp

                        <tr data-teacher-id="{{ $answer->teacher->id }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $answer->teacher->full_name }}</td>
                            <td>{{ $role == 'guru' ? 'Guru' : 'Tendik' }}</td>
                            <td>{{ $carbon::parse($answer->tanggal)->isoFormat('DD/MM/YY') }}</td>

                            @foreach ($categories as $category)
                                @php
                                    $capaian = $capaian_data[$category->id] ?? null;
                                @endphp
                                <td class="text-center" data-export="{{ $capaian['export_text'] ?? '0% (0/0)' }}">
                                    @if ($capaian && ($capaian['point'] > 0 || $role == 'guru'))
                                        <div class="capaian-display">
                                            <span class="fw-bold">{{ number_format($capaian['percentage'], 1) }}%</span>
                                            <br>
                                            <small
                                                class="text-muted">({{ $capaian['point'] }}/{{ $capaian['max_point'] }})</small>
                                        </div>
                                    @else
                                        <div class="capaian-display">
                                            <span class="fw-bold">0%</span>
                                            <br>
                                            <small class="text-muted">(0/0)</small>
                                        </div>
                                    @endif
                                </td>
                            @endforeach

                            <td class="text-center fw-bold" data-export="{{ number_format($rata_rata, 1) }}%">
                                {{ number_format($rata_rata, 1) }}%
                            </td>

                            <td class="text-center">
                                <a href="{{ route('mutabaah.show', ['t_id' => $answer->teacher->id, 'm_id' => request()->get('id')]) }}"
                                    class="btn btn-outline-success btn-sm" title="Detail Jawaban">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.datatables.net/v/bs5/dt-2.3.5/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.5/css/buttons.bootstrap5.min.css">
    <style>
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table th {
            background-color: #343a40;
            color: white;
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.5rem;
        }

        .table td {
            vertical-align: middle;
            padding: 0.5rem;
            font-size: 0.82rem;
        }

        .capaian-display {
            line-height: 1.2;
        }

        .capaian-display .fw-bold {
            font-size: 0.85rem;
        }

        .capaian-display .text-muted {
            font-size: 0.75rem;
        }

        /* Lebar kolom yang optimal */
        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 5%;
            min-width: 50px;
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 20%;
            min-width: 150px;
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 8%;
            min-width: 80px;
        }

        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 10%;
            min-width: 90px;
        }

        /* Kolom kategori */
        .table th:nth-child(n+5):not(:last-child),
        .table td:nth-child(n+5):not(:last-child) {
            width: 9%;
            min-width: 85px;
            max-width: 100px;
        }

        /* Kolom rata-rata */
        .table th:nth-last-child(2),
        .table td:nth-last-child(2) {
            width: 8%;
            min-width: 70px;
        }

        /* Kolom aksi */
        .table th:last-child,
        .table td:last-child {
            width: 7%;
            min-width: 60px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/v/bs5/dt-2.3.5/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.5/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.5/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    className: 'btn btn-success',
                    text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                    title: 'Data Mutabaah - {{ $name_mutabaah }}',
                    filename: 'Data_Mutabaah',
                    exportOptions: {
                        columns: ':not(:last-child)',
                        format: {
                            body: function(data, row, column, node) {
                                // Gunakan data-export attribute untuk kolom capaian
                                if (column >= 4) {
                                    return $(node).data('export') || $(node).text().replace(
                                        /\s+/g, ' ').trim();
                                }
                                return data;
                            }
                        }
                    }
                }],
                paging: false,
                pageLength: 10,
                scrollX: true
            });
        });
    </script>
@endpush
