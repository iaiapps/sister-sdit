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

@push('scripts')
    <script src="{{ asset('js/form.js') }}"></script>
    <script>
        let mybutton = document.getElementById("myBtn");
        let formSubmitted = false;
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

        // SOLUSI 3: JavaScript untuk prevent multiple submission
        document.getElementById('mutabaahForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');
            const formAlert = document.getElementById('formAlert');

            // Jika sedang proses submit, prevent duplicate
            if (isSubmitting) {
                showAlert('Data sedang disimpan, harap tunggu...', 'warning');
                return false;
            }

            // Set state submitting
            isSubmitting = true;
            formSubmitted = true;
            submitBtn.disabled = true;
            submitText.textContent = 'Menyimpan...';
            submitSpinner.classList.remove('d-none');
            formAlert.classList.add('d-none');

            try {
                // Kirim data via AJAX
                const response = await fetch('{{ route('mutabaah-mobile.store') }}', {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    showAlert(result.message, 'success');

                    // Redirect setelah 2 detik
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 2000);

                } else {
                    showAlert(result.message, 'danger');
                    resetSubmitButton();
                }

            } catch (error) {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan jaringan. Silakan coba lagi.', 'danger');
                resetSubmitButton();
            }
        });

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
        }

        // Fungsi reset button
        function resetSubmitButton() {
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');

            submitBtn.disabled = false;
            submitText.textContent = 'Simpan Data';
            submitSpinner.classList.add('d-none');
            isSubmitting = false;
            formSubmitted = false;
        }

        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        // Warning ketika user mencoba meninggalkan halaman saat proses submit
        window.addEventListener('beforeunload', function(e) {
            if (isSubmitting) {
                e.preventDefault();
                e.returnValue = 'Data sedang disimpan. Yakin ingin meninggalkan halaman?';
            }
        });
    </script>
@endpush
