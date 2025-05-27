<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">Manajemen Kategori</h1>
        <a href="{{ route('kategori.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow transition">
            + Tambah Kategori
        </a>
    </div>

    <!-- Filter -->
    <form method="GET" action="{{ route('kategori.index') }}" class="mb-4 flex items-center gap-4">
        <label for="nama" class="text-sm font-medium text-gray-600">Filter Nama:</label>
        <select name="nama" id="nama" class="p-2 border rounded w-64">
            <option value="">-- Semua --</option>
            @foreach($allNama as $namaItem)
                <option value="{{ $namaItem }}" {{ request('nama') == $namaItem ? 'selected' : '' }}>
                    {{ $namaItem }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 transition">
            Terapkan
        </button>
    </form>

    <!-- Alert -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white border border-gray-200 text-sm">
            <thead class="bg-gray-100 text-left text-gray-600 uppercase">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Keperluan</th>
                    <th class="px-4 py-2 border">Pelayanan</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($kategori as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $kategori->firstItem() + $index }}</td>
                        <td class="px-4 py-2 border">{{ $item->nama }}</td>
                        <td class="px-4 py-2 border">{{ $item->keperluan }}</td>
                        <td class="px-4 py-2 border">{{ $item->pelayanan }}</td>
                        <td class="px-4 py-2 border">{{ $item->tanggal }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('kategori.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Tidak ada data kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $kategori->appends(['nama' => request('nama')])->links() }}
    </div>
</div>

</body>
</html>
