@extends('layouts.app')

@section('title', 'Edit Data Gaji Pokok')
@section('content')
    <div class="card p-3">
        <form action="{{ route('addition.update', $addition->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="nama_penambahan">Nama penambahan </label>
                            <input class="form-control" type="text" id="nama_penambahan" name="nama_penambahan"
                                placeholder="nama penambahan" value="{{ $addition->nama_penambahan }}" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="besarnya">Besarnya </label><input class="form-control"
                                type="number" id="besarnya" name="besarnya" placeholder="besarnya"
                                value="{{ $addition->besarnya }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
