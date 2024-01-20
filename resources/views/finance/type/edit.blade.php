@extends('layouts.app')

@section('title', 'Edit Data Type Gaji')
@section('content')
    <div class="card p-3">
        <form action="{{ route('type.update', $type->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="type">Nama </label>
                            <input class="form-control bg-light" type="text" id="type" name="type"
                                placeholder="type" value="{{ $type->type }}" readonly />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama Jabatan </label>
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="nama "
                                value="{{ $type->nama }}" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="besarnya">Gaji Pokok </label><input class="form-control"
                                type="number" id="besarnya" name="besarnya" placeholder="besarnya"
                                value="{{ $type->besarnya }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
