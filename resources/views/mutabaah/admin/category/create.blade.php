<div id="kategori" class="modal" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" p-3">
                <form action="{{ route('mutabaah-category.store') }}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="mb-3">
                            <label class="form-label" for="nama_kategori">Nama kategori</label>
                            <input class="form-control" type="text" id="nama_kategori" name="nama_kategori"
                                placeholder="nama kategori" />
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Kategori</button>
                </form>
            </div>
        </div>
    </div>
</div>
