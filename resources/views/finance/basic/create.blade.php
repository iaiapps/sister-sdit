<div id="basic" class="modal" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class=" p-3">
                <form action="{{ route('basic.store') }}" method="POST">
                    @csrf
                    <fieldset>

                        <div class="mb-3">
                            <label class="form-label" for="nama_jabatan">Nama Jabatan </label>
                            <input class="form-control" type="text" id="nama_jabatan" name="nama_jabatan"
                                placeholder="nama jabatan" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="gaji_pokok">Gaji Pokok </label><input class="form-control"
                                type="number" id="gaji_pokok" name="gaji_pokok" placeholder="gaji pokok" />
                        </div>

                    </fieldset>
                    <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Gaji</button>
                </form>

            </div>


        </div>
    </div>
</div>
