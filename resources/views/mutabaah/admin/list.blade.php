@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'List Mengisi Mutabaah')
@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ route('mutabaah.index') }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
        </div>
        <p class="text-center fs-5 mb-0">Data Guru yang sudah mengisi Mutabaah, Bulan
            <strong>{{ Carbon\Carbon::parse(request('date'))->isoFormat('MMMM Y') }}</strong>
        </p>
        <hr>
        <div class="table-responsive">
            <table class="table align-middle" id="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Guru</th>
                        <th>Total Point</th>
                        <th>Tanggal Pengisian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $answer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $answer->teacher->full_name }}</td>
                            <td>{{ $answer->t_point }}</td>
                            <td>{{ $carbon::parse($answer->tanggal)->isoFormat('DD MMMM Y') }}</td>
                            <td>
                                <a href="{{ route('mutabaah.show', ['t_id' => $answer->teacher->id, 'm_id' => request()->get('id')]) }}"
                                    class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i> info
                                </a>
                            </td>
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
                paging: '100'
            });
        });
    </script>
@endpush
