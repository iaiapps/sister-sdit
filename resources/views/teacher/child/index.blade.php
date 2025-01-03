<div class="tab-pane " id="child">
    @if ($teacher->user_id == $id)
        <a href="{{ route('guru.child.create') }}" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i>
            Tambah Data</a>
    @endif
    <table class="table table-striped align-middle" id="4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenjang Pendidikan</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                @if ($teacher->user_id == $id)
                    <th>Actions</th>
                @endif

            </tr>
        </thead>
        <tbody>
            @forelse ($teacher->child as $child)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $child->name }}</td>
                    <td>{{ $child->education_level }}</td>
                    <td>{{ $child->gender }}</td>
                    <td>{{ $child->place_of_birth }}, {{ $child->date_of_birth }} </td>
                    <td>
                        @if ($teacher->user_id == $id)
                            <a href="{{ route('guru.child.edit', $child->id) }}" class="btn btn-warning btn-sm"><i
                                    class="bi bi-pencil-square"></i>
                                edit</a>
                            <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                action="{{ route('guru.child.destroy', $child->id) }}" method="post" class="d-inline">
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
                    <td colspan="6" class="text-center fs-5">Belum Ada Data</td>
                </tr>
            @endforelse
            </tr>
        </tbody>
    </table>
</div>
