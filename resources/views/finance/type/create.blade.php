<div id="type" class="modal" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" p-3">
                <form action="{{ route('type.store') }}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="mb-3">
                            <label class="form-label" for="type">Type Gaji </label>
                            <select name="type" id="type" class="form-select">
                                <option selected disabled>--- pilih ---</option>
                                <option value="pokok">Gaji Pokok</option>
                                <option value="fungsional">Gaji Fungsional</option>
                                <option value="tambahan">Penambahan Gaji</option>
                                <option value="pengurangan">Pengurangan Gaji</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama</label>
                            <input class="form-control" type="text" id="nama" name="nama"
                                placeholder="nama type gaji" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="besarnya">Besarnya </label>
                            <input class="form-control" type="number" id="besarnya" name="besarnya"
                                placeholder="besar nominal" />
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Gaji</button>
                </form>
            </div>
        </div>
    </div>
</div>
