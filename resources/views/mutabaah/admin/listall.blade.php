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
            <table class="table align-middle table-bordered table-sm border-dark" id="table">
                <thead>
                    <tr>
                        <th class="text-center" rowspan="2">No.</th>
                        <th rowspan="2" class="nama-guru">Nama Guru</th>
                        @foreach ($categories as $cat)
                            <th colspan="{{ $cat->question->count() }}">{{ $cat->nama_kategori }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($categories as $cat)
                            @foreach ($cat->question as $q)
                                <th class="kolom-question">{{ $q->question }}</th>
                            @endforeach
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $answer)
                        @php
                            $role = $answer->teacher->user->getRoleNames()->first();
                            $teacherAnswers = $answer_all
                                ->where('teacher_id', $answer->teacher->id)
                                ->keyBy('question_id');
                        @endphp
                        <tr>
                            <td class="text-center">{{ $answer->teacher->id }}</td>
                            <td>{{ $answer->teacher->full_name }} <br>
                                {{-- <a href="{{ route('mutabaah.show', ['t_id' => $answer->teacher->id, 'm_id' => request()->get('id')]) }}"
                                    class="btn btn-success btn-sm mt-1"><i class="bi bi-info-circle-square"></i> detail
                                    jawaban
                                </a> --}}
                            </td>
                            @foreach ($categories as $cat)
                                @foreach ($cat->question as $q)
                                    <td>
                                        {{ $teacherAnswers->has($q->id) ? $teacherAnswers[$q->id]->answer : '-' }}
                                    </td>
                                @endforeach
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@include('layouts.partials.allscripts')

@push('css')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tablee').DataTable({
                paging: false,
            });
        })
    </script>
@endpush
