@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'Tambah Data Gaji')
@section('content')

    {{-- @dd($presence) --}}
    @if (empty($presence->total_data_presensi))
        <div class="bg-white rounded p-3 text-center">
            <p class="fs-4">Data presensi bulan dan tahun yang anda masukkan belum ada </p>
            <a href="{{ route('salary.index') }}" class="btn btn-success">
                <i class="bi bi-arrow-left-circle"></i> kembali
            </a>
        </div>
    @else
        <div class="card p-3">
            <form action="{{ route('salary.store', ['id' => request('id')]) }}" method="POST">
                @csrf
                <fieldset>
                    <div class="row justify-content-end">
                        <div class="col-12">
                            <p class="fs-4 m-0 text-center text-uppercase">Slip Gaji Bulan
                                <span class="fw-bold">{{ $carbon::parse($date)->isoFormat('MMMM Y') }}</span>
                            </p>

                        </div>

                    </div>
                    <hr>
                    {{-- @dd($teacher->salary_position) --}}
                    {{-- identitas --}}
                    <p class="fs-5 m-0">Identitas</p>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama Guru </label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="nama"
                                    value="{{ $teacher->full_name }}" readonly disabled />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="jabatan">Jabatan </label>
                                <input class="form-control" type="text" id="jabatan" name="jabatan"
                                    placeholder="jabatan" value="{{ $teacher->salary_position->salary_pokok->nama }}"
                                    readonly disabled />
                            </div>
                        </div>
                    </div>


                    {{-- presensi --}}

                    @php
                        // presensi
                        $kehadiran = $presence->total_data_presensi - $presence->total_sakit - $presence->total_ijin;
                        $total_telat = $presence->is_late;
                        $total_tepat = $kehadiran - $total_telat;

                        //fee
                        $tot_kehadiran = $kehadiran * $fee_kehadiran;
                        $fee_telat = $total_telat * $potongan_late;

                        $total_fee_kehadiran = $tot_kehadiran - $fee_telat;
                    @endphp
                    <hr>
                    <p class="fs-5 m-0">Presensi bulan <span
                            class="fw-bold">{{ $carbon::parse($date)->isoFormat('MMMM Y') }}</span></p>


                    <div class="row">
                        <div class="col-12 col-md-6">
                            <table class="table table-sm align-middle">
                                <tbody>
                                    <tr>
                                        <td class="twidth">Kehadiran </td>
                                        <td>
                                            <input class="form-control text-end" type="text" id="kehadiran"
                                                name="hadir" placeholder="kehadiran" value="{{ $kehadiran }}"
                                                readonly />
                                            <input class="form-control text-end" type="text" id="tepat"
                                                name="tepat" placeholder="tepat" value="{{ $total_tepat }}" readonly
                                                hidden />
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="fee_kehadiran"
                                                name="fee_kehadiran" placeholder="kehadiran" value="x {{ $fee_kehadiran }}"
                                                readonly disabled />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="twidth">Telat </td>
                                        <td>
                                            <input class="form-control text-end" type="text" id="telat"
                                                name="telat" placeholder="telat" value="{{ $total_telat }}" readonly />
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="potongan_telat"
                                                name="potongan_telat" placeholder="potongan_telat"
                                                value="x {{ $potongan_late }}" readonly disabled />
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <table class="table table-sm align-middle">
                                    <tbody>
                                        <tr>
                                            <td class="twidth"></td>
                                            <td>
                                                <input class="form-control text-end" type="text" id="kehadiran"
                                                    name="kehadiran" placeholder="kehadiran" value="{{ $tot_kehadiran }}"
                                                    readonly disabled />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="twidth"></td>
                                            <td>
                                                <input class="form-control text-end" type="text" id="fee_telat_a"
                                                    name="fee_telat_a" placeholder="fee_telat_a"
                                                    value="- {{ $fee_telat }}" readonly disabled />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Fee Kehadiran</td>
                                            <td>
                                                <input class="form-control text-end" type="text" id="total_fee_kehadiran"
                                                    name="tot_fee_kehadiran" placeholder="kehadiran"
                                                    value="{{ $total_fee_kehadiran }}" readonly />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <hr>
                    {{-- Penghasilan --}}
                    <p class="fs-5 m-0">A. Komponen Penghasilan</p>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="gaji_pokok">1. Gaji Pokok </label>
                                <input class="form-control bg-light" type="text" id="gaji_pokok" name="gaji_pokok"
                                    placeholder="gaji pokok"
                                    value="{{ $teacher->salary_position->salary_pokok->besarnya }}" readonly />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="gaji_fungsional">2. Gaji Fungsional </label>
                                <input class="form-control bg-light" type="text" id="gaji_fungsional"
                                    name="gaji_fungsional" placeholder="gaji fungsional"
                                    value="{{ $teacher->salary_position->salary_fungsional->besarnya }}" readonly />
                            </div>
                        </div>
                    </div>
                    <hr>

                    {{-- data gaji --}}
                    <div class="row">
                        <div class="col">
                            <p class="fs-5 m-0">B. Komponen Penambahan</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="tambahan_1">Ekskul </label>
                                        <select class="form-select" id="tambahan_1" name="ekskul" onchange="added()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($additions as $addition)
                                                <option value="{{ $addition->besarnya }}">
                                                    {{ $addition->nama }} :
                                                    {{ $addition->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="tambahan_2">Istri dan Anak </label>
                                        <select class="form-select" id="tambahan_2" name="istri_anak"
                                            onchange="added()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($additions as $addition)
                                                <option value="{{ $addition->besarnya }}">
                                                    {{ $addition->nama }} :
                                                    {{ $addition->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="tambahan_3">Sukses UN/Khotib </label>
                                        <select class="form-select " id="tambahan_3" name="sukses_un_khotib"
                                            onchange="added()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($additions as $addition)
                                                <option value="{{ $addition->besarnya }}">
                                                    {{ $addition->nama }} :
                                                    {{ $addition->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="tambahan_4">Fee </label>
                                        <select class="form-select" id="tambahan_4" name="fee" onchange="added()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($additions as $addition)
                                                <option value="{{ $addition->besarnya }}">
                                                    {{ $addition->nama }} :
                                                    {{ $addition->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="tambahan_5">Hari Raya </label>
                                        <select class="form-select" id="tambahan_5" name="hari_raya" onchange="added()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($additions as $addition)
                                                <option value="{{ $addition->besarnya }}">
                                                    {{ $addition->nama }} :
                                                    {{ $addition->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <p class="fs-5 m-0">C. Komponen Pengurangan</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="pengurangan_1">DPP </label>
                                        <select class="form-select" id="pengurangan_1" name="dpp"
                                            onchange="reduction()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($reductions as $reduction)
                                                <option value="{{ $reduction->besarnya }}">
                                                    {{ $reduction->nama }}
                                                    :
                                                    {{ $reduction->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="pengurangan_2">Koperasi </label>
                                        <select class="form-select" id="pengurangan_2" name="koperasi"
                                            onchange="reduction()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($reductions as $reduction)
                                                <option value="{{ $reduction->besarnya }}">
                                                    {{ $reduction->nama }}
                                                    :
                                                    {{ $reduction->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="pengurangan_3">Peminjaman </label>
                                        <select class="form-select" id="pengurangan_3" name="peminjaman"
                                            onchange="reduction()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($reductions as $reduction)
                                                <option value="{{ $reduction->besarnya }}">
                                                    {{ $reduction->nama }}
                                                    :
                                                    {{ $reduction->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="pengurangan_4">Dansos </label>
                                        <select class="form-select" id="pengurangan_4" name="dansos"
                                            onchange="reduction()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($reductions as $reduction)
                                                <option value="{{ $reduction->besarnya }}">
                                                    {{ $reduction->nama }}
                                                    :
                                                    {{ $reduction->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="pengurangan_5">BPJS </label>
                                        <select class="form-select" id="pengurangan_5" name="bpjs"
                                            onchange="reduction()">
                                            <option value="0" selected>--- pilih ---</option>
                                            @foreach ($reductions as $reduction)
                                                <option value="{{ $reduction->besarnya }}">
                                                    {{ $reduction->nama }}
                                                    :
                                                    {{ $reduction->besarnya }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    {{-- total --}}
                    <p class="fs-5 m-0">D. Total Rekapitulasi</p>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="komponen_a">Penghasilan </label>
                                <input class="form-control" type="text" id="komponen_a" name="komponen_a"
                                    placeholder="komponen_a" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="komponen_b">Penambahan </label>
                                <input class="form-control" type="number" id="komponen_b" name="komponen_b"
                                    placeholder="komponen_b" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="komponen_c">Pengurangan </label>
                                <input class="form-control" type="number" id="komponen_c" name="komponen_c"
                                    placeholder="komponen_c" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label mb-0" for="total">Total </label>
                            <div class="d-flex align-items-center">
                                <p class="fs-4 m-0">Rp.</p>
                                <input class="form-control fs-4 rupiah" type="text" id="total" name="total"
                                    placeholder="total" readonly />
                            </div>

                            <hr class="mt-1">
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </form>
        </div>
    @endif

@endsection

@push('css')
    <style>
        .rupiah {
            border: none
        }
    </style>
@endpush
@push('scripts')
    <script>
        // seluruh variabel

        // komponen a
        var pokok = Number($('#gaji_pokok').val());
        var fungsional = Number($('#gaji_fungsional').val());
        var kehadiran = Number($('#total_fee_kehadiran').val())
        var komponen_a = $('#komponen_a');

        //komponen b (penambahan) 
        //karena select_html maka tentukan id saja
        var tambahan_1 = $('#tambahan_1');
        var tambahan_2 = $('#tambahan_2');
        var tambahan_3 = $('#tambahan_3');
        var tambahan_4 = $('#tambahan_4');
        var tambahan_5 = $('#tambahan_5');
        var komponen_b = $('#komponen_b');

        //komponen c (pengurangan) 
        //karena select_html maka tentukan id saja
        var pengurangan_1 = $('#pengurangan_1');
        var pengurangan_2 = $('#pengurangan_2');
        var pengurangan_3 = $('#pengurangan_3');
        var pengurangan_4 = $('#pengurangan_4');
        var pengurangan_5 = $('#pengurangan_5');
        var komponen_c = $('#komponen_c');

        //komponen d
        var total = $('#total')

        // seluruh logic
        // a
        var pokok_fungsional = () => {
            var total_komponen_a = pokok + fungsional + kehadiran
            komponen_a.val(total_komponen_a)
            // total.text(total_komponen_a)
            return total_komponen_a
        };
        pokok_fungsional()

        // b
        function added() {
            var total_added = Number(tambahan_1.val()) + Number(tambahan_2.val()) + Number(tambahan_3.val()) +
                Number(tambahan_4.val()) + Number(tambahan_5.val())
            komponen_b.val(total_added)

            // total.text(total_komponen_a() + total_added)
            return total_added
        }

        // c
        function reduction() {
            var total_reduction = Number(pengurangan_1.val()) + Number(pengurangan_2.val()) + Number(pengurangan_3.val()) +
                Number(pengurangan_4.val()) + Number(pengurangan_5.val())
            komponen_c.val(total_reduction)

            // total.text(total_komponen_a() + added() - total_reduction)

            return total_reduction
        }

        // d
        $('.form-select').on('change', () => {
            total.val(pokok_fungsional() + added() - reduction());
        })
    </script>
@endpush
