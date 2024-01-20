@extends('layouts.app')

@section('title', 'Edit Data Gaji Pokok')
@section('content')


    {{-- <div id="position" class="modal" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}

    <div class="card p-3">
        <form action="{{ route('position.store') }}" method="POST">
            {{-- @method('PUT') --}}
            @csrf
            <fieldset>
                <div class="mb-3">
                    <label class="form-label" for="teacher_id">Nama </label>
                    <select class="form-select" id="teacher_id" name="teacher_id">
                        <option selected disabled>--- pilih ---</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label class="form-label" for="pokok">Gaji Pokok </label>
                    <select class="form-select" id="pokok" name="pokok">
                        <option selected disabled>--- pilih ---</option>
                        @foreach ($pokoks as $pokok)
                            <option value="{{ $pokok->id }}">
                                {{ $pokok->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="fungsional">Gaji Fungsional </label>
                    <select class="form-select" id="fungsional" name="fungsional">
                        <option selected disabled>--- pilih ---</option>
                        @foreach ($fungsionals as $fungsional)
                            <option value="{{ $fungsional->id }}">
                                {{ $fungsional->nama }}</option>
                        @endforeach
                    </select>
                </div>

            </fieldset>
            <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data</button>
        </form>
    </div>


    {{-- </div>
        </div>
    </div> --}}
@endsection
