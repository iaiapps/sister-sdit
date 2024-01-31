@extends('layouts.app')

@section('title', 'Edit Data Kategori')
@section('content')
    <div class="card p-3">
        <form action="{{ route('mutabaah-category.update', $mutabaah_category->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="nama_kategori">Nama Kategori </label>
                            <input class="form-control bg-light" type="text" id="nama_kategori" name="nama_kategori"
                                placeholder="nama_kategori" value="{{ $mutabaah_category->nama_kategori }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
