<div class="tab-pane " id="child">
    @if ($teacher->user_id == $id)
        <a href="{{ route('child.create') }}" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i>
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
                <th>Actions</th>

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
                        <a href="/child/{{ $child->id }}/edit" class="btn btn-warning btn-sm"><i
                                class="bi bi-pencil-square"></i>
                            edit</a>
                        <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                            action="/child/{{ $child->id }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash3"></i> del
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <div class="alert alert-success" role="alert">
                    <p class="text-center m-0">Belum Ada Data</p>
                </div>
            @endforelse
            </tr>
        </tbody>
    </table>
</div>
