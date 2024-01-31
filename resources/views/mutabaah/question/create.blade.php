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
                            <label class="form-label" for="question">Nama Pertanyaan</label>
                            <input class="form-control" type="text" id="question" name="question"
                                placeholder="tuliskan pertanyaan disini ..." />
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-success mt-3 float-end">Simpan Data Pertanyaan</button>
                </form>
            </div>
        </div>
    </div>
</div>
