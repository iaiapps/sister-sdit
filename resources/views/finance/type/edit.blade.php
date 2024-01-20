@extends('layouts.app')

@section('title', 'Edit Data Gaji Pokok')
@section('content')
    <div class="card p-3">
        <form action="{{ route('type.update', $type->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="type_gaji">Nama Jabatan </label>
                            <input class="form-control bg-light" type="text" id="type_gaji" name="type_gaji"
                                placeholder="type" value="{{ $type->type_gaji }}" readonly />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="nama_gaji">Nama Jabatan </label>
                            <input class="form-control" type="text" id="nama_gaji" name="nama_gaji" placeholder="nama "
                                value="{{ $type->nama_gaji }}" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="besar_gaji">Gaji Pokok </label><input class="form-control"
                                type="number" id="besar_gaji" name="besar_gaji" placeholder="besarnya"
                                value="{{ $type->besar_gaji }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
