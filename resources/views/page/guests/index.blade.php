<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Data Tamu
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tombol Tambah --}}
        <div class="flex justify-end mb-4">
            <button
                onclick="openCreateModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                + Tambah Tamu
            </button>
        </div>

        {{-- Tabel Data --}}
        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 bg-white dark:bg-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tujuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($guests as $index => $guest)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $guests->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $guest->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $guest->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $guest->telepon ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $guest->tujuan ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($guest->tanggal)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                            <button
                                onclick="openEditModal(@json($guest))"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                Edit
                            </button>
                            <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus tamu ini?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">Data tamu kosong.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $guests->links() }}
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Tambah Tamu</h3>
            <form id="formCreate" action="{{ route('guests.store') }}" method="POST" novalidate>
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="nama_create" class="block font-medium">Nama <span class="text-red-600">*</span></label>
                        <input type="text" name="nama" id="nama_create" class="input-field" required>
                    </div>
                    <div>
                        <label for="email_create" class="block font-medium">Email <span class="text-red-600">*</span></label>
                        <input type="email" name="email" id="email_create" class="input-field" required>
                    </div>
                    <div>
                        <label for="telepon_create" class="block font-medium">Telepon</label>
                        <input type="text" name="telepon" id="telepon_create" class="input-field">
                    </div>
                    <div>
                        <label for="alamat_create" class="block font-medium">Alamat</label>
                        <input type="text" name="alamat" id="alamat_create" class="input-field">
                    </div>
                    <div>
                        <label for="tujuan_create" class="block font-medium">Tujuan</label>
                        <input type="text" name="tujuan" id="tujuan_create" class="input-field">
                    </div>
                    <div>
                        <label for="tanggal_create" class="block font-medium">Tanggal <span class="text-red-600">*</span></label>
                        <input type="date" name="tanggal" id="tanggal_create" class="input-field" required>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeCreateModal()" class="btn-secondary px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="btn-primary px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Edit Tamu</h3>
            <form id="formEdit" method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="nama_edit" class="block font-medium">Nama <span class="text-red-600">*</span></label>
                        <input type="text" name="nama" id="nama_edit" class="input-field" required>
                    </div>
                    <div>
                        <label for="email_edit" class="block font-medium">Email <span class="text-red-600">*</span></label>
                        <input type="email" name="email" id="email_edit" class="input-field" required>
                    </div>
                    <div>
                        <label for="telepon_edit" class="block font-medium">Telepon</label>
                        <input type="text" name="telepon" id="telepon_edit" class="input-field">
                    </div>
                    <div>
                        <label for="alamat_edit" class="block font-medium">Alamat</label>
                        <input type="text" name="alamat" id="alamat_edit" class="input-field">
                    </div>
                    <div>
                        <label for="tujuan_edit" class="block font-medium">Tujuan</label>
                        <input type="text" name="tujuan" id="tujuan_edit" class="input-field">
                    </div>
                    <div>
                        <label for="tanggal_edit" class="block font-medium">Tanggal <span class="text-red-600">*</span></label>
                        <input type="date" name="tanggal" id="tanggal_edit" class="input-field" required>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="btn-secondary px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="btn-primary px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Styles tambahan --}}
    <style>
        .input-field {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 0.375rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.3);
        }
        .btn-primary {
            transition: background-color 0.3s;
        }
        .btn-secondary {
            background-color: #e5e7eb;
            color: #374151;
            transition: background-color 0.3s;
        }
        .btn-secondary:hover {
            background-color: #d1d5db;
        }
    </style>

    {{-- Script modal --}}
    <script>
        // Fungsi buka modal tambah
        function openCreateModal() {
            document.getElementById('modalCreate').classList.remove('hidden');
        }
        function closeCreateModal() {
            document.getElementById('modalCreate').classList.add('hidden');
            // reset form
            document.getElementById('formCreate').reset();
        }

        // Fungsi buka modal edit dengan isi data
        function openEditModal(guest) {
            const formEdit = document.getElementById('formEdit');
            formEdit.action = `/guests/${guest.id}`;

            document.getElementById('nama_edit').value = guest.nama || '';
            document.getElementById('email_edit').value = guest.email || '';
            document.getElementById('telepon_edit').value = guest.telepon || '';
            document.getElementById('alamat_edit').value = guest.alamat || '';
            document.getElementById('tujuan_edit').value = guest.tujuan || '';

            if(guest.tanggal) {
                const tanggal = new Date(guest.tanggal);
                const yyyy = tanggal.getFullYear();
                const mm = String(tanggal.getMonth() + 1).padStart(2, '0');
                const dd = String(tanggal.getDate()).padStart(2, '0');
                document.getElementById('tanggal_edit').value = `${yyyy}-${mm}-${dd}`;
            } else {
                document.getElementById('tanggal_edit').value = '';
            }

            document.getElementById('modalEdit').classList.remove('hidden');
        }
        function closeEditModal() {
            document.getElementById('modalEdit').classList.add('hidden');
            document.getElementById('formEdit').reset();
        }
    </script>
</x-app-layout>
