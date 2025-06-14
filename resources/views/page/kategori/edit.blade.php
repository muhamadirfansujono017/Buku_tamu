<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">Edit Kategori</h2>
    </x-slot>

    <div class="flex justify-center py-12 px-4">
        <div class="bg-white rounded shadow-md max-w-md w-full p-8">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="data_tujuan" class="block mb-2 font-semibold text-gray-700">Data Tujuan</label>
                    <input type="text" id="data_tujuan" name="data_tujuan" 
                        value="{{ old('data_tujuan', $kategori->data_tujuan) }}" 
                        required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>

                <div class="flex space-x-4">
                    <button type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded font-semibold transition">
                        Update
                    </button>
                    <a href="{{ route('kategori.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded font-semibold transition">
                       Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
