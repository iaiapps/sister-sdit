<div id="question" class="modal" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pertanyaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" p-3">
                <form action="{{ route('mutabaah-question.store') }}" method="POST">
                    @csrf
                    <fieldset>
                        <div class="mb-3">
                            <label class="form-label" for="category_id">Nama Kategori</label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option disabled>--- pilih kategori ---</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-0" for="question_cat">Kategori pertanyaan untuk? </label>
                            <br>
                            <small>
                                (jika pertanyaan untuk semua isi dengan all)
                                <br>
                                (jika pertanyaan untuk guru isi dengan guru)
                                <br>
                                (jika pertanyaan untuk tendik isi dengan tendik)
                                <br>
                                (jika pertanyaan untuk karyawan isi dengan karyawan)
                            </small>
                            <input class="form-control bg-light" type="text" id="question_cat" name="question_cat"
                                placeholder="Untuk ?" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="question">Pertanyaan</label>
                            <input class="form-control" type="text" id="question" name="question"
                                placeholder="tuliskan pertanyaan disini ..." />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="max_point">Maksimal Point </label>
                            <input class="form-control bg-light" type="text" id="max_point" name="max_point"
                                placeholder="max_point" />
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Pertanyaan</button>
                </form>
            </div>
        </div>
    </div>
</div>
