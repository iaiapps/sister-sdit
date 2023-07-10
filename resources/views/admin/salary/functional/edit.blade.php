@extends('layouts.app')

@section('title', 'Edit Data Gaji Fungsional')
@section('content')
    <div class="card p-3">
        <form action="{{ route('functional.update', $functional->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="nama_fungsional">Nama Fungsional </label>
                            <input class="form-control" type="text" id="nama_fungsional" name="nama_fungsional"
                                placeholder="nama jabatan" value="{{ $functional->nama_fungsional }}" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="gaji_fungsional">Gaji Fungsional </label>
                            <input class="form-control" type="number" id="gaji_fungsional" name="gaji_fungsional"
                                placeholder="gaji fungsional" value="{{ $functional->gaji_fungsional }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
