@extends('layouts.app')

@section('title', 'Detail Jawaban')

@section('content')
    <div class="card p-3">
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-success me-2">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
        </div>
        <p class="text-center fs-5 mb-0">Data Jawaban <strong> {{ $answers->first()->teacher->full_name }}</strong> </p>
        <hr>
        <div class="table-responsive">
            <table class="table align-middle" id="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th>Point</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $answer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $answer->question->question }}</td>
                            <td>{{ $answer->answer }}</td>
                            <td>{{ $answer->point }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
