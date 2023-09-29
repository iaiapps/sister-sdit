<p class="text-align">Presensi bulan : {{ $date }}</p>
<div class="table-responsive">
    <table id="table" class="table table-striped align-middle" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Kehadiran</th>
                {{-- <th scope="col">Late_type</th> --}}
                <th scope="col">Terlambat</th>
                <th scope="col">Sakit</th>
                <th scope="col">Ijin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presences as $presence)
                <tr>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $presence->teacher_id }}</td>
                    <td>{{ $presence->teacher->full_name }}</td>
                    <td>{{ $presence->total_kehadiran - $presence->total_sakit - $presence->total_ijin }}</td>
                    {{-- <td>
                        <span class="m-0">telat a : {{ $presence->is_late_a }}</span>
                        <br> <span class="m-0">telat b : {{ $presence->is_late_b }}</span>
                        <br> <span class="m-0">telat c : {{ $presence->is_late_c }}</span>
                    </td> --}}
                    <td>
                        {{ $presence->is_late }}
                        {{-- {{ $presence->is_late_a + $presence->is_late_b + $presence->is_late_c }} --}}
                    </td>
                    <td>{{ $presence->total_sakit }}</td>
                    <td>{{ $presence->total_ijin }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
