@extends('layouts.app')

@section('title', 'Edit Data User')

@section('content')

    <div class="card">
        {{-- <div class="card-header bg-success">{{ __('Register') }}</div> --}}
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end" for="role">Role</label>
                    <div class="col-md-6">
                        <select class="form-select" id="role" name="role">
                            <option>---</option>
                            @foreach ($role as $r)
                                <option value="{{ $r->name }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-end" for="status">Status</label>
                    <div class="col-md-6">
                        <select class="form-select" id="status" name="active">
                            <option>---</option>
                            <option value="0">tidak aktif</option>
                            <option value="1">aktif</option>

                        </select>
                    </div>
                </div>
                {{-- <div class="row mb-3" id="nis">
                    <label for="nis" class="col-md-4 col-form-label text-md-end">{{ __('NIS') }}</label>

                    <div class="col-md-6">
                        <input id="nis" type="text" class="form-control @error('nis') is-invalid @enderror"
                            name="nis" value="{{ old('nis') }}" autofocus>

                        @error('nis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Simpan Data') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- @push('scripts')
    <script>
        const el = document.getElementById('role');
        const box = document.getElementById('nis');

        function init() {
            box.style.display = 'none';
        };

        init();

        el.addEventListener('change', function handleChange(event) {
            if (event.target.value === '3') {
                box.style.display = 'flex';
            } else {
                box.style.display = 'none';
            }
        });
    </script>
@endpush --}}
