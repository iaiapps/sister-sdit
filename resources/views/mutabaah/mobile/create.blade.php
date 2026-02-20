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
            <form action="{{ route('mutabaah-mobile.store') }}" method="POST" id="mutabaahForm">
                @csrf

                <p class="fs-5 mb-0">Nama: {{ $name }}</p>
                <hr>

                <input value="{{ $teacher->id }}" name="teacher_id" readonly hidden>
                <input type="text" name="mutabaah_id" value="{{ request()->get('mutabaah') }}" readonly hidden>

                @foreach ($categories as $category)
                    <fieldset class="step">
                        @if ($errors->any())
                            <div class="alert alert-danger py-1 px-3">
                                <span>Ada pertanyaan yang belum di jawab!</span>
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
                            @foreach ($category->question->where('question_for', '!=', 'guru') as $question)
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

                <button type="button" class="action back btn btn-outline-success float-start ">
                    Sebelumnya
                </button>
                <button type="button" class="action next btn btn-success float-end ">
                    Selanjutnya
                </button>

                <!-- Submit Button dengan loading state -->
                <button type="submit" class="action submit btn btn-success float-end " id="submitBtn">
                    <span id="submitText">Simpan Data</span>
                    <div id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </form>

            <!-- Alert untuk menampilkan pesan -->
            <div id="formAlert" class="alert d-none mt-3"></div>
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
        (function($) {
            const $form = $('#mutabaahForm');
            const $formAlert = $('#formAlert');
            const $submitBtn = $('#submitBtn');
            const $submitText = $('#submitText');
            const $submitSpinner = $('#submitSpinner');
            const mybutton = document.getElementById('myBtn');
            const redirectFallback = '{{ route('mutabaah-mobile.index') }}';
            const submitUrl = '{{ route('mutabaah-mobile.store') }}';
            const csrfToken = '{{ csrf_token() }}';

            let isSubmitting = false;
            let isRedirecting = false;

            function setSubmittingState(submitting) {
                isSubmitting = submitting;
                $submitBtn.prop('disabled', submitting);
                $submitText.text(submitting ? 'Menyimpan...' : 'Simpan Data');
                $submitSpinner.toggleClass('d-none', !submitting);
            }

            function showAlert(message, type) {
                if (! $formAlert.length) {
                    return;
                }

                $formAlert
                    .removeClass('d-none')
                    .attr('class', 'alert alert-' + type + ' mt-3')
                    .html(message);

                $formAlert[0].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                });

                if (type === 'success') {
                    setTimeout(function() {
                        $formAlert.addClass('d-none');
                    }, 5000);
                }
            }

            function scrollFunction() {
                if (! mybutton) {
                    return;
                }

                const showButton = document.body.scrollTop > 50 || document.documentElement.scrollTop > 50;
                mybutton.style.display = showButton ? 'block' : 'none';
            }

            window.onscroll = scrollFunction;
            scrollFunction();

            if ($form.length) {
                $form.on('submit', function(e) {
                    e.preventDefault();

                    if (isSubmitting) {
                        showAlert('Data sedang disimpan, harap tunggu...', 'warning');
                        return;
                    }

                    setSubmittingState(true);

                    $.ajax({
                        url: submitUrl,
                        type: 'POST',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        timeout: 30000,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        success: function(result) {
                            if (result && result.success) {
                                showAlert(result.message || 'Berhasil menambahkan data!', 'success');
                                isRedirecting = true;
                                setTimeout(function() {
                                    window.location.href = result.redirect || redirectFallback;
                                }, 1200);
                                return;
                            }

                            showAlert((result && result.message) || 'Terjadi kesalahan.', 'danger');
                        },
                        error: function(xhr, textStatus) {
                            if (textStatus === 'timeout') {
                                showAlert('Koneksi timeout setelah 30 detik. Silakan cek koneksi internet Anda.',
                                    'danger');
                                return;
                            }

                            if (xhr.status === 422) {
                                const message = xhr.responseJSON && xhr.responseJSON.message ?
                                    xhr.responseJSON.message :
                                    'Ada jawaban yang masih kosong atau data sudah ada.';
                                showAlert(message, 'danger');
                                return;
                            }

                            if (xhr.status === 0) {
                                showAlert('Tidak dapat terhubung ke server. Cek koneksi internet atau URL.',
                                    'danger');
                                return;
                            }

                            showAlert('Server error: ' + xhr.status + '. Silakan coba lagi.', 'danger');
                        },
                        complete: function() {
                            if (! isRedirecting) {
                                setSubmittingState(false);
                            }
                        },
                    });
                });
            }

            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }

            window.addEventListener('beforeunload', function(e) {
                if (isSubmitting && ! isRedirecting) {
                    e.preventDefault();
                    e.returnValue = 'Data sedang disimpan. Tunggu bererapa detik, lalu OK';
                    return 'Data sedang disimpan. Tunggu bererapa detik!, lalu OK';
                }
            });
        })(jQuery);
    </script>
@endpush
