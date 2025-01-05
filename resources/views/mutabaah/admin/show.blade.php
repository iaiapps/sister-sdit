@extends('layouts.app')

@section('title', 'Detail Jawaban')

@section('content')
    @php
        // $name = Auth::user()->teacher->full_name;
        $role = $answers->first()->teacher->user->getRoleNames()->first();
    @endphp
    <div class="card p-3">
        <div>
            <a href="{{ route('mutabaah.list', ['id' => $mutabaah_id]) }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
        </div>
        <p class="text-center fs-5 mb-0">Data Jawaban <strong> {{ $answers->first()->teacher->full_name }}</strong> </p>
        <hr>
        <div class="table-responsive">
            <table class="table align-middle" id="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th class="text-center">Point</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers->sortBy('category_id') as $answer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $answer->question->category->nama_kategori }}</td>
                            <td>{{ $answer->question->question }}</td>
                            <td>{{ $answer->answer }}</td>
                            <td class="text-center">{{ $answer->point }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-center fw-bold">Total Point</td>
                        <td class="text-center fw-bold">
                            @if ($role == 'guru')
                                {{ $answer->where('teacher_id', $answer->teacher->id)->sum('point') }}/{{ $question->sum('max_point') }}
                            @elseif ($role == 'tendik')
                                {{ $answer->where('teacher_id', $answer->teacher->id)->sum('point') }}/{{ $question->where('question_for', 'all')->sum('max_point') }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
