{{-- resources/views/page/guest/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white leading-tight">
            Data Tamu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('guests.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                    Tambah Tamu
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full table-auto border border-gray-200">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-white text-left">
                            <tr>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border">Telepon</th>
                                <th class="px-4 py-2 border">Alamat</th>
                                <th class="px-4 py-2 border">Kategori</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 dark:text-gray-300">
                            @forelse ($guests as $guest)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2 border">{{ $guest->nama }}</td>
                                    <td class="px-4 py-2 border">{{ $guest->email }}</td>
                                    <td class="px-4 py-2 border">{{ $guest->telepon }}</td>
                                    <td class="px-4 py-2 border">{{ $guest->alamat }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ $guest->kategori ? $guest->kategori->data_tujuan : '-' }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $guest->tanggal }}</td>
                                    <td class="px-4 py-2 border space-x-2">
                                        <a href="{{ route('guests.edit', $guest->id) }}"
                                           class="text-yellow-500 hover:underline">Edit</a>
                                        <form action="{{ route('guests.destroy', $guest->id) }}" method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-2 text-center text-gray-500">
                                        Tidak ada data tamu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $guests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
