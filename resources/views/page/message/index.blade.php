{{-- resources/views/page/message/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Pesan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <div class="p-6">
                <a href="{{ route('message.create') }}" class="mb-4 inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Tambah Pesan
                </a>

                <table class="min-w-full table-auto border border-gray-300">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-4 py-2 border">Nama Tamu</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Telepon</th>
                            <th class="px-4 py-2 border">Kategori</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $message)
                            <tr class="border-t text-sm">
                                <td class="px-4 py-2 border">{{ $message->guest->nama }}</td>
                                <td class="px-4 py-2 border">{{ $message->email }}</td>
                                <td class="px-4 py-2 border">{{ $message->telepon }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $message->kategori?->data_tujuan ?? '-' }}
                                </td>
                                <td class="px-4 py-2 border">{{ $message->tanggal }}</td>
                                <td class="px-4 py-2 border space-x-1">
                                    <a href="{{ route('message.show', $message->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                                    <a href="{{ route('message.edit', $message->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('message.destroy', $message->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada pesan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
