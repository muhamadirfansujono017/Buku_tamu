<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('DATA TAMU') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-white">DATA TAMU</h3>
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col lg:flex-row gap-6">
                    
                    {{-- FORM ADD --}}
                    <div class="w-full lg:w-1/2 bg-gray-100 p-6 rounded-xl shadow">
                        <h4 class="text-md font-semibold mb-4 text-gray-800">Input Data Tamu</h4>
                        <form action="{{ route('guests.store') }}" method="post">
                            @csrf

                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input name="nama" type="text" class="input-field" placeholder="Masukan Nama disini...">
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input name="email" type="text" class="input-field" placeholder="Masukan Email disini...">
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Telepon</label>
                                <input name="telepon" type="text" class="input-field" placeholder="Masukan Telepon disini...">
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                <input name="alamat" type="text" class="input-field" placeholder="Masukan Alamat disini...">
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Tujuan</label>
                                <input name="tujuan" type="text" class="input-field" placeholder="Masukan Tujuan disini...">
                            </div>

                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PESAN</label>
                                <select class="js-example-placeholder-single js-states form-control w-full m-6" name="pesan" data-placeholder="Pilih message">

                                    <option value="">Pilih...</option>
                                    <option value="pasilitasnya yang di berika sagatlah baik dan para pegawai sangat ramah dan sopan kepada tamu">
                                        pasilitasnya yang di berika sagatlah baik dan para pegawai sangat ramah dan sopan kepada tamu
                                    </option>
                                    <option value="good job untuk pasilitas yang sudah di berikan">
                                        good job untuk pasilitas yang sudah di berikan
                                    </option>
                                    <option value="penilayan saya sanagt kurang utuk pasilitas yang sudah di berikan">
                                        penilayan saya sanagt kurang utuk pasilitas yang sudah di berikan
                                    </option>
                                    <option value="pegawai tidak ramah dan tidak kompeten">
                                        pegawai tidak ramah dan tidak kompeten
                                    </option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                <input name="tanggal" type="date" class="input-field">
                            </div>

                            <button type="submit" class="btn-primary w-full">SIMPAN</button>
                        </form>
                    </div>

                    {{-- TABLE DATA GUESTS --}}
                    <div class="w-full lg:w-1/2">
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-4 py-2">NO</th>
                                        <th class="px-4 py-2">NAMA</th>
                                        <th class="px-4 py-2">EMAIL</th>
                                        <th class="px-4 py-2">TELEPON</th>
                                        <th class="px-4 py-2">ALAMAT</th>
                                        <th class="px-4 py-2">TUJUAN</th>
                                        <th class="px-4 py-2">PESAN</th>
                                        <th class="px-4 py-2">TANGGAL</th>
                                        <th class="px-4 py-2">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guests as $key => $k)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <td class="px-4 py-2">{{ $guests->perPage() * ($guests->currentPage() - 1) + $key + 1 }}</td>
                                            <td class="px-4 py-2">{{ $k->nama }}</td>
                                            <td class="px-4 py-2">{{ $k->email }}</td>
                                            <td class="px-4 py-2">{{ $k->telepon }}</td>
                                            <td class="px-4 py-2">{{ $k->alamat }}</td>
                                            <td class="px-4 py-2">{{ $k->tujuan }}</td>
                                            <td class="px-4 py-2">{{ $k->pesan }}</td>
                                            <td class="px-4 py-2">{{ $k->tanggal }}</td>
                                            <td class="px-4 py-2 space-x-2">
                                                <button onclick="editSourceModal(this)"
                                                        class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                    Edit
                                                </button>
                                                <button onclick="return guestsDelete('{{ $k->id }}','{{ $k->nama }}')"
                                                        class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $guests->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');
        const modalTarget = button.dataset.modalTarget;
        const id = button.dataset.id;
        const nama = button.dataset.nama;
        const email = button.dataset.email;

        let url = "{{ route('guests.update', ':id') }}".replace(':id', id);

        let status = document.getElementById(modalTarget);
        document.getElementById('title_source').innerText = `UPDATE GUESTS ${nama}`;

        document.getElementById('nama').value = nama;
        document.getElementById('email').value = email;

        document.getElementById('formSourceButton').innerText = 'Simpan';
        formModal.setAttribute('action', url);

        let csrfToken = document.createElement('input');
        csrfToken.setAttribute('type', 'hidden');
        csrfToken.setAttribute('value', '{{ csrf_token() }}');
        formModal.appendChild(csrfToken);

        let methodInput = document.createElement('input');
        methodInput.setAttribute('type', 'hidden');
        methodInput.setAttribute('name', '_method');
        methodInput.setAttribute('value', 'PATCH');
        formModal.appendChild(methodInput);

        status.classList.toggle('hidden');
    }

    const sourceModalClose = (button) => {
        const modalTarget = button.dataset.modalTarget;
        let status = document.getElementById(modalTarget);
        status.classList.toggle('hidden');
    }

    const guestsDelete = async (id, nama) => {
        let tanya = confirm(`Apakah anda yakin untuk menghapus GUESTS ${nama} ?`);
        if (tanya) {
            await axios.post(`/guests/${id}`, {
                '_method': 'DELETE',
                '_token': $('meta[name="csrf-token"]').attr('content')
            })
            .then(function(response) {
                location.reload();
            })
            .catch(function(error) {
                alert('Error deleting record');
                console.log(error);
            });
        }
    }
</script>
