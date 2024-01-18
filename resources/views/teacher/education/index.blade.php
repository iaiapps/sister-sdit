<div class="tab-pane " id="education">

    @if ($teacher->user_id == $id)
        <a href="{{ route('guru.education.create') }}" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i>
            Tambah Data</a>
    @endif

    <table id="table" class="table table-striped align-middle" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Jenjang Pendidikan</th>
                <th scope="col">Nama Satuan Pendidikan</th>
                <th scope="col">Fakultas/Jurusan</th>
                <th scope="col">Tahun Masuk</th>
                <th scope="col">Tahun Lulus</th>
                @if ($teacher->user_id == $id)
                    <th scope="col">Actions</th>
                @endif

            </tr>
        </thead>
        <tbody>
            @forelse ($teacher->education as $education)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> {{ $education->education_level }}</td>
                    <td>{{ $education->school_name }}</td>
                    <td>{{ $education->department }}</td>
                    <td>{{ $education->enter_year }}</td>
                    <td>{{ $education->graduation_year }}</td>
                    <td>
                        @if ($teacher->user_id == $id)
                            <a href="{{ route('guru.education.edit', $education->id) }}"
                                class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>
                                edit</a>
                            <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                action="{{ route('guru.education.destroy', $education->id) }}" method="post"
                                class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash3"></i> del
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr class="alert alert-light mt-3" role="alert">
                    <td colspan="7" class="text-center fs-5">Belum Ada Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
