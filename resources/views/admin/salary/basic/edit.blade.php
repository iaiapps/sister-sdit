@extends('layouts.app')

@section('title', 'Edit Data Gaji Pokok')
@section('content')
    <div class="card p-3">
        <form action="{{ route('basic.update', $basic->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="nama_jabatan">Nama Jabatan </label>
                            <input class="form-control" type="text" id="nama_jabatan" name="nama_jabatan"
                                placeholder="nama jabatan" value="{{ $basic->nama_jabatan }}" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="gaji_pokok">Gaji Pokok </label><input class="form-control"
                                type="number" id="gaji_pokok" name="gaji_pokok" placeholder="gaji pokok"
                                value="{{ $basic->gaji_pokok }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
