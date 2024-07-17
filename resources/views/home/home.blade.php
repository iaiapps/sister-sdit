@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="card rounded p-3">
        <p class="fs-4 text-center m-0">
            Selamat Datang <span class="fw-bold text-uppercase">"{{ $name }}"</span> di di Pusat Data dan Informasi
            SDIT Harapan Umat Jember
        </p>
    </div>
    <div id="info" class="row gx-3">
        <div class="col-12 col-sm-6">
            <div class="mt-3 card rounded p-3 flex-row justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <span class="fs-4 py-0 px-2 btn btn-outline-success">
                        <i class="bi bi-person-check"></i>
                    </span>
                    <span class="ms-2 fs-5 "> Total Guru </span>
                </div>
                <button class="bg-success btn btn-success p-1 px-2 fs-5 ">{{ $sumguru }}</button>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="mt-3 card rounded p-3 flex-row justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <span class="fs-4 py-0 px-2 btn btn-outline-success">
                        <i class="bi bi-person-check"></i>
                    </span>
                    <span class="ms-2 fs-5 "> Total Tendik </span>
                </div>
                <button class="bg-success btn btn-success p-1 px-2 fs-5 ">{{ $sumtendik }}</button>
            </div>
        </div>
    </div>
    <div class="card mt-3 rounded p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Form</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="align-midle">
                    @forelse ($schools as $school)
                        <tr>
                            <th>
                                <button class="btn btn-success rounded">
                                    <i class="{{ $school->icon }}"></i>
                                </button>
                            </th>
                            <td>{{ $school->name }}</td>
                            <td>{{ $school->description }}</td>
                        </tr>
                    @empty
                        <div class="alert alert-success" role="alert">
                            <p class="text-center m-0">Belum Ada Data</p>
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
