@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')

    @if (empty($student->nik) || empty($student->kk))
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <p class="m-0">Identitas anda belum lengkap! <a href="{{ route('student.edit', $student->id) }}"
                    class="btn btn-dark btn-sm">clik
                    untuk mengisi</a></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card rounded p-3 mb-3">
        <p class="fs-3 text-center m-0">
            Selamat Datang di Aplikasi Sister SDIT Harum
        </p>
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
                    <p class="fs-5 mt-3">{{ $student->full_name ?? 'belum ditentukan' }}</p>
                    {{-- <div class="btn-group">
                        <a href="{{ route('profile.index') }}" class="btn btn-sm btn-success">detail</a>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-sm btn-outline-success">edit</a>
                    </div> --}}
                </div>
            </div>

            <div class="col-md-8 col-12 p-3">
                <div class="table-responsive">
                    <table id="table" class="table table-striped align-middle">
                        <tbody>
                            <tr>
                                <td>NIS</td>
                                <td>{{ $student->nis ?? 'belum ditentukan' }}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>{{ ($student->place_of_birth ?? ' ') . ($student->date_of_birth ?? 'belum ditentukan') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>{{ $student->nis ?? 'belum ditentukan' }}</td>
                            </tr>
                            {{-- <tr>
                                <td>Alamat Rumah</td>
                                <td>{{ $student->address . ' | rt ' . $student->rt . ' | ' . 'rw' . $student->rw . ' | ' . $student->village }}
                                    | {{ $student->subdistrict }} |
                                    {{ $student->city }} | {{ $student->province }}</td>
                            </tr> --}}

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
