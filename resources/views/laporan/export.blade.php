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
        @foreach ($messages as $message)
            <tr>
                <td>{{ $message->guest->nama ?? '-' }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->telepon ?? '-' }}</td>
                <td>{{ $message->alamat ?? '-' }}</td>
                <td>{{ $message->tujuan ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($message->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $message->pesan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
