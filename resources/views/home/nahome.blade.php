@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="card rounded p-3">
        <p class="fs-5 text-center m-0">
            Selamat Datang <span class="fw-bold text-uppercase">"{{ $name }}"</span> di Sistem Informasi Terpadu SDIT
            Harapan Umat Jember
        </p>
    </div>
    <div class="card rounded p-3 mt-3 d-block text-center ">
        <p class="fs-5">Akun anda belum aktif, silahkan hubungi "Admin" untuk mengaktifkan Akun</p>

        <a href="https://wa.me/6285232213939" target="_blank" class="btn btn-success mb-3 ">Call Center Admin</a>
        {{-- <div class="text-center">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-danger me-3">logout</button>
            </form>
        </div> --}}
    </div>

@endsection
