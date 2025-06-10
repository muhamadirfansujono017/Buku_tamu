<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('message.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Add New Detail Tamu</a>

                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($messages as $message)
                                <tr id="message-row-{{ $message->id }}"
                                    data-nama="{{ $message->guest->nama ?? '-' }}"
                                    data-email="{{ $message->email }}"
                                    data-telepon="{{ $message->telepon }}"
                                    data-alamat="{{ $message->alamat }}"
                                    data-tujuan="{{ $message->tujuan }}">
                                    <td>{{ $message->guest->nama ?? '-' }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->telepon }}</td>
                                    <td>{{ $message->alamat }}</td>
                                    <td>{{ $message->tujuan }}</td>
                                    <td>{{ $message->tanggal }}</td>
                                    <td class="space-x-1">
                                        <button onclick="editSourceModal(this)"
                                            data-modal-target="sourceModal"
                                            data-id="{{ $message->id }}"
                                            data-tanggal="{{ $message->tanggal }}"
                                            class="bg-yellow-400 text-black px-2 py-1 rounded hover:bg-yellow-500">
                                            Edit
                                        </button>
                                        <button onclick="messageDelete({{ $message->id }}, '{{ $message->guest->nama ?? 'Tamu' }}')"
                                            class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">Tidak ada pesan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="sourceModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6 w-full max-w-xl">
            <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Edit Data Tamu</h3>
            <form id="formSourceModal" method="POST">
                <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                    <button type="submit" id="formSourceButton"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
                    <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Batal</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');
        const modalTarget = button.dataset.modalTarget;
        const id = button.dataset.id;
        const tanggal = button.dataset.tanggal;

        const row = document.getElementById(`message-row-${id}`);
        const nama = row.dataset.nama;
        const email = row.dataset.email;
        const telepon = row.dataset.telepon;
        const alamat = row.dataset.alamat;
        const tujuan = row.dataset.tujuan;

        const url = "{{ route('message.update', ':id') }}".replace(':id', id);
        formModal.setAttribute('action', url);

        document.getElementById('nama').value = nama;
        document.getElementById('email').value = email;
        document.getElementById('telepon').value = telepon;
        document.getElementById('alamat').value = alamat;
        document.getElementById('tujuan').value = tujuan;
        document.getElementById('tanggal').value = tanggal;

        document.getElementById(modalTarget).classList.remove('hidden');
    }

    const sourceModalClose = (button) => {
        const modalTarget = button.dataset.modalTarget;
        document.getElementById(modalTarget).classList.add('hidden');
    }

    const messageDelete = async (id, nama) => {
        let tanya = confirm(`Apakah anda yakin ingin menghapus pesan dari ${nama}?`);
        if (tanya) {
            try {
                const response = await axios.post(`/message/${id}`, {
                    '_method': 'DELETE',
                    '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                });

                if (response.status === 200) {
                    alert('Pesan berhasil dihapus');
                    location.reload();
                } else {
                    alert('Gagal menghapus pesan. Silakan coba lagi.');
                }
            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan saat menghapus pesan. Silakan cek konsol untuk detail.');
            }
        }
    }
</script>
