<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('message.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Pilih Tamu -->
                        <div>
                            <label for="guest_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Tamu</label>
                            <select id="guest_id" name="guest_id" class="input-field" onchange="isiDataTamu()">
                                <option value="">-- Pilih Tamu --</option>
                                @foreach ($guests as $guest)
                                    <option value="{{ $guest->id }}"
                                        {{ old('guest_id') == $guest->id ? 'selected' : '' }}
                                        data-nama="{{ $guest->nama }}"
                                        data-email="{{ $guest->email }}"
                                        data-telepon="{{ $guest->telepon }}"
                                        data-alamat="{{ $guest->alamat }}"
                                        data-tujuan="{{ $guest->tujuan }}">
                                        {{ $guest->nama }} - {{ $guest->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('guest_id')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div>
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="input-field" required>
                            @error('nama')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="input-field" required>
                            @error('email')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="telepon">Telepon</label>
                            <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" class="input-field" required>
                            @error('telepon')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" class="input-field" required>
                            @error('alamat')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tujuan -->
                        <div>
                            <label for="tujuan">Tujuan</label>
                            <input type="text" name="tujuan" id="tujuan" value="{{ old('tujuan') }}" class="input-field" required>
                            @error('tujuan')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', \Carbon\Carbon::today()->format('Y-m-d')) }}" class="input-field" required>
                            @error('tanggal')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Simpan -->
                        <div>
                            <button type="submit" class="btn-primary w-full">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk isi otomatis -->
    <script>
        function isiDataTamu() {
            const select = document.getElementById('guest_id');
            const selected = select.options[select.selectedIndex];

            document.getElementById('nama').value = selected.getAttribute('data-nama') || '';
            document.getElementById('email').value = selected.getAttribute('data-email') || '';
            document.getElementById('telepon').value = selected.getAttribute('data-telepon') || '';
            document.getElementById('alamat').value = selected.getAttribute('data-alamat') || '';
            document.getElementById('tujuan').value = selected.getAttribute('data-tujuan') || '';
        }
    </script>
</x-app-layout>
