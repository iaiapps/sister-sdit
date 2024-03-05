@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'List Mutabaah')
@section('content')
    <div class="card p-3">
        <div class="table-responsive">
            <table id="table" class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Mulai Pengerjaan</th>
                        <th scope="col">Akhir Pengerjaan</th>
                        <th scope="col">Pengisian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mutabaahs as $mutabaah)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mutabaah->name }}</td>
                            <td>{{ $carbon::parse($mutabaah->start)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                            <td>{{ $carbon::parse($mutabaah->end)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                            @if ($now >= $mutabaah->start && $now <= $mutabaah->end)
                                <td><a href="{{ route('guru.answer.create', ['mutabaah' => $mutabaah->id]) }}"
                                        class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> tambah </a>
                                </td>
                            @else
                                <td>melewati deadline</td>
                            @endif


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@include('layouts.partials.allscripts')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                paging: true,
                pageLength: 50
            });
        });
    </script>
@endpush
