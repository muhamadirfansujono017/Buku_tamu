<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('MESSAGE') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 items-center">
                    <div>DATA MESSAGE</div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex gap-5">
                    {{-- FORM ADD --}}
                    <div class="w-full bg-gray-100 p-4 rounded-xl">
                        <div class="mb-5">
                            INPUT DATA MESSAGE
                        </div>
                        <form action="{{ route('message.store') }}" method="post">
                            @csrf
                            <div class="mb-5">
                                <label for="guest_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAMA</label>
                                <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                    name="guest_id" id="guest_id" data-placeholder="Pilih guest id">
                                    <option value="">Pilih...</option>
                                    @foreach ($guests as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama }}</option>                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="base-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PESAN</label>
                                <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                    name="message" data-placeholder="Pilih message">
                                    <option value="">Pilih...</option>
                                    <option value="pasilitasnya yang di berika sagatlah baik dan para pegawai sangat ramah dan sopan kepada tamu">pasilitasnya yang di berika sagatlah baik dan para pegawai sangat ramah dan sopan kepada tamu</option>
                                    <option value="good job untuk pasilitas yang sudah di berikan ">good job untuk pasilitas yang sudah di berikan</option>
                                    <option value="penilayan saya sanagt kurang utuk pasilitas yang sudah di berikan">penilayan saya sanagt kurang utuk pasilitas yang sudah di berikan</option>
                                    <option value="pegawai tidak ramah dan tidak kompeten">pegawai tidak ramah dan tidak kompeten</option>
                                </select>
                            </div>  
                            <div class="mb-5 w-full">
                                <label for="tanggal"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TANGGAL</label>
                                <input name="tanggal" type="date" id="tanggal" value="{{ date('Y-m-d') }}" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SIMPAN</button>
                        </form>
                    </div>
                    {{-- TABLE KONSINYASI PRODUK --}}
                    <div class="w-full">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">
                                            NO
                                        </th>
                                        <th scope="col" class="px-6 py-4">
                                            NAMA TAMU
                                        </th>
                                        <th scope="col" class="px-6 py-4">
                                            PESAN
                                        </th>
                                        <th scope="col" class="px-6 py-4">
                                            TANGGAL
                                        </th>
                                        <th scope="col" class="px-6 py-4">
                                            AKSI
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($message as $key => $p)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $message->perPage() * ($message->currentPage() - 1) + $key + 1 }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $p->guest->nama }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $p->message }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($p->tanggal)->format('Y-m-d') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button type="button" 
                                                    data-id="{{ $p->id }}"
                                                    data-modal-target="sourceModal" 
                                                    data-guest_id="{{ $p->guest_id }}" 
                                                    data-message="{{ $p->message }}" 
                                                    data-tanggal="{{ $p->tanggal }}" 
                                                    onclick="editSourceModal(this)"
                                                    class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                    Edit
                                                </button>
                                                <button
                                                    onclick="return messageDelete('{{ $p->id }}','{{ $p->guest->nama }}')"
                                                    class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $message->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 hidden items-center justify-center z-50 " id="sourceModal">
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
                        <div class="">
                            <label for="guest_id_edit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">guests</label>
                            <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                name="guest_id_edit" id="guest_id_edit" data-placeholder="Pilih guests">
                                <option value="">Pilih...</option>
                                @foreach ($guests as $g)
                                    <option value="{{ $g->id }}">{{ $g->nama }}</option>                                        
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="message"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">message</label>
                            <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                name="message" id="message" data-placeholder="Pilih message">
                                <option value="">Pilih...</option>
                                    <option value="pasilitasnya yang di berika sagatlah baik dan para pegawai sangat ramah dan sopan kepada tamu">pasilitasnya yang di berika sagatlah baik dan para pegawai sangat ramah dan sopan kepada tamu</option>
                                    <option value="good job untuk pasilitas yang sudah di berikan ">good job untuk pasilitas yang sudah di berikan</option>
                                    <option value="penilayan saya sanagt kurang utuk pasilitas yang sudah di berikan">penilayan saya sanagt kurang utuk pasilitas yang sudah di berikan</option>
                                    <option value="pegawai tidak ramah dan tidak kompeten">pegawai tidak ramah dan tidak kompeten</option>
                            </select>
                        </div>  
                        <div class="mb-5 w-full">
                            <label for="tanggal"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TANGGAL</label>
                            <input name="tanggal" type="date" id="tanggal" value="{{ date('Y-m-d') }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
        const guest_id = button.dataset.guest_id;
        const message = button.dataset.message;
        const tanggal = button.dataset.tanggal; // Ambil data tanggal dari dataset

        let url = "{{ route('message.update', ':id') }}".replace(':id', id);
        let status = document.getElementById(modalTarget);
        document.getElementById('title_source').innerText = `UPDATE MESSAGE?`;

        // Set nilai guest_id
        let event = new Event('change');
        document.querySelector('[name="guest_id_edit"]').value = guest_id;
        document.querySelector('[name="guest_id_edit"]').dispatchEvent(event);

        // Set nilai message
        document.getElementById('message').value = message;

        // Set nilai tanggal
        document.getElementById('tanggal').value = tanggal; // Isi input tanggal

        // Set action form dan tambahkan method PATCH
        document.getElementById('formSourceButton').innerText = 'Simpan';
        document.getElementById('formSourceModal').setAttribute('action', url);

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

    const messageDelete = async (id, guest) => {
        let tanya = confirm(`Apakah anda yakin untuk menghapus PAKET ${guest} ?`);
        if (tanya) {
            await axios.post(`/message/${id}`, {
                    '_method': 'DELETE',
                    '_token': $('meta[name="csrf-token"]').attr('content')
                })
                .then(function(response) {
                    // Handle success
                    location.reload();
                })
                .catch(function(error) {
                    // Handle error
                    alert('Error deleting record');
                    console.log(error);
                });
        }
    }
</script>