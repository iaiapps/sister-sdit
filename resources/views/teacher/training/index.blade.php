<div class="tab-pane" id="training">
    @if ($teacher->user_id == $id)
        <a href="{{ route('training.create') }}" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i>
            Tambah Data</a>
    @endif
    <div class="table-responsive">
        <table id="table" class="table table-striped align-middle" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Pelatihan</th>
                    <th scope="col">Nama Pelatihan</th>
                    <th scope="col">Penyelenggara</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Peran</th>
                    @if ($teacher->user_id == $id)
                        <th scope="col">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($teacher->training as $training)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> {{ $training->training_type }}</td>
                        <td>{{ $training->name }}</td>
                        <td>{{ $training->organizer }}</td>
                        <td>{{ $training->year }}</td>
                        <td>{{ $training->training_role }}</td>
                        <td>
                            @if ($teacher->user_id == $id)
                                <a href="/training/{{ $training->id }}/edit" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i>
                                    edit</a>
                                <form onsubmit="return confirm('Apakah anda yakin untuk menghapus data ?');"
                                    action="training/{{ $training->id }}" method="post" class="d-inline">
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
</div>
