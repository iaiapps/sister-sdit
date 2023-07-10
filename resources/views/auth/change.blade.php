@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')

    <div class="card">


        <div class="card-body mt-3">
            <form method="POST" action="/change-password">
                @csrf

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Password Sebelumnya') }}</label>
                    <div class="col-md-6">
                        <input id="old_password" type="password"
                            class="form-control @error('old_password') is-invalid @enderror" name="old_password"
                            value="{{ old('old_password') }}" required autocomplete="old_password">
                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="new_password" class="col-md-4 col-form-label text-md-end">{{ __('Password Baru') }}</label>
                    <div class="col-md-6">
                        <input id="new_password" type="password"
                            class="form-control @error('new_password') is-invalid @enderror" name="new_password" required
                            autocomplete="new_password">
                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="new_password_confirmation"
                        class="col-md-4 col-form-label text-md-end">{{ __('Konfirmasi Password') }}</label>
                    <div class="col-md-6">
                        <input id="new_password_confirmation" type="password" class="form-control "
                            name="new_password_confirmation" required autocomplete="new_password_confirmation">

                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Ubah Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
