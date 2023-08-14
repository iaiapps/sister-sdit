@extends('layouts.app')

@section('title', 'Data Document')
@section('content')
    <div class="card p-3 rounded">

        @if (Auth::user()->role->name == 'Guru/Tendik' || Auth::user()->role->name == 'Siswa')
            <div class="mb-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#document">
                    Tambah Dokumen
                </button>
            </div>
        @endif

        <div class="row">
            @forelse ($documents as $doc)
                <div class="col-md-3 col-6 mb-3 ">
                    <div class="text-center border rounded p-3 besar">
                        <p class="fs-6 mb-1">{{ $doc->type }}</p>
                        <img src="{{ asset('storage/img-document/' . $doc->file) }}" class="img-doc" alt="document_image">
                        <div class="mt-2">
                            <a href="{{ route('document.show', $doc->id) }}" class="btn btn-sm btn-success">lihat</a>
                            <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                action="{{ route('document.destroy', $doc->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash3"></i> del
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center fs-5">belum ada data tersimpan</p>
            @endforelse
        </div>
    </div>

    @include('admin.document.create')
@endsection
@push('css')
    <style>
        .img-doc {
            height: 70px;
        }

        .besar {
            height: 180px;
        }
    </style>
@endpush
