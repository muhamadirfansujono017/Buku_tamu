{{-- resources/views/page/message/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Pesan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow p-6 rounded">
            <form action="{{ route('message.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="guest_id" class="block font-medium">Pilih Tamu</label>
                    <select name="guest_id" id="guest_id" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Tamu --</option>
                        @foreach($guests as $guest)
                            <option
                                value="{{ $guest->id }}"
                                data-email="{{ $guest->email }}"
                                data-telepon="{{ $guest->telepon }}"
                                data-alamat="{{ $guest->alamat }}"
                                data-kategori-id="{{ $guest->kategori_id }}">
                                {{ $guest->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label>Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label>Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label>Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->data_tujuan }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border rounded p-2"
                        value="{{ now()->toDateString() }}" required>
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script otomatis isi data --}}
    <script>
        document.getElementById('guest_id').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];

            document.getElementById('email').value = selected.getAttribute('data-email') || '';
            document.getElementById('telepon').value = selected.getAttribute('data-telepon') || '';
            document.getElementById('alamat').value = selected.getAttribute('data-alamat') || '';

            const kategoriId = selected.getAttribute('data-kategori-id');
            const kategoriSelect = document.getElementById('kategori_id');
            if (kategoriId) {
                for (let i = 0; i < kategoriSelect.options.length; i++) {
                    if (kategoriSelect.options[i].value == kategoriId) {
                        kategoriSelect.selectedIndex = i;
                        break;
                    }
                }
            } else {
                kategoriSelect.selectedIndex = 0;
            }
        });
    </script>
</x-app-layout>
