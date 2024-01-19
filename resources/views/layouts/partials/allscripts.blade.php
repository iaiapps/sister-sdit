@push('css')
    {{-- datatable --}}
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">

    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2/select2-bootstrap-5-theme.min.css') }}">
@endpush
@push('scripts')
    {{-- datatable --}}
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
@endpush
