<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Data Tamu
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('guests.update', $guest->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Nama</label>
                <input type="text" name="nama" class="input-field" required value="{{ old('nama', $guest->nama) }}">
            </div>

            <div>
                <label class="block font-medium">Email</label>
                <input type="email" name="email" class="input-field" required value="{{ old('email', $guest->email) }}">
            </div>

            <div>
                <label class="block font-medium">Telepon</label>
                <input type="text" name="telepon" class="input-field" value="{{ old('telepon', $guest->telepon) }}">
            </div>

            <div>
                <label class="block font-medium">Alamat</label>
                <input type="text" name="alamat" class="input-field" value="{{ old('alamat', $guest->alamat) }}">
            </div>

            <div>
                <label class="block font-medium">Kategori</label>
                <select name="kategori_id" class="input-field" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id', $guest->kategori_id) == $kat->id ? 'selected' : '' }}>
                            {{ $kat->data_tujuan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Tanggal</label>
                <input type="date" name="tanggal" class="input-field" required value="{{ old('tanggal', $guest->tanggal) }}">
            </div>

            <div>
                <button type="submit" class="btn-primary">Perbarui</button>
            </div>
        </form>
    </div>

    <style>
        .input-field {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 0.375rem;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }
    </style>
</x-app-layout>
