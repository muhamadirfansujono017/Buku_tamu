{{-- resources/views/page/message/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Pesan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow p-6 rounded space-y-4">

            <div><strong>Nama Tamu:</strong> {{ optional($message->guest)->nama }}</div>
            <div><strong>Email:</strong> {{ $message->email }}</div>
            <div><strong>Telepon:</strong> {{ $message->telepon }}</div>
            <div><strong>Alamat:</strong> {{ $message->alamat }}</div>
            <div><strong>Kategori:</strong> {{ optional($message->kategori)->nama ?? '-' }}</div>
            <div><strong>Tanggal:</strong> {{ $message->tanggal }}</div>

            <div class="pt-4">
                <a href="{{ route('message.edit', $message->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                <a href="{{ route('message.index') }}" class="ml-2 text-blue-600 hover:underline">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
