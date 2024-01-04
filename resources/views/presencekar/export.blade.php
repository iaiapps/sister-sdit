<p class="text-center">Presensi bulan : {{ $date }}</p>
<div class="table-responsive">
    <table id="table" class="table table-striped align-middle" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col" class="w-100">Nama</th>
                <th scope="col">Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presences as $presence)
                <tr>
                    <td>{{ $presence->teacher_id }}</td>
                    <td class="w-100">{{ $presence->teacher->full_name }}</td>
                    <td>{{ $presence->total_data_presensi }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
