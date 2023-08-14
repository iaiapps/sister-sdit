<div class="tab-pane " id="education">

    @if ($teacher->user_id == $id)
        <a href="{{ route('education.create') }}" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i>
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
                            <a href="/education/{{ $teacher->id }}/edit" class="btn btn-warning btn-sm"><i
                                    class="bi bi-pencil-square"></i>
                                edit</a>
                            <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                action="education/{{ $education->id }}" method="post" class="d-inline">
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
                <div class="alert alert-success" role="alert">
                    <p class="text-center m-0">Belum Ada Data</p>
                </div>
            @endforelse
        </tbody>
    </table>
</div>
