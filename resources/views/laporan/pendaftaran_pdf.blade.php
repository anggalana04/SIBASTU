@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftaran Mahasiswa</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #e5e7eb; }
        .status-badge { padding: 2px 8px; border-radius: 4px; font-size: 11px; color: #fff; }
        .badge-success { background: #16a34a; }
        .badge-danger { background: #dc2626; }
        .badge-warning { background: #f59e42; }
        .badge-secondary { background: #64748b; }
    </style>
</head>
<body>
    <h2>Laporan Pendaftaran Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Universitas</th>
                <th>Korwil</th>
                <th>Tanggal Pendaftaran</th>
                <th>Status Berkas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftaran as $val)
                <tr>
                    <td>{{ $val->mahasiswa->Nama_Mahasiswa ?? '-' }}</td>
                    <td>{{ $val->mahasiswa->NIM ?? '-' }}</td>
                    <td>{{ $val->mahasiswa->Jurusan ?? '-' }}</td>
                    <td>{{ $val->mahasiswa->Universitas ?? '-' }}</td>
                    <td>{{ $val->mahasiswa->korwil->Nama_Korwil ?? '-' }}</td>
                    <td>{{ optional($val->berkas->created_at ?? null)->format('d-m-Y') }}</td>
                    <td>
                        @php
                            $status = strtolower($val->Status_Berkas);
                            $badgeClass = match($status) {
                                'terverifikasi' => 'badge-success',
                                'ditolak' => 'badge-danger',
                                'menunggu_verifikasi' => 'badge-warning',
                                default => 'badge-secondary',
                            };
                        @endphp
                        <span class="status-badge {{ $badgeClass }}">{{ ucfirst(str_replace('_',' ',$val->Status_Berkas)) }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="text-align:right;font-size:11px;">Dicetak pada: {{ now()->format('d-m-Y H:i') }}</div>
</body>
</html>
