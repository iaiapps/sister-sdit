@extends('layouts.app')

@section('title', 'Data Dokumen')
@section('content')

    <div class="card p-3 rounded">
        <div>
            <a href="{{ URL::previous() }}" class="btn btn-success"><i class="bi bi-arrow-left-circle"></i>
                Kembali</a>
        </div>
        <hr>
        @if (Auth::user()->hasRole('guru'))
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

                        @if (Str::contains($doc->file, 'pdf'))
                            <div class="display-4 text-center text-danger pdfh">
                                <i class="bi bi-file-earmark-pdf align-middle"></i>
                            </div>
                        @else
                            <img src="{{ asset('storage/img-document/' . $doc->file) }}" class="img-doc"
                                alt="document_image">
                        @endif

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
                <div class="card text-center">
                    <div class="alert alert-success m-0" role="alert">
                        <p class="fw-light fs-4 m-0">
                            Belum ada data yang tersimpan ...
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @include('document.create')
@endsection
@push('css')
    <style>
        .img-doc,
        .pdfh {
            height: 70px;
        }

        .besar {
            height: 180px;
        }
    </style>
@endpush
