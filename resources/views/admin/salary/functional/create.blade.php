<div id="functional" class="modal" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class=" p-3">
                <form action="{{ route('functional.store') }}" method="POST">
                    @csrf
                    <fieldset>

                        <div class="mb-3">
                            <label class="form-label" for="nama_fungsional">Nama Fungsional </label>
                            <input class="form-control" type="text" id="nama_fungsional" name="nama_fungsional"
                                placeholder="nama jabatan" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="gaji_fungsional">Gaji Fungsional </label><input
                                class="form-control" type="number" id="gaji_fungsional" name="gaji_fungsional"
                                placeholder="gaji fungsional" />
                        </div>

                    </fieldset>
                    <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Gaji</button>
                </form>

            </div>


        </div>
    </div>
</div>
