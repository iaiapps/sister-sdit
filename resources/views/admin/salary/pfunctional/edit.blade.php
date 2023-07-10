@extends('layouts.app')

@section('title', 'Edit Data Fungsional')
@section('content')
    <div class="card p-3">
        <form action="{{ route('pfunctional.update', $pfunctional->id) }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="nama_jabatan">Nama </label>
                            <input class="form-control" type="text" id="nama_jabatan" name="teacher_id"
                                placeholder="nama jabatan" value="{{ $pfunctional->full_name }}" readonly disabled />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="gaji_pokok">Jabatan </label>
                            <select class="form-select" id="pilih_jabatan" name="salary_functional_id">
                                <option selected>--- pilih ---</option>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}">
                                        {{ $jabatan->nama_fungsional }}</option>
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
