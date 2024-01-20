@extends('layouts.app')

@section('title', 'Edit Data Gaji')
@section('content')
    <div class="card p-3">
        <form action="{{ route('position.update', $position->id) }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="name_teacher">Nama </label>
                            <input class="form-control" type="text" id="name_teacher" name="name_teacher"
                                placeholder="nama" value="{{ $position->teacher->full_name }}" readonly disabled />
                        </div>
                    </div>
                    <div class="col">
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
                    </div>
                    <div class="col">
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
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
