<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Print Laporan Tamu</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Tamu</h2>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Kategori</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->guest->nama ?? '-' }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->telepon ?? '-' }}</td>
                    <td>{{ $message->alamat ?? '-' }}</td>
                    <td>{{ $message->kategori_id ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($message->tanggal)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
