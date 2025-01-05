@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'List Mengisi Mutabaah')
@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ route('mutabaah.index') }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
        </div>
        <p class="text-center fs-5 mb-0">Data Guru yang sudah mengisi,
            <strong>{{ $name_mutabaah }}</strong>
        </p>
        <hr>
        <div class="table-responsive">
            <table class="table align-middle table-striped table-sm border border-dark" id="table">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama Guru</th>
                        <th>Capaian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $answer)
                        @php
                            $role = $answer->teacher->user->getRoleNames()->first();
                        @endphp
                        <tr>
                            <td class="text-center">{{ $answer->teacher->id }}</td>
                            <td>{{ $answer->teacher->full_name }} <br>
                                Pengisian tanggal: {{ $carbon::parse($answer->tanggal)->isoFormat('DD MMMM Y') }}
                                <br>
                                <a href="{{ route('mutabaah.show', ['t_id' => $answer->teacher->id, 'm_id' => request()->get('id')]) }}"
                                    class="btn btn-success btn-sm mt-1"><i class="bi bi-info-circle-square"></i> detail
                                    jawaban
                                </a>
                            </td>
                            <td>
                                <table class="table my-0 table-sm" id="table2">
                                    @foreach ($categories as $cat)
                                        <tr>
                                            @if ($role == 'guru')
                                                <td> <small>
                                                        Kategori: {{ $cat->nama_kategori }},
                                                    </small>
                                                </td>
                                                <td>
                                                    <small> Capaian:
                                                        {{ $answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point') .'/' .$cat->question->sum('max_point') .' x 100% ' .'=' }}
                                                        {{ number_format((float) ($answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point') / $cat->question->sum('max_point')) * 100,2,'.','') }}%
                                                    </small>
                                                </td>
                                            @elseif ($role == 'tendik')
                                                @if ($answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point'))
                                                    <td> <small>
                                                            Kategori: {{ $cat->nama_kategori }},
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <small> Capaian:
                                                            {{ $answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point') .'/' .$cat->question->where('question_for', 'all')->sum('max_point') .' x 100% ' .'=' }}
                                                            {{ number_format((float) ($answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point') / $cat->question->where('question_for', 'all')->sum('max_point')) * 100,2,'.','') }}%
                                                        </small>
                                                    </td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@include('layouts.partials.allscripts')

@push('css')
    <style>
        #table2 td {
            padding: 0px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: false
            });
        });
    </script>
@endpush
