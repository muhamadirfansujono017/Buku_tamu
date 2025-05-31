<x-app-layout>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Kategori</h1>
        <div class="flex space-x-3">
            <a href="{{ route('kategori.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded shadow transition">
               + Tambah Kategori
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-5 py-3 border">No</th>
                    <th class="px-5 py-3 border">Nama</th>
                    <th class="px-5 py-3 border">Keperluan</th>
                    <th class="px-5 py-3 border">Pelayanan</th>
                    <th class="px-5 py-3 border">Tanggal</th>
                    <th class="px-5 py-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $index => $item)
                    <tr class="hover:bg-gray-50 border-b border-gray-200">
                        <td class="px-5 py-3">{{ $kategori->firstItem() + $index }}</td>
                        <td class="px-5 py-3">{{ $item->nama }}</td>
                        <td class="px-5 py-3">{{ $item->keperluan }}</td>
                        <td class="px-5 py-3">{{ $item->pelayanan }}</td>
                        <td class="px-5 py-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td class="px-5 py-3 space-x-3">
                            <a href="{{ route('kategori.edit', $item->id) }}" 
                               class="text-blue-600 hover:underline font-semibold">Edit</a>
                            <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:underline font-semibold ml-2">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            Tidak ada data kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $kategori->links('pagination::tailwind') }}
    </div>
</div>

</body>
</html>
</x-app-layout>
