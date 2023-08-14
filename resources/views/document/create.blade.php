<div class="modal fade" id="document" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Dokumen (bentuk jpg/png)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="jenisprestasi">Jenis Dokumen
                        </label>
                        <select class="form-select" id="jenisprestasi" required name="type">
                            <option selected disabled>Pilih</option>
                            <option value="kartu_keluarga">Kartu Keluarga</option>
                            <option value="akta_kelahiran">Akta Kelahiran</option>
                            <option value="ijazah">Ijazah</option>
                            <option value="piagam_sertifikat">Piagam/Sertifikat</option>
                            <option value="ktp">KTP</option>
                            <option value="npwp">NPWP</option>
                            <option value="foto_profil">Foto Profil</option>
                            <option value="sk_yayasan">SK Yayasan</option>
                        </select>
                    </div>
                    <input class="form-control" type="file" name="file" class="pt-2">
                    <button type="submit" class="btn btn-primary mt-3 float-end">Upload Dokumen</button>
                </form>
            </div>

        </div>
    </div>
</div>
