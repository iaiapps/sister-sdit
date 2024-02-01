<div id="pilihan" class="modal" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pilihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" p-3">
                <form action="{{ route('mutabaah-option.store') }}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="mb-3">
                            <label class="form-label" for="option_name">Pilihan</label>
                            <input class="form-control" type="text" id="option_name" name="option_name"
                                placeholder="Pilihan" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="option_point">Point Pilihan</label>
                            <input class="form-control" type="text" id="option_point" name="option_point"
                                placeholder="Point Pilihan" />
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
