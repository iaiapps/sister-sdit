@extends('layouts.appmobile')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'List Mutabaah')
@section('content')
    @if (session('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <p class="m-0">{{ session('msg') }} </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card p-3">
        <p class="text-center m-0">Nama : {{ $teacher->full_name }}</p>
        <hr class="p-0 my-2">
        <table id="#" class="table align-middle" style="width: 100%">
            <tbody>
                @foreach ($mutabaahs->sortByDesc('id') as $mutabaah)
                    <tr class="bg-light">
                        <td class="d-none">{{ $loop->iteration }}</td>
                        <td class="pb-0">
                            <small class="text-bg-light text-decoration-underline">
                                {{ $carbon::parse($mutabaah->start)->isoFormat('DD/MM/YY') }}
                                - {{ $carbon::parse($mutabaah->end)->isoFormat('DD/MM/YY') }}</small>
                        </td>
                        <td class="pt-2 pb-1 clearfix">
                            <div class="float-start">
                                {{ $loop->iteration }}. {{ $mutabaah->name }}
                            </div>
                        </td>
                        <td class="p-0">
                            <hr class="m-0 pb-1">
                        </td>
                        <td class="pt-2 clearfix">
                            <div class="float-start">
                                @if ($now >= $mutabaah->start && $now <= $mutabaah->end)
                                    <a href="{{ route('mutabaah-mobile.create', ['mutabaah' => $mutabaah->id]) }}"
                                        type="button" class="btn btn-labeled btn-success btn-sm">
                                        <span class="btn-label"><i class="bi bi-plus-circle"></i></span>Isi data</a>
                                @else
                                    <button class="btn btn-danger btn-sm btn-labeled">
                                        <span class="btn-label"><i class="bi bi-x-circle"> </i></span> Terlewati </button>
                                @endif

                            </div>
                            {{-- untuk mengetahui sudah isi data atau belum --}}
                            @php
                                $exist = DB::table('answers')
                                    ->where('mutabaah_id', $mutabaah->id)
                                    ->where('teacher_id', $teacher->id)
                                    ->exists();
                            @endphp
                            @if ($exist == true)
                                <div class="float-end">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('css')
    <style>
        /* button untuk btn sm*/
        .btn-label {
            position: relative;
            /*untuk left btn normal ganti -12*/
            left: -8px;
            display: inline-block;
            /*untuk padding btn normal ganti 6px 12px*/
            padding: 4px 8px;
            background: rgba(0, 0, 0, 0.15);
            border-radius: 3px 0 0 3px;
        }

        .btn-labeled {
            padding-top: 0;
            padding-bottom: 0;
        }

        /* card */
        .card thead {
            display: none;
        }

        .card tbody {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between
        }

        .card tbody tr {
            margin: 8px;
            width: calc(100% * (1/4) - 20px);
            border: 1px solid #bfbfbf;
            border-radius: 0.5em;
        }

        .card tbody tr td {
            display: block;
            border: 0;
        }

        @media (max-width: 600px) {
            .card tbody {
                flex-direction: column;
                width: 100%
            }

            .card tbody tr {
                margin: 8px 0px;
                width: 100%;
            }
        }
    </style>
@endpush
