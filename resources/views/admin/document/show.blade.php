@extends('layouts.app')

@section('title', 'Detail Document')
@section('content')
    <div class="card p-3 rounded">
        <div class="mb-3">
            <a href="{{ route('document.index') }}" type="button" class="btn btn-success">
                kembali
            </a>
        </div>

        <div class="text-center border rounded p-3 ">
            <p class="fs-3 mb-3">{{ $document->type }}</p>
            <img src="{{ asset('storage/img-document/' . $document->file) }}" class="img-doc" alt="document_image">

        </div>

    </div>

@endsection

@push('css')
    <style>
        .img-doc {
            height: 570px;
        }
    </style>
@endpush
