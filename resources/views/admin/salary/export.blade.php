<table>
    <thead>
        <tr>
            <th>teacher_id</th>
            <th>nama</th>
            <th>nomor_slip</th>
            <th>bulan</th>
            <th>hadir</th>
            <th>tepat</th>
            <th>telat</th>
            <th>gaji_pokok</th>
            <th>gaji_fungsional</th>
            <th>tot_fee_kehadiran</th>
            <th>ekskul </th>
            <th>istri_anak </th>
            <th>sukses_un_khotib </th>
            <th>fee </th>
            <th>hari_raya </th>
            <th>dpp </th>
            <th>koperasi </th>
            <th>peminjaman </th>
            <th>dansos </th>
            <th>bpjs </th>
            <th>komponen_a </th>
            <th>komponen_b </th>
            <th>komponen_c </th>
            <th>total </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presences as $presence)
            @php
                // presensi
                $kehadiran = $presence->total_data_presensi - $presence->total_sakit - $presence->total_ijin;
                $telat_a = $presence->is_late_a;
                $telat_b = $presence->is_late_b;
                $telat_c = $presence->is_late_c;
                
                $total_tepat = $kehadiran - $telat_a - $telat_b - $telat_c;
                $total_telat = $telat_a + $telat_b + $telat_c;
                
                //fee
                $tot_kehadiran = $kehadiran * $fee_kehadiran;
                $fee_telat_a = $telat_a * $potongan_late_a;
                $fee_telat_b = $telat_b * $potongan_late_b;
                $fee_telat_c = $telat_c * $potongan_late_c;
                
                $total_fee_kehadiran = $tot_kehadiran - $fee_telat_a - $fee_telat_b - $fee_telat_c;
            @endphp
            {{-- @dd($total_fee_kehadiran) --}}
            <tr>
                <td>{{ $presence->teacher->id }}</td>
                <td>{{ $presence->teacher->full_name }}</td>
                <td>{{ $presence->teacher->id . \Carbon\Carbon::parse($date)->format('dmY') }}</td>
                <td>{{ $date }}</td>
                <td>{{ $kehadiran }}</td>
                <td>{{ $total_tepat }}</td>
                <td>{{ $total_telat }}</td>
                <td>{{ $presence->teacher->salary_basic->gaji_pokok }}</td>
                <td>{{ $presence->teacher->salary_functional->gaji_fungsional }}</td>
                <td>{{ $total_fee_kehadiran }}</td>
                <td>{{ $presence->ekskul }}</td>
                <td>{{ $presence->istri_anak }}</td>
                <td>{{ $presence->sukses_un_khotib }}</td>
                <td>{{ $presence->fee }}</td>
                <td>{{ $presence->hari_raya }}</td>
                <td>{{ $presence->dpp }}</td>
                <td>{{ $presence->koperasi }}</td>
                <td>{{ $presence->peminjaman }}</td>
                <td>{{ $presence->dansos }}</td>
                <td>{{ $presence->bpjs }}</td>
                <td>{{ $presence->komponen_a }}</td>
                <td>{{ $presence->komponen_b }}</td>
                <td>{{ $presence->komponen_c }}</td>
                <td>{{ $presence->total }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
