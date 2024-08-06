@extends('layouts.appmobile')

@section('title', 'Buat Jawaban')
@section('content')
    <div class="card p-3">
        @if ($exist)
            <div class="bg-white rounded text-center">
                <div class="alert alert-success m-0" role="alert">
                    <p class="fw-light fs-5"> Mutabaah sudah diisi </p>
                    <a href="{{ route('mutabaah-mobile.index') }}" class="btn btn-success">kembali</a>
                </div>
            </div>
        @else
            <div>
                <form action="{{ route('mutabaah-mobile.store') }}" method="POST">
                    @csrf
                    <input value="{{ $teacher->id }}" name="teacher_id" readonly hidden>
                    <input type="text" name="mutabaah_id" value="{{ request()->get('mutabaah') }}" readonly hidden>

                    @foreach ($categories as $category)
                        <fieldset class="step">
                            <p class="text-center m-0 fs-5 bg-success text-white rounded p-1 fs-5">Kategori:
                                {{ $category->nama_kategori }}</p>
                            <hr>
                            @foreach ($category->question as $question)
                                <div class="mb-3">
                                    <div class="alert alert-secondary py-1 px-2 mb-2" role="alert">
                                        <p class=" mb-0 "> {{ $loop->iteration }}. {{ $question->question }}</p>
                                    </div>
                                    <div class="d-none">
                                        <input type="text" name="question_id[{{ $question->id }}]"
                                            value="{{ $question->id }}" readonly hidden>
                                    </div>
                                    <div class="mt-0">
                                        <ul class="list-group">
                                            @foreach ($question->option as $option)
                                                <li class="list-group-item py-1"> <input class="form-check-input"
                                                        type="radio" name="option[{{ $question->id }}]"
                                                        id="option{{ $option->id }}"
                                                        value="{{ $option->option_name }}, {{ $option->option_point }}">
                                                    <label class="form-check-label ms-3"
                                                        for="option{{ $option->id }}">{{ $option->option_name }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
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
            </div>
        @endif

    </div>
@endsection

@include('layouts.partials.allscripts')
@push('scripts')
    <script src="{{ asset('js/form.js') }}"></script>
@endpush
