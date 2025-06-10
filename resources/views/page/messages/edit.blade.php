@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit</h1>

    <form action="{{ route('message.update', $message) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="guest_id" class="form-label">Pilih Tamu</label>
            <select name="guest_id" id="guest_id" class="form-select @error('guest_id') is-invalid @enderror">
                <option value="">-- Pilih Tamu --</option>
                @foreach($guests as $guest)
                    <option value="{{ $guest->id }}" 
                        @selected($message->guest_id == $guest->id)>
                        {{ $guest->name }}
                    </option>
                @endforeach
            </select>
            @error('guest_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('message.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection