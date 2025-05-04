<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Form Filter -->
                    <form action="{{ route('laporantamu.index') }}" method="GET" class="space-y-4 mb-6">
                        <div class="flex flex-wrap gap-4 items-end">
                            <div>
                                <label for="start_date" class="block text-sm font-medium">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="start_date" class="rounded border-gray-300 dark:bg-gray-700 dark:text-white" value="{{ request('start_date') }}">
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium">Tanggal Selesai</label>
                                <input type="date" name="end_date" id="end_date" class="rounded border-gray-300 dark:bg-gray-700 dark:text-white" value="{{ request('end_date') }}">
                            </div>

                            <div>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                    Filter
                                </button>
                            </div>

                            @if (request('start_date') || request('end_date'))
                                <div>
                                    <a href="{{ route('laporantamu.index') }}" class="text-red-500 hover:underline text-sm">Reset Filter</a>
                                </div>
                            @endif
                        </div>
                    </form>

                    <!-- Jumlah Data -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Jumlah Pesan: {{ $messageCount }}</h3>
                        @if ($messageCount > 0)
                            <div class="flex space-x-4 mt-2">
                                <a href="{{ route('laporantamu.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                                    Ekspor ke Excel
                                </a>

                                <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                    Print Laporan
                                </button>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Tabel Data -->
                    @if ($messages->isEmpty())
                        <p class="text-gray-500">Tidak ada data untuk ditampilkan.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Nama</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Email</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Telepon</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Alamat</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Tujuan</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Tanggal</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Pesan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($messages as $message)
                                        <tr>
                                            <td class="px-4 py-2">{{ $message->guest->nama ?? 'Tamu Tidak Ditemukan' }}</td>
                                            <td class="px-4 py-2">{{ $message->email }}</td>
                                            <td class="px-4 py-2">{{ $message->telepon ?? 'Tidak Diketahui' }}</td>
                                            <td class="px-4 py-2">{{ $message->alamat ?? 'Tidak Diketahui' }}</td>
                                            <td class="px-4 py-2">{{ $message->tujuan ?? 'Tidak Diketahui' }}</td>
                                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($message->tanggal)->format('d-m-Y') }}</td>
                                            <td class="px-4 py-2">{{ $message->pesan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
