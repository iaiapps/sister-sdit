@extends('layouts.app')

@section('title', 'Buat Jawaban')
@section('content')
    @php
        $name = Auth::user()->teacher->full_name;
        $role = Auth::user()->getRoleNames()->first();
    @endphp
    <div class="card p-3">
        @if ($exist)
            <div class="bg-white rounded text-center">
                <div class="alert alert-success m-0" role="alert">
                    <p class="fw-light fs-4"> Mutabaah sudah diisi </p>
                    <a href="{{ url()->previous() }}" class="btn btn-success">kembali</a>
                </div>
            </div>
        @else
            <form action="{{ route('guru.answer.store') }}" method="POST">
                @csrf
                <input value="{{ $teacher->id }}" name="teacher_id" readonly hidden>

                <div class="mb-3">
                    <input type="text" name="mutabaah_id" value="{{ request()->get('mutabaah') }}" readonly hidden>
                </div>
                @foreach ($categories as $category)
                    <fieldset class="step">
                        <p class="text-center m-0 fs-5 bg-success text-white rounded p-2 fs-5">Kategori:
                            {{ $category->nama_kategori }}</p>
                        <hr>

                        @if ($role == 'guru')
                            @foreach ($category->question as $question)
                                <input type="text" value="{{ $category->id }}" name="category_id[{{ $question->id }}]"
                                    readonly hidden>
                                <div class="mb-3">
                                    <div class="alert alert-secondary p-1" role="alert">
                                        <p class=" mb-0 fs-5"> {{ $loop->iteration }}. {{ $question->question }}</p>
                                    </div>
                                    <div class="d-none">
                                        <input type="text" name="question_id[{{ $question->id }}]"
                                            value="{{ $question->id }}" readonly hidden>
                                    </div>
                                    <div class="mt-0">
                                        <ul class="list-group">
                                            @foreach ($question->option as $option)
                                                <li class="list-group-item"> <input class="form-check-input" type="radio"
                                                        name="option[{{ $question->id }}]" id="option{{ $option->id }}"
                                                        value="{{ $option->option_name }}, {{ $option->option_point }}">
                                                    <label class="form-check-label ms-3"
                                                        for="option{{ $option->id }}">{{ $option->option_name }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @elseif($role == 'tendik')
                            @foreach ($category->question->where('question_for', '!=', 'guru') as $question)
                                <input type="text" value="{{ $category->id }}" name="category_id[{{ $question->id }}]"
                                    readonly hidden>
                                <div class="mb-3">
                                    <div class="alert alert-secondary p-1" role="alert">
                                        <p class=" mb-0 fs-5"> {{ $loop->iteration }}. {{ $question->question }}</p>
                                    </div>
                                    <div class="d-none">
                                        <input type="text" name="question_id[{{ $question->id }}]"
                                            value="{{ $question->id }}" readonly hidden>
                                    </div>
                                    <div class="mt-0">
                                        <ul class="list-group">
                                            @foreach ($question->option as $option)
                                                <li class="list-group-item"> <input class="form-check-input" type="radio"
                                                        name="option[{{ $question->id }}]" id="option{{ $option->id }}"
                                                        value="{{ $option->option_name }}, {{ $option->option_point }}">
                                                    <label class="form-check-label ms-3"
                                                        for="option{{ $option->id }}">{{ $option->option_name }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </fieldset>
                @endforeach

                <button class="action back btn btn-outline-success float-start ">
                    Sebelumnya
                </button>
                <button class="action next btn btn-success float-end ">
                    Selanjutnya
                </button>
                <button type="submit" class="action submit btn btn-success float-end ">
                    Simpan Data
                </button>
            </form>
        @endif

    </div>
@endsection


@include('layouts.partials.allscripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            var current = 1;

            widget = $(".step");
            btnnext = $(".next");
            btnback = $(".back");
            btnsubmit = $(".submit");

            widget.not(":eq(0)").hide();
            hideButtons(current);
            setProgress(current);

            btnnext.click(function(e) {
                e.preventDefault();
                if (current < widget.length) {
                    widget.show();
                    widget.not(":eq(" + current++ + ")").hide();
                    setProgress(current);
                }
                hideButtons(current);
            });

            btnback.click(function(e) {
                e.preventDefault();
                if (current > 1) {
                    current = current - 2;
                    btnnext.trigger("click");
                }
                hideButtons(current);
            });
        });

        setProgress = function(currstep) {
            var percent = parseFloat(100 / widget.length) * currstep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        };

        hideButtons = function(current) {
            var limit = parseInt(widget.length);

            $(".action").hide();

            if (current < limit) btnnext.show();
            if (current > 1) btnback.show();
            if (current == limit) {
                btnnext.hide();
                btnsubmit.show();
            }
        };
    </script>
@endpush
