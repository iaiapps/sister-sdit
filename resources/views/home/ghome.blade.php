@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')

    {{-- @dd(Auth::user()->role->name) --}}
    @if ($teacher->full_name == 'user')
        <div class="alert alert-danger alert-dismissible fade show py-2 text-center" role="alert">
            <span class="m-0">Identitas anda belum lengkap!</span>
            <a href="{{ route('guru.editTeacher', $teacher->id) }}" class="btn btn-dark btn-sm ms-md-2">klik
                untuk mengisi</a>
        </div>

        <!-- Modal -->
        <div class="modal fade mt-5" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="myModalLabel">Lengkapi Data Identitas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 text-center">
                        <div class="alert alert-danger alert-dismissible fade show py-2 " role="alert">
                            <span class="m-0 ">Identitas anda belum lengkap!</span>
                        </div>
                        <a href="{{ route('guru.editTeacher', $teacher->id) }}" class="btn btn-dark btn-sm ms-1">klik
                            untuk mengisi</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- <a href="{{route('guru.basiclogout')}} ">coba logout</a> --}}
    <div class="card rounded p-3 mb-3">
        <p class="fs-4 text-center m-0">
            Selamat Datang di Pusat Data dan Informasi SDIT Harapan Umat Jember
        </p>
    </div>

    <div class="container text-center mb-3">
        <div class="row">
            <div class="col-12 col-md-4 bg-primary p-2">
                <a href="{{ route('guru.profile') }}" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-person fs-2"></i>
                    <span class="d-block">Profil</span>
                </a>
            </div>
            <div class="col-12 col-md-4 bg-light p-2">
                <a href="{{ route('document.index') }}" class="nav-link btn btn-outline text-dark">
                    <i class="bi bi-card-image fs-2"></i>
                    <span class="d-block">Dokumen</span>
                </a>
            </div>
            <div class="col-12 col-md-4 bg-danger p-2">
                <a href="{{ route('guru.teacher.presence') }}" class="nav-link btn btn-outline text-white">
                    <i class="bi bi-calendar-check fs-2"></i>
                    <span class="d-block">Presensi</span>
                </a>
            </div>
            {{-- <div class="col-6 col-md-3 bg-warning p-2">
                <a href="" class="nav-link btn btn-outline text-white ">
                    <i class="bi bi-coin fs-2"></i>
                    <span class="d-block">Gaji</span>
                </a>
            </div> --}}
        </div>
    </div>

    <div class="bg-white rounded container">
        <p class="fs-4 text-center pt-3">Profil Pengguna</p>
        <hr>
        <div class="row">
            <div class="col-12 col-md-4 p-3 ">
                <div class="text-center align-items-center">
                    @if (empty($picture->file))
                        <i class="bi bi-person-circle display-2"></i>
                    @else
                        <img src="{{ asset('storage/img-document/' . $picture->file) }}" class="profiluser" alt="profil">
                    @endif
                    <p class="fs-5">{{ $teacher->full_name }}</p>
                    {{-- <div class="btn-group">
                        <a href="{{ route('profile.index') }}" class="btn btn-sm btn-success">detail</a>
                        <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-sm btn-outline-success">edit</a>
                    </div> --}}
                </div>
            </div>

            <div class="col-md-8 col-12 p-3">
                <div class="table-responsive">
                    <table id="table" class="table table-striped align-middle">
                        <tbody>
                            {{-- <tr>
                                <td class="widtht">Jabatan</td>
                                <td>{{ $teacher->salary_basic->nama_jabatan ?? 'belum ditentukan' }}</td>
                            </tr> --}}
                            <tr>
                                <td>Nomor Handphone</td>
                                <td>{{ $teacher->no_hp ?? 'belum ditentukan' }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $teacher->user->email ?? 'belum ditentukan' }}</td>
                            </tr>
                            <tr>
                                <td>Pendidikan Terakhir</td>
                                <td>{{ $teacher->last_education ?? 'belum ditentukan' }}</td>
                            </tr>
                            <tr>
                                <td>Masuk SDIT sejak</td>
                                <td>{{ $teacher->month_enter ?? 'belum ditentukan' }} {{ $teacher->year_enter }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection
@push('css')
    <style>
        .widtht {
            width: 170px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#myModal").modal('show');
        });
    </script>
@endpush
