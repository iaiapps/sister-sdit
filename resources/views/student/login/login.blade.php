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
                <img src="img/student.png" class="border border-3 bg-white rounded-circle p-1 avatar mb-3 mt-3"
                    alt="teacher" />
                <p class="text-success display-6">Login Siswa</p>
            </div>
            <div class="p-3">
                <form class="form mb-3" method="POST" action="/student-login">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nis" placeholder="NIS" name="nis" />
                        <label for="nis">NIS (Nomor Induk Siswa)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            name="password" />
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="btn btn-success w-100" type="submit">
                        Login Siswa
                    </button>
                </form>
            </div>

            <p class="small px-3 mt-4">
                NB: Untuk mendapat NIS dan Password, silahkan menghubungi Wali Kelas masing-masing
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

@endsection
