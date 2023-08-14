@extends('layouts.app')

@section('title', 'Edit Data Anak')
@section('content')
    <div class="card p-3">

        {{-- @dd($child) --}}
        <form action="{{ route('child.update', $child->id) }}" method="POST">
            @csrf
            @method('put')

            <fieldset>
                <div class="mb-3">
                    <label class="form-label" for="name">Nama Anak</label><input class="form-control" type="text"
                        id="name" name="name" placeholder="nama anak" value="{{ old('name', $child->name) }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="education_level">Jenjang Pendidikan </label>
                    <input class="form-control" type="text" id="education_level" name="jenjang pendidikan"
                        placeholder="jenjang pendidikan" value="{{ old('education_level', $child->education_level) }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="gender">Jenis Kelamin </label>
                    <input class="form-control" type="text" id="gender" name="gender" placeholder="fakultas/jurusan"
                        value="{{ old('gender', $child->gender) }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="place_of_birth">Tempat Lahir </label><input class="form-control"
                        type="text" id="place_of_birth" name="place_of_birth" placeholder="tempat lahir"
                        value="{{ old('place_of_birth', $child->place_of_birth) }}" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="date_of_birth">Tanggal Lahir </label><input class="form-control"
                        type="date" id="date_of_birth" name="date_of_birth" placeholder="tanggal lahir"
                        value="{{ old('date_of_birth', $child->date_of_birth) }}" />
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>

    </div>
@endsection
