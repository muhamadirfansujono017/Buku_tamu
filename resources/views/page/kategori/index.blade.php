<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">Manajemen Kategori</h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-sm text-green-700 bg-green-100 border border-green-400 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('kategori.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                + Tambah Kategori
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Data Tujuan</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $kategori->firstItem() + $index }}</td>
                            <td class="px-4 py-2 border">{{ $item->data_tujuan }}</td>
                            <td class="px-4 py-2 border space-x-2">
                                <a href="{{ route('kategori.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">Data tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $kategori->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>
