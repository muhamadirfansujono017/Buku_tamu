<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-900 leading-tight">
            {{ __('Laporan Tamu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-4 rounded-xl mb-2 flex items-center justify-between ">
                        <div>DATA TAMU</div>
                        <div>
                            <a href="{{ route('laporantamu.create') }}"
                                onclick="return functionAdd()"class="text-white bg-sky-500 p-2 rounded-xl">TAMBAH</a>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        NO
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        nama
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        email
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        pesan
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        TANGGAL
                                    </th>
                                    @can('role-A')
                                    <th scope="col" class="px-4 py-3">
                                        ACTION
                                    </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($laporantamu as $key => $l)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $tlaporantamu->perPage() * ($laporantamu->currentPage() - 1) + $key + 1 }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $t->guest->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->message }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->reply }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $t->tanggal }}
                                        </td>
                                        @can('role-A')
                                            <td class="px-6 py-4">
                                                <button type="button" data-id="{{ $t->id }}"
                                                    data-modal-target="sourceModal" data-tgl_bayar="{{ $t->tgl_bayar }}"
                                                    data-dibayar="{{ $t->dibayar }}" onclick="editSourceModal(this)"
                                                    class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                    Edit
                                                </button>
                                                <button
                                                    onclick="return laporantamuDelete('{{ $t->id }}','{{ $t->outlet->nama }}')"
                                                    class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white">Delete</button>
                                            </td>
                                            @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $laporantamu->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                        Update Sumber Database
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="defaultModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="flex flex-col  p-4 space-y-6">
                        <div class="mb-5">
                            <label for="dibayar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                Pembayaran</label>
                            <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                id="dibayar" name="dibayar" data-placeholder="Pilih Konsinyasi">
                                <option value="">Pilih...</option>
                                <option value="dibayar">Dibayar</option>
                                <option value="belum dibayar">Belum Dibayar</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButton"
                            class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                        <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');
        const modalTarget = button.dataset.modalTarget;
        const id = button.dataset.id;
        const dibayar = button.dataset.dibayar;

        let url = "{{ route('laporantamu.update', ':id') }}".replace(':id', id);

        let status = document.getElementById(modalTarget);

        // Set nilai untuk combobox
        const dibayarSelect = document.getElementById('dibayar');
        dibayarSelect.value = dibayar;

        // Jika menggunakan Select2 atau plugin serupa, trigger event change
        $(dibayarSelect).trigger('change');

        document.getElementById('formSourceButton').innerText = 'Simpan';
        document.getElementById('formSourceModal').setAttribute('action', url);

        let csrfToken = document.createElement('input');
        csrfToken.setAttribute('type', 'hidden');
        csrfToken.setAttribute('name', '_token');
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

    const transaksiDelete = async (id, outlet) => {
        let tanya = confirm(`Apakah anda yakin untuk menghapus transaksi ${outlet}?`);
            if (tanya) {
                try {
                    const response = await axios.post(`/transaksi/${id}`, {
                        '_method': 'DELETE',
                        '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    });

                    if (response.status === 200) {
                        alert('Transaksi berhasil dihapus');
                        location.reload();
                    } else {
                        alert('Gagal menghapus transaksi. Silakan coba lagi.');
                    }
                } catch (error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat menghapus transaksi. Silakan cek konsol untuk detail.');
                }
            }
    }
</script>
