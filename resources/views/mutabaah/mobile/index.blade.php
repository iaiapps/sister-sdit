@extends('layouts.appmobile')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'List Mutabaah')
@section('content')
    <div class="card p-3">
        <p class="text-center m-0">Nama Guru : {{ $name }}</p>
        <hr class="p-0 my-2">
        <table id="#" class="table align-middle" style="width: 100%">
            {{-- <thead>
                <tr>
                    <th scope="col">I</th>
                    <th scope="col">Id</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">hr</th>
                    <th scope="col">Pengisian</th>
                </tr>
            </thead> --}}
            <tbody>
                @foreach ($mutabaahs->sortByDesc('id') as $mutabaah)
                    <tr class="bg-light">
                        <td class="d-none">{{ $loop->iteration }}</td>
                        <td class="pb-0">
                            <small class="text-bg-light fw-normal text-decoration-underline">
                                {{ $carbon::parse($mutabaah->start)->isoFormat('DD/MM/YY') }}
                                - {{ $carbon::parse($mutabaah->end)->isoFormat('DD/MM/YY') }}</small>
                        </td>
                        <td class="pt-2 pb-1">{{ $loop->iteration }}. {{ $mutabaah->name }}</td>
                        <td class="p-0">
                            <hr class="m-0 mx-2 pb-1">
                        </td>
                        <td class="pt-2">
                            @if ($now >= $mutabaah->start && $now <= $mutabaah->end)
                                <a href="{{ route('mutabaah-mobile.create', ['mutabaah' => $mutabaah->id]) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="bi bi-plus-circle"></i> Isi Mutabaah </a>
                            @else
                                <a href="#" class="btn btn-danger btn-sm">
                                    <i class="bi bi-x-circle"></i> Melewati Batas </a>
                            @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- </div> --}}
    </div>
@endsection


{{-- @include('layouts.partials.allscripts') --}}

@push('css')
    <style>
        .card thead {
            display: none;
        }

        .card tbody {
            display: flex;
            flex-wrap: wrap;
        }

        .card tbody tr {
            margin: 0px 8px;
            /*        width: calc(100% * (1/4) - 5px);*/
            border: 1px solid #bfbfbf;
            border-radius: 0.5em;
            /* box-shadow: 0.25rem 0.25rem 0.5rem rgba(46, 46, 46, 0.25); */
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
{{-- @push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: false,
                pageLength: 50,
                // dom: 'lrtip'
                searching: false,
                info: false
            });
        });
    </script>
@endpush --}}
