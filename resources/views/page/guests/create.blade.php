@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-bold mb-4">Tambah Guest</h2>
    <form action="{{ route('guests.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block">Nama</label>
            <input type="text" name="nama" id="nama" class="w-full p-2 border rounded" placeholder="Masukkan nama">
        </div>
        <div class="mb-4">
            <label for="email" class="block">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border rounded" placeholder="Masukkan email">
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
    </form>
</div>
@endsection
