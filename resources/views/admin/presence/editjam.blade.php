@extends('layouts.app')

@section('title', 'Edit Jam')

@section('content')

    <div class="card">
        <div class="card-body mt-3">
            <form method="POST" action="{{ route('presence.update', [$presence->id, 'date' => $date]) }}">
                @csrf
                @method('put')

                <div class=" mb-3">
                    <label for="jam_datang" class="form-label">{{ __('Jam Datang') }}</label>

                    <input id="jam_datang" type="time" class="form-control @error('time_in') is-invalid @enderror"
                        name="time_in" value="{{ $presence->time_in }}" step="1">

                </div>

                {{-- @dd($presence->time_out) --}}
                <div class="mb-3">
                    <label for="jam_pulang" class="form-label">{{ __('Jam Pulang') }}</label>

                    <input id="jam_pulang" type="time" class="form-control @error('time_out') is-invalid @enderror"
                        name="time_out" value="{{ $presence->time_out }}" step="1">
                </div>

                <div class=" mb-3">
                    <button type="submit" class="btn btn-success">
                        {{ __('Simpan Data') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
