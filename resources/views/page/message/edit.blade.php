{{-- resources/views/page/message/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Pesan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow p-6 rounded">
            <form action="{{ route('message.update', $message->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="guest_id" class="block font-medium">Pilih Tamu</label>
                    <select name="guest_id" id="guest_id" class="w-full border rounded p-2" required>
                        @foreach($guests as $guest)
                            <option value="{{ $guest->id }}" {{ $message->guest_id == $guest->id ? 'selected' : '' }}>
                                {{ $guest->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" id="email" value="{{ $message->email }}" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label>Telepon</label>
                    <input type="text" name="telepon" id="telepon" value="{{ $message->telepon }}" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label>Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="{{ $message->alamat }}" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label>Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="w-full border rounded p-2" required>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $message->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $message->tanggal }}" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Update
                    </button>
                    <a href="{{ route('message.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
