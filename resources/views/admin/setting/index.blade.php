@extends('layouts.app')

@section('title', 'Setting Aplikasi')
@section('content')
    <div class="card p-3">

        <div class="row g-3">
            <div class="col-12 col-md-6 ">
                <div class="card border">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check fs-2 "></i>
                        <p class="mb-0">Setting Presensi</p>
                    </div>
                    <div class="card-footer"><a href="{{ route('admin.presenceset.index') }}"
                            class="btn btn-success w-100">Lihat</a></div>
                </div>
            </div>
            <div class="col-12 col-md-6 ">
                <div class="card border">
                    <div class="card-body text-center">
                        <i class="bi bi-buildings fs-2"></i>
                        <p class="mb-0">Setting Sekolah</p>
                    </div>
                    <div class="card-footer"><a href="{{ route('admin.school.index') }}"
                            class="btn btn-success w-100">Lihat</a></div>
                </div>
            </div>

        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">Setting</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tr>
                    <td>Type</td>
                    <td>Pengaturan Type Gaji </td>
                    <td>
                        <a href="{{ route('type.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                {{-- <tr>
                        <td>Fungsional</td>
                        <td>Pengaturan Gaji Fungsional </td>
                        <td>
                            <a href="{{ route('functional.index') }}" class="btn btn-success btn-sm">lihat</a>
                        </td>
                    </tr> --}}
                {{-- <tr>
                    <td>Penambahan/Pengurangan</td>
                    <td>Pengaturan Penambahan dan Pengurangan </td>
                    <td>
                        <a href="{{ route('plusmin.index') }}" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr> --}}
                <tr>
                    <td>Kontak</td>
                    <td>Pusat Informasi</td>
                    <td>
                        <a href="#" class="btn btn-success btn-sm">lihat</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
