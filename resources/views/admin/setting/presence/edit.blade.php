@extends('layouts.app')

@section('title', 'Edit Setting Presensi')
@section('content')
    <div class="card p-3">
        <form action="{{ route('admin.presenceset.update', $presenceset->id) }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama Setting</td>
                            <td>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="nama setting" value="{{ $presenceset->name }}" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td>Nilai</td>
                            <td>
                                <input class="form-control" type="text" id="value" name="value" placeholder="value"
                                    value="{{ $presenceset->value }}" />
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td> <input class="form-control" type="text" id="desc" name="desc" placeholder="desc"
                                    value="{{ $presenceset->desc }}" /></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
@endsection
