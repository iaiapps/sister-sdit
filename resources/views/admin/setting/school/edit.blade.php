@extends('layouts.app')

@section('title', 'Edit Setting Sekolah')
@section('content')
    <div class="card p-3">
        <form action="{{ route('admin.school.update', $school->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Icon (cari nama icon di "bootstrap icon")</td>
                            <td>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="nama setting" value="{{ $school->icon }}" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="nama setting" value="{{ $school->name }}" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td> <input class="form-control" type="text" id="description" name="description"
                                    placeholder="description" value="{{ $school->description }}" /></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
@endsection
