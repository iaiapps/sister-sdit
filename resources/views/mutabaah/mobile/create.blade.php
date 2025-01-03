@extends('layouts.appmobile')

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
                    <p class="fw-light fs-5"> Mutabaah sudah diisi </p>
                    <a href="{{ route('mutabaah-mobile.index') }}" class="btn btn-success">kembali</a>
                </div>
            </div>
        @else
            <form action="{{ route('mutabaah-mobile.store') }}" method="POST">
                @csrf

                <p class="fs-5 mb-0">Nama: {{ $name }}</p>
                <hr>
                {{-- <p>Role: {{ $role }}</p> --}}

                <input value="{{ $teacher->id }}" name="teacher_id" readonly hidden>
                <input type="text" name="mutabaah_id" value="{{ request()->get('mutabaah') }}" readonly hidden>

                @foreach ($categories as $category)
                    <fieldset class="step">
                        @if ($errors->any())
                            <div class="alert alert-danger py-1 px-3">
                                {{-- @foreach ($errors->all() as $error) --}}
                                <span>Ada pertanyaan yang belum di jawab!</span>
                                {{-- @endforeach --}}
                            </div>
                        @endif
                        <p class="text-center mb-3 fs-5 bg-success text-white rounded p-1 fs-5">Kategori:
                            {{ $category->nama_kategori }}</p>

                        @if ($role == 'guru')
                            @foreach ($category->question as $question)
                                <input type="text" value="{{ $category->id }}" name="category_id[{{ $question->id }}]"
                                    readonly hidden>
                                <div class="mb-3">
                                    <div class="alert alert-secondary py-1 px-2" role="alert">
                                        <input type="text" name="question_id[{{ $question->id }}]"
                                            value="{{ $question->id }}" readonly hidden>
                                        <p class="mb-0 text-black">{{ $loop->iteration }}. {{ $question->question }}</p>
                                    </div>

                                    <div class="mt-0">
                                        <ul class="list-group">
                                            @foreach ($question->option as $option)
                                                <li class="list-group-item py-1 d-flex ">
                                                    <input class="form-check-input me-2" type="radio"
                                                        name="option[{{ $question->id }}]" id="option{{ $option->id }}"
                                                        value="{{ $option->option_name }},{{ $option->option_point }}"
                                                        {{ old('option.' . $question->id) == $option->option_name . ',' . $option->option_point ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="option{{ $option->id }}">{{ $option->option_name }}</label>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @elseif($role == 'tendik')
                            @foreach ($category->question->where('cat', '!=', 'guru') as $question)
                                <input type="text" value="{{ $category->id }}" name="category_id[{{ $question->id }}]"
                                    readonly hidden>
                                <div class="mb-3">
                                    <div class="alert alert-secondary py-1 px-2" role="alert">
                                        <input type="text" name="question_id[{{ $question->id }}]"
                                            value="{{ $question->id }}" readonly hidden>
                                        <p class="mb-0 text-black">{{ $loop->iteration }}. {{ $question->question }}</p>
                                    </div>
                                    <div class="mt-0">
                                        <ul class="list-group">
                                            @foreach ($question->option as $option)
                                                <li class="list-group-item py-1 d-flex ">
                                                    <input class="form-check-input me-2" type="radio"
                                                        name="option[{{ $question->id }}]" id="option{{ $option->id }}"
                                                        value="{{ $option->option_name }},{{ $option->option_point }}"
                                                        {{ old('option.' . $question->id) == $option->option_name . ',' . $option->option_point ? 'checked' : '' }}>
                                                    <label class="form-check-label"
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
    <a href="#judul" id="myBtn" class="totop btn btn-warning"><i class="bi bi-arrow-up"></i></a>
@endsection

@push('css')
    <style>
        .totop {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
        }

        input[type="radio"] {
            margin-right: 1em;
            flex-shrink: 0;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/form.js') }}"></script>
    <script>
        // Get the button
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 50px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
    </script>
@endpush
