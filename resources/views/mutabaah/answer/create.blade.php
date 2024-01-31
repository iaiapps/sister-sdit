@extends('layouts.app')

@section('title', 'Buat Jawaban')
@section('content')
    <div class="card p-3">
        <form action="{{ route('mutabaah-answer.store') }}" method="POST">
            @csrf
            <fieldset>
                <div class="mb-3">
                    <select name="teacher_id" id="" name="teacher_id" class="form-select">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="mutabaah_id" value="{{ request()->get('mutabaah') }}" readonly>
                </div>
                @foreach ($questions as $question)
                    <div class="mb-3">
                        <p class="mb-0">{{ $question->question }}</p>
                        <div class="d-none">
                            <input type="text" name="question_id[{{ $question->id }}]" value="{{ $question->id }}"><br>
                            <input type="text" name="category_id[{{ $question->id }}]"
                                value="{{ $question->category->id }}">
                        </div>
                        <div>
                            @foreach ($question->option as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="option[{{ $question->id }}]"
                                        id="option{{ $option->id }}"
                                        value="{{ $option->option_name }}, {{ $option->option_point }}">
                                    {{-- <input type="radio" name="point[{{ $option->id }}]"
                                        value="{{ $option->option_point }}"> --}}
                                    <label class="form-check-label"
                                        for="option{{ $option->id }}">{{ $option->option_name }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach

            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
