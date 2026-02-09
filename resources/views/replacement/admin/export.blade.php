@inject('carbon', 'Carbon\Carbon')
<table>
    <thead>
        <tr>
            <th colspan="10" style="text-align: center; font-size: 14px; font-weight: bold;">
                DATA GURU PENGGANTI
            </th>
        </tr>
        <tr>
            <th colspan="10" style="text-align: center; font-size: 12px;">
                Periode: {{ $carbon::parse($awal)->isoFormat('DD MMMM YYYY') }} - {{ $carbon::parse($akhir)->isoFormat('DD MMMM YYYY') }}
            </th>
        </tr>
        <tr></tr>
        <tr>
            <th style="border: 1px solid black; font-weight: bold;">No</th>
            <th style="border: 1px solid black; font-weight: bold;">Pengganti</th>
            <th style="border: 1px solid black; font-weight: bold;">Menggantikan</th>
            <th style="border: 1px solid black; font-weight: bold;">Tanggal</th>
            <th style="border: 1px solid black; font-weight: bold;">Jam</th>
            <th style="border: 1px solid black; font-weight: bold;">Mapel</th>
            <th style="border: 1px solid black; font-weight: bold;">Alasan</th>
            <th style="border: 1px solid black; font-weight: bold;">Tugas</th>
            <th style="border: 1px solid black; font-weight: bold;">Diisi dengan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($replacements as $replacement)
            <tr>
                <td style="border: 1px solid black;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid black;">{{ $replacement->teacher->full_name }}</td>
                <td style="border: 1px solid black;">{{ $replacement->menggantikan }}</td>
                <td style="border: 1px solid black;">{{ $carbon::parse($replacement->tanggal)->isoFormat('DD/MM/YYYY') }}</td>
                <td style="border: 1px solid black;">{{ $replacement->jp }}</td>
                <td style="border: 1px solid black;">{{ $replacement->mapel }}</td>
                <td style="border: 1px solid black;">{{ $replacement->alasan }}</td>
                <td style="border: 1px solid black;">{{ $replacement->bahan }}</td>
                <td style="border: 1px solid black;">{{ $replacement->diisi_dengan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
