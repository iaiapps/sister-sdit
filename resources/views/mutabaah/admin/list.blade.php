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
            <table class="table align-middle table-sm" id="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Guru</th>
                        <th>Tanggal Pengisian</th>
                        <th>Capaian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $answer)
                        @php
                            $role = $answer->teacher->user->getRoleNames()->first();
                        @endphp
                        <tr>
                            <td>{{ $answer->teacher->id }}</td>
                            <td>{{ $answer->teacher->full_name }}</td>
                            <td>{{ $carbon::parse($answer->tanggal)->isoFormat('DD MMMM Y') }}</td>
                            <td>
                                <table class="table mb-0 table-sm" id="table2">
                                    @foreach ($categories as $cat)
                                        <tr>
                                            <td>
                                                @if ($role == 'guru')
                                                    <small>
                                                        {{ $cat->nama_kategori }},
                                                    </small>
                                                    <br>
                                                    <small> capaian =
                                                        {{ $answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point') .'/' .$cat->question->sum('max_point') .'x 100%' }}
                                                        =
                                                        {{ number_format((float) ($answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point') / $cat->question->sum('max_point')) * 100,2,'.','') }}%
                                                    </small>
                                                @elseif ($role == 'tendik')
                                                    @if ($answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point'))
                                                        <small>
                                                            {{ $cat->nama_kategori }},
                                                        </small>
                                                        <br>
                                                        <small> capaian =
                                                            {{ $answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point') .'/' .$cat->question->where('question_for', 'all')->sum('max_point') .'x 100%' }}
                                                            =
                                                            {{ number_format((float) ($answer_all->where('category_id', $cat->id)->where('teacher_id', $answer->teacher->id)->sum('point') / $cat->question->where('question_for', 'all')->sum('max_point')) * 100,2,'.','') }}%
                                                        </small>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td>
                                <a href="{{ route('mutabaah.show', ['t_id' => $answer->teacher->id, 'm_id' => request()->get('id')]) }}"
                                    class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i> info
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
