@extends('layouts.app')

@section('title', 'Edit Data Gaji Pokok')
@section('content')
    <div class="card p-3">
        <form action="{{ route('reduction.update', $reduction->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="nama_pengurangan">Nama pengurangan </label>
                            <input class="form-control" type="text" id="nama_pengurangan" name="nama_pengurangan"
                                placeholder="nama pengurangan" value="{{ $reduction->nama_pengurangan }}" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="besarnya">Besarnya </label><input class="form-control"
                                type="number" id="besarnya" name="besarnya" placeholder="besarnya"
                                value="{{ $reduction->besarnya }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
