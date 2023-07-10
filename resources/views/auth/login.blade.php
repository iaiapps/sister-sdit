@extends('auth.layouts.app')

@section('title', 'Login Page')

@section('content')
    <div class="row vh-100 g-0">
        <!-- ini kiri -->
        <div class="col-12 col-md-4 d-block d-md-flex pt-5 pt-md-0 flex-column justify-content-center px-4 bg-light">
            {{-- error login --}}
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif


            {{-- form --}}
            <div class="title text-center">
                <img src="img/teacher.png" class="border border-3 bg-white rounded-circle p-1 avatar mb-3 mt-3"
                    alt="teacher" />
                <p class="text-success display-6">Login Guru / Tendik</p>
            </div>
            <div class="p-3">
                <form class="form mb-3" method="POST" action="/login">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                            name="email" />
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            name="password" />
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="btn btn-success w-100" type="submit">
                        Login Guru / Tendik
                    </button>
                </form>
                <div class="line"><span class="bg-light"> atau </span></div>

                <div class="d-flex justify-content-between align-items-center">
                    <p class="m-0">belum punya akun?</p>
                    <a href="/register" class="btn btn-success btn-sm" type="submit">
                        Daftar disini!
                    </a>
                </div>
            </div>

            <p class="small px-3 mt-4">
                NB: Jika belum punya akun silahkan daftar terlebih dahulu!
            </p>
        </div>
        <!-- ini kanan -->
        <div class="col-12 col-md-8 loginbackground d-sm-block d-none">
            <div class="d-flex vh-100 flex-column align-items-center justify-content-center px-5 text-center">
                <img src="img/logo.svg" class="logo bg-white p-3 rounded mb-5" alt="logo nav" />
                <h2 class="display-4 text-white fw-bold">SISTER SDIT</h2>
                <h3 class="fs-3 text-white fw-light">
                    Sister Informasi Terpadu SDIT Harapan Umat Jember
                </h3>
                <footer class="mt-5 p-2 text-center text-white">
                    <small> SISTER SDIT by Tim IT SDIT Harum Jember with ❤️ </small>
                </footer>
            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
