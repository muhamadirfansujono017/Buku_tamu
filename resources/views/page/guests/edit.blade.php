@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-bold mb-4">Edit Guest</h2>
    <form action="{{ route('guests.update', $guest->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nama" class="block">Nama</label>
            <input type="text" name="nama" id="nama" class="w-full p-2 border rounded" value="{{ $guest->nama }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border rounded" value="{{ $guest->email }}">
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
    </form>
</div>
@endsection
