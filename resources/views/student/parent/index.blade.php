<div class="tab-pane " id="parent">
    @if ($student->parent == null)
        <div class="alert alert-success text-center" role="alert">
            <p class="fs-5">Belum Ada Data Orang Tua</p>

            <a href="{{ route('student-parent.create') }}" class="btn btn-success mb-3">
                Buat Data</a>
        </div>
    @else
        @if ($student->user_id == $id)
            <a href="{{ route('student-parent.edit', $student->parent->id) }}" class="btn btn-success mb-3"><i
                    class="bi bi-plus-circle"></i>
                Ubah Data</a>
        @endif
        <div class="row">
            <div class="col">
                <p class="fw-bold">Data Ayah</p>
                <table class="table table-striped align-middle" id="4">
                    <tbody>

                        <tr>
                            <td>Nama Ayah</td>
                            <td>{{ $student->parent->nama_ayah }}</td>
                        </tr>
                        <tr>
                            <td>NIK Ayah</td>
                            <td>{{ $student->parent->nik_ayah }}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>{{ $student->parent->tempat_lahir_ayah }}, {{ $student->parent->tanggal_lahir_ayah }}
                            </td>
                        </tr>
                        <tr>
                            <td>Pendidikan</td>
                            <td>{{ $student->parent->pendidikan_ayah }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>{{ $student->parent->pekerjaan_ayah }}</td>
                        </tr>
                        <tr>
                            <td>Penghasilan</td>
                            <td>{{ $student->parent->penghasilan_ayah }}</td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td>{{ $student->parent->hp_ayah }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col">
                <p class="fw-bold">Data Ibu</p>
                <table class="table table-striped align-middle" id="4">
                    <tbody>
                        <tr>
                            <td>Nama ibu</td>
                            <td>{{ $student->parent->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <td>NIK ibu</td>
                            <td>{{ $student->parent->nik_ibu }}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>{{ $student->parent->tempat_lahir_ibu }}, {{ $student->parent->tanggal_lahir_ibu }}
                            </td>
                        </tr>
                        <tr>
                            <td>Pendidikan</td>
                            <td>{{ $student->parent->pendidikan_ibu }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>{{ $student->parent->pekerjaan_ibu }}</td>
                        </tr>
                        <tr>
                            <td>Penghasilan</td>
                            <td>{{ $student->parent->penghasilan_ibu }}</td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td>{{ $student->parent->hp_ibu }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif


</div>
