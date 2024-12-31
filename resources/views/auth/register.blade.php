@extends('auth.layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container">
        <div class="max d-flex align-items-center justify-content-center">
            <div class="row wbox rounded shadow mt-5 mt-md-0">
                <div class="col-md-6 col-12 p-3">
                    <div class="text-center pt-5">
                        <img src="/img/teacher.png"
                            class="registerlogo border border-3 bg-white rounded-circle p-1 avatar mb-3 mt-3"
                            alt="teacher" />
                        <h1 class="fs-3 fw-light text-success text-center">
                            PENDAFTARAN AKUN BARU
                        </h1>
                        <hr class="" />
                        <p class="text-center">Pusat Data dan Informasi Guru <br>SDIT Harapan Umat Jember</p>
                    </div>
                </div>
                <div class="col-md-6 col-12 p-3">
                    <div class="card">
                        <div class="card-body mt-3">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label text-md-end">{{ __('Nama Lengkap') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-md-end">{{ __('Alamat Email') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label text-md-end">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password-confirm"
                                        class="form-label text-md-end">{{ __('Konfirmasi Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="mb-0">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Daftar') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .max {
            /* position: absolute;
                                                                                top: 0;
                                                                                right: 0;
                                                                                bottom: 0;
                                                                                left: 0; */
            height: 100dvh;
        }

        .wbox {
            width: 900px;
            background: white;
        }
    </style>
@endpush
