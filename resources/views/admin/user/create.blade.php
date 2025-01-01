@extends('layouts.app')

@section('title', 'Register User Baru')

@section('content')
    <div class="card">
        <div class="card-body p-md-4 px-3">
            <form method="POST" action="{{ route('admin.user.store') }}">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label text-md-end">{{ __('Nama Lengkap User') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label text-md-end">{{ __('Alamat Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label text-md-end">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label text-md-end">{{ __('Ulangi Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-md-end" for="role">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option selected disabled>--- pilih ---</option>
                                @foreach ($role as $r)
                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-md-end" for="status">Status</label>
                            <select class="form-select" id="status" name="active">
                                <option selected disabled>--- pilih ---</option>
                                <option value="0">tidak aktif</option>
                                <option value="1">aktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="my-3">
                    <button type="submit" class="btn btn-success w-100"> Tambah User Baru </button>
                </div>
            </form>
        </div>
    </div>
@endsection
