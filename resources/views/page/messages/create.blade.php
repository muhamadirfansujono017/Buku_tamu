@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Pesan Baru</h1>

    <form action="{{ route('messages.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="guest_id" class="form-label">Pilih Tamu</label>
            <select name="guest_id" id="guest_id" class="form-select @error('guest_id') is-invalid @enderror">
                <option value="">-- Pilih Tamu --</option>
                @foreach($guests as $guest)
                    <option value="{{ $guest->id }}" @selected(old('guest_id') == $guest->id)>
                        {{ $guest->name }}
                    </option>
                @endforeach
            </select>
            @error('guest_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Isi Pesan</label>
            <textarea name="content" id="content" rows="3" 
                class="form-control @error('content') is-invalid @enderror"
                placeholder="Tulis pesan disini...">{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan Pesan</button>
        <a href="{{ route('messages.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection