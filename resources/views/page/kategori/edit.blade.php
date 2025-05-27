<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-4 bg-white shadow-md mt-6 rounded">
        <h2 class="text-xl font-bold mb-4">Edit Kategori</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block">Nama:</label>
                <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block">Keperluan:</label>
                <input type="text" name="keperluan" value="{{ old('keperluan', $kategori->keperluan) }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block">Pelayanan:</label>
                <input type="text" name="pelayanan" value="{{ old('pelayanan', $kategori->pelayanan) }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block">Tanggal:</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $kategori->tanggal) }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('kategori.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Kembali</a>
            </div>
        </form>
    </div>

</body>
</html>
