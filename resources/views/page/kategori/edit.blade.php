<x-app-layout>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded shadow-md max-w-md w-full p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Kategori</h2>

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
                <label for="nama" class="block mb-2 font-semibold text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" 
                    value="{{ old('nama', $kategori->nama) }}" 
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label for="keperluan" class="block mb-2 font-semibold text-gray-700">Keperluan</label>
                <input type="text" id="keperluan" name="keperluan" 
                    value="{{ old('keperluan', $kategori->keperluan) }}" 
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label for="pelayanan" class="block mb-2 font-semibold text-gray-700">Pelayanan</label>
                <input type="text" id="pelayanan" name="pelayanan" 
                    value="{{ old('pelayanan', $kategori->pelayanan) }}" 
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label for="tanggal" class="block mb-2 font-semibold text-gray-700">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" 
                    value="{{ old('tanggal', $kategori->tanggal) }}" 
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div class="flex space-x-4">
                <button type="submit" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded font-semibold transition">
                    Update
                </button>
                <a href="{{ route('kategori.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded font-semibold transition flex items-center justify-center">
                   Kembali
                </a>
            </div>
        </form>
    </div>

</body>
</html>
</x-app-layout>