<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Tambah Data Tamu
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-6 sm:px-8 bg-white dark:bg-gray-900 shadow rounded-lg">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <strong class="block font-semibold mb-2">Terjadi kesalahan:</strong>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('guests.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="nama" class="block font-medium text-gray-700 dark:text-gray-200">Nama</label>
                <input type="text" name="nama" id="nama"
                       class="input-field"
                       required value="{{ old('nama') }}">
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700 dark:text-gray-200">Email</label>
                <input type="email" name="email" id="email"
                       class="input-field"
                       required value="{{ old('email') }}">
            </div>

            <div>
                <label for="telepon" class="block font-medium text-gray-700 dark:text-gray-200">Telepon</label>
                <input type="text" name="telepon" id="telepon"
                       class="input-field"
                       value="{{ old('telepon') }}">
            </div>

            <div>
                <label for="alamat" class="block font-medium text-gray-700 dark:text-gray-200">Alamat</label>
                <input type="text" name="alamat" id="alamat"
                       class="input-field"
                       value="{{ old('alamat') }}">
            </div>

            <div>
                <label for="kategori_id" class="block font-medium text-gray-700 dark:text-gray-200">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="input-field" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->data_tujuan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tanggal" class="block font-medium text-gray-700 dark:text-gray-200">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal"
                       class="input-field"
                       required value="{{ old('tanggal', date('Y-m-d')) }}">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <style>
        .input-field {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: #f9fafb;
            color: #111827;
            transition: border-color 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: #2563eb;
            background-color: white;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }
    </style>
</x-app-layout>
