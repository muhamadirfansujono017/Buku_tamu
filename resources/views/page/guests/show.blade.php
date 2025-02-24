<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Guest') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Nama:</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $guest->nama }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Email:</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $guest->email }}</p>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('guests.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
