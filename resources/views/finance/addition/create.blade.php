<div id="addition" class="modal" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class=" p-3">
                <form action="{{ route('addition.store') }}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="mb-3">
                            <label class="form-label" for="nama_penambahan">Nama Penambahan </label>
                            <input class="form-control" type="text" id="nama_penambahan" name="nama_penambahan"
                                placeholder="nama penambahan" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="besarnya">Besarnya </label><input class="form-control"
                                type="number" id="besarnya" name="besarnya" placeholder="besarnya" />
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Gaji</button>
                </form>
            </div>
        </div>
    </div>
</div>
