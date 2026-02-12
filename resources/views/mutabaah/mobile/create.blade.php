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

                <button class="action back btn btn-outline-success float-start ">
                    Sebelumnya
                </button>
                <button class="action next btn btn-success float-end ">
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
        let mybutton = document.getElementById("myBtn");
        let isSubmitting = false;

        // Scroll function
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

        // JavaScript untuk prevent multiple submission dengan XMLHttpRequest (lebih compatible webview)
        document.getElementById('mutabaahForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Jika sedang proses submit, prevent duplicate
            if (isSubmitting) {
                showAlert('Data sedang disimpan, harap tunggu...', 'warning');
                return false;
            }

            // Set state submitting
            setSubmittingState(true);

            var form = this;
            var url = '{{ route('mutabaah-mobile.store') }}';
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            var timeoutId;

            // Debug log
            console.log('Starting submit to: ' + url);

            xhr.open('POST', url, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            // Timeout handler
            timeoutId = setTimeout(function() {
                xhr.abort();
                showAlert('Koneksi timeout setelah 30 detik. Silakan cek koneksi internet Anda.', 'danger');
                setSubmittingState(false);
                console.log('Request timeout');
            }, 30000);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    clearTimeout(timeoutId);
                    console.log('Response received. Status: ' + xhr.status);

                    if (xhr.status === 200) {
                        try {
                            var result = JSON.parse(xhr.responseText);
                            console.log('Success:', result);

                            if (result.success) {
                                showAlert(result.message, 'success');
                                setTimeout(function() {
                                    window.location.href = result.redirect;
                                }, 2000);
                            } else {
                                showAlert(result.message || 'Terjadi kesalahan.', 'danger');
                                setSubmittingState(false);
                            }
                        } catch (e) {
                            console.error('JSON parse error:', e);
                            console.log('Response text:', xhr.responseText);
                            showAlert('Format response tidak valid. Silakan coba lagi.', 'danger');
                            setSubmittingState(false);
                        }
                    } else if (xhr.status === 422) {
                        try {
                            var result = JSON.parse(xhr.responseText);
                            showAlert(result.message || 'Ada jawaban yang masih kosong atau data sudah ada.',
                                'danger');
                        } catch (e) {
                            showAlert('Validasi gagal. Pastikan semua pertanyaan terjawab.', 'danger');
                        }
                        setSubmittingState(false);
                    } else if (xhr.status === 0) {
                        showAlert('Tidak dapat terhubung ke server. Cek koneksi internet atau URL.', 'danger');
                        setSubmittingState(false);
                    } else {
                        showAlert('Server error: ' + xhr.status + '. Silakan coba lagi.', 'danger');
                        setSubmittingState(false);
                    }
                }
            };

            xhr.onerror = function() {
                clearTimeout(timeoutId);
                console.error('XHR Error');
                showAlert('Error koneksi. Pastikan internet aktif dan coba lagi.', 'danger');
                setSubmittingState(false);
            };

            xhr.onabort = function() {
                clearTimeout(timeoutId);
                console.log('Request aborted');
            };

            try {
                xhr.send(formData);
                console.log('Request sent');
            } catch (e) {
                clearTimeout(timeoutId);
                console.error('Send error:', e);
                showAlert('Gagal mengirim data. Error: ' + e.message, 'danger');
                setSubmittingState(false);
            }
        });

        // Fungsi untuk mengatur state submitting
        function setSubmittingState(submitting) {
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');

            isSubmitting = submitting;
            submitBtn.disabled = submitting;

            if (submitting) {
                submitText.textContent = 'Menyimpan...';
                submitSpinner.classList.remove('d-none');
            } else {
                submitText.textContent = 'Simpan Data';
                submitSpinner.classList.add('d-none');
            }
        }

        // Fungsi untuk menampilkan alert
        function showAlert(message, type) {
            const formAlert = document.getElementById('formAlert');
            formAlert.className = `alert alert-${type} mt-3`;
            formAlert.innerHTML = message;
            formAlert.classList.remove('d-none');

            // Scroll ke alert
            formAlert.scrollIntoView({
                behavior: 'smooth'
            });

            // Auto hide alert setelah 5 detik untuk tipe success
            if (type === 'success') {
                setTimeout(() => {
                    formAlert.classList.add('d-none');
                }, 5000);
            }
        }

        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        // Warning ketika user mencoba meninggalkan halaman saat proses submit
        window.addEventListener('beforeunload', function(e) {
            if (isSubmitting) {
                e.preventDefault();
                e.returnValue = 'Data sedang disimpan. Tunggu bererapa detik, lalu OK';
                return 'Data sedang disimpan. Tunggu bererapa detik!, lalu OK';
            }
        });
    </script>
@endpush
