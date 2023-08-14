<div id="position" class="modal" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class=" p-3">
                <form action="{{ route('position.create') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <fieldset>
                        <div class="mb-3">
                            <label class="form-label" for="gaji_pokok">Nama </label>
                            <select class="form-select" id="pilih_guru" name="teacher_id">
                                <option selected>--- pilih ---</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="gaji_pokok">Jabatan </label>
                            <select class="form-select" id="pilih_jabatan" name="salary_basic_id">
                                <option selected>--- pilih ---</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">
                                        {{ $position->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>

                    </fieldset>
                    <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Jabatan</button>
                </form>

            </div>


        </div>
    </div>
</div>
