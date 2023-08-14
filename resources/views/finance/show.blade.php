@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')

@section('title', 'List Data Gaji')
@section('content')

    <div class="bg-white px-3 rounded mb-3">
        <a href="{{ URL::previous() }}" class="btn btn-success">
            <i class="bi bi-arrow-left-circle"></i> kembali
        </a>
        <button class="mt-3 mb-3 btn btn-outline-success" onclick="print()">print slip gaji </button>
    </div>
    <div id="printarea" class="bg-white p-3 rounded ">
        <div class="row">
            <div class="col">

                <img src="{{ asset('img/kop.svg') }}" class="kop" alt="kop">
            </div>
            <div class="col">
                <div>
                    <p class="fs-4 fw-bold m-0">SLIP GAJI SDIT HARUM</p>
                    <p class="py-1">Bulan : {{ $carbon::parse($salary->bulan)->isoFormat('MMMM Y') }}</p>
                </div>
            </div>
        </div>

        <hr class="mt-0">
        <div class="row">
            <div class="col">
                <table class="table table-sm align-middle">
                    <tbody>
                        <tr>
                            <td class="twidth">Nomor</td>
                            <td>: {{ $salary->nomor_slip }}</td>
                        </tr>
                        <tr>
                            <td class="twidth">Nama</td>
                            <td>: {{ $salary->teacher->full_name }}</td>
                        </tr>
                        <tr>
                            <td class="twidth">Jabatan</td>
                            <td>: {{ $salary->teacher->salary_basic->nama_jabatan }}</td>
                        </tr>

                    </tbody>
                </table>


            </div>
            <div class="col">
                <table class="table table-sm align-middle">
                    <tbody>
                        <tr>
                            <td class="twidthp">kehadiran : </td>
                            <td>: {{ $salary->hadir }}</td>
                        </tr>
                        <tr>
                            <td class="twidthp">Tepat waktu</td>
                            <td>: {{ $salary->tepat }}</td>
                        </tr>
                        <tr>
                            <td class="twidthp">Terlambat</td>
                            <td>: {{ $salary->telat }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-12 col-md-4 ">
                <table class="table table-sm align-middle">
                    <span class="fw-bold">A. Penghasilan</span>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Gaji Pokok</td>
                            <td class="text-end">@currency($salary->gaji_pokok) </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Gaji Fungsional</td>
                            <td class="text-end">@currency($salary->gaji_fungsional) </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kehadiran</td>
                            <td class="text-end">@currency($salary->tot_fee_kehadiran)</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-4">
                <table class="table table-sm align-middle">
                    <span class="fw-bold">B. Penambahan</span>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ekskul</td>
                            <td class="text-end">@currency($salary->ekskul)</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Istri & Anak</td>
                            <td class="text-end">@currency($salary->istri_anak)</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Sukses UN/Khotib</td>
                            <td class="text-end">@currency($salary->sukses_un_khotib)</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Fee</td>
                            <td class="text-end">@currency($salary->fee)</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Hari Raya</td>
                            <td class="text-end">@currency($salary->hari_raya)</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-4">
                <table class="table table-sm align-middle">
                    <span class="fw-bold">C. Pengurangan</span>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>DPP</td>
                            <td class="text-end">@currency($salary->dpp)</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Koperasi</td>
                            <td class="text-end">@currency($salary->koperasi)</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Peminjaman</td>
                            <td class="text-end">@currency($salary->peminjaman)</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Dansos</td>
                            <td class="text-end">@currency($salary->dansos)</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>BPJS</td>
                            <td class="text-end">@currency($salary->bpjs)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr class="mt-0">

        <div class="row ">
            <div class="col-12 col-md-6">
                <table class="table table-sm align-middle">
                    <span class="fw-bold">D. Rekapitulasi</span>
                    <tbody>
                        <tr>
                            <td>Penghasilan</td>
                            <td class="text-end">@currency($salary->komponen_a)</td>
                        </tr>
                        <tr>
                            <td>Penambahan</td>
                            <td class="text-end">@currency($salary->komponen_b)</td>
                        </tr>
                        <tr>
                            <td>Pengurangan</td>
                            <td class="text-end">@currency($salary->komponen_c)</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Gaji yang diterima</td>
                            <td class="fs-4 text-end fw-bold">@currency($salary->total)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <div class="boxttd mt-5 text-center position-relative clearfix">
                    <p>Jember, {{ $carbon::parse($salary->bulan)->isoFormat('DD MMMM Y') }} </p>
                    <div class="imgttd">
                        <img src="{{ asset('img/stam.png') }}" alt="stempel" />
                    </div>
                    <p class="mt-5 fw-bold">Bendahara SDIT Harum</p>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('css')
    <style>
        .kop {
            width: 350px
        }

        .twidth {
            width: 80px;
        }

        .twidthp {
            width: 110px;
        }

        .imgttd {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
        }

        .imgttd img {
            width: 110px;
            text-align: center;
        }

        @media print {

            body {
                visibility: hidden;
                background-color: white !important
            }

            #page {
                margin-left: 0px !important;
            }

            #printarea {

                visibility: visible !important;
                position: absolute !important;
                left: 0;
                right: 0;
                top: 0;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        print() {
            window.print();
        },
    </script>
@endpush
