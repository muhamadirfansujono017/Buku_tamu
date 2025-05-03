<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Tamu</title>
    <style>
        body {
            font: 12pt "Tahoma", sans-serif;
            margin: 0;
            padding: 20px;
            background: white;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 11pt;
        }

        th, td {
            border: 1px solid black;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f3f3f3;
        }

        .total {
            margin-top: 20px;
            font-weight: bold;
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 20mm;
            }
        }
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
                <th>Tujuan</th>
                <th>Tanggal</th>
                <th>Pesan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $message)
                <tr>
                    <td>{{ $message->guest->nama ?? 'Tamu Tidak Ditemukan' }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->telepon }}</td>
                    <td>{{ $message->alamat }}</td>
                    <td>{{ $message->tujuan }}</td>
                    <td>{{ \Carbon\Carbon::parse($message->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $message->pesan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total Pesan: {{ $data->count() }}</p>

    <script>
        window.print(); // Hapus komentar jika ingin langsung print
    </script>

</body>
</html>
