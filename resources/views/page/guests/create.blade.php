@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md mt-10">
    <h2 class="text-2xl font-bold mb-6">Tambah Tamu</h2>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('guests.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="nama" class="input-field" placeholder="Nama" required value="{{ old('nama') }}">
        <input type="email" name="email" class="input-field" placeholder="Email" required value="{{ old('email') }}">
        <input type="text" name="telepon" class="input-field" placeholder="Telepon" value="{{ old('telepon') }}">
        <input type="text" name="alamat" class="input-field" placeholder="Alamat" value="{{ old('alamat') }}">
        <input type="text" name="tujuan" class="input-field" placeholder="Tujuan" value="{{ old('tujuan') }}">
        <input type="date" name="tanggal" class="input-field" required value="{{ old('tanggal') }}">

        <button type="submit" class="btn-primary w-full">Simpan</button>
    </form>
</div>

<style>
    .input-field { @apply w-full px-4 py-2 border rounded; }
    .btn-primary { @apply bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded; }
</style>
@endsection
