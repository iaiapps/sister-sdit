@extends('layouts.app')

@section('title', 'Detail Document')
@section('content')
    <div class="card p-3 rounded">
        <div class="mb-3">
            <a href="{{ URL::previous() }}" type="button" class="btn btn-success">
                kembali
            </a>
        </div>
        @if (Str::contains($document->file, 'pdf'))
            <embed class="pdf-doc" src="{{ asset('storage/img-document/' . $document->file) }}" type="application/pdf">
        @else
            <div class="text-center border rounded p-3 ">
                <p class="fs-3 mb-3">{{ $document->type }}</p>
                <img src="{{ asset('storage/img-document/' . $document->file) }}" class="img-doc" alt="document_image">
            </div>
        @endif
    </div>
@endsection

@push('css')
    <style>
        .img-doc,
        .pdf-doc {
            height: 570px;
        }
    </style>
@endpush
