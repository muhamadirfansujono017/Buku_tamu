<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-gray-800">Tambah Kategori</h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto bg-white rounded shadow">
        <form method="POST" action="{{ route('kategori.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Data Tujuan</label>
                <input type="text" name="data_tujuan" value="{{ old('data_tujuan') }}"
                    class="w-full mt-1 border-gray-300 rounded shadow-sm">
                @error('data_tujuan')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('kategori.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
