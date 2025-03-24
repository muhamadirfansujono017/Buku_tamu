@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pesan</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $message->guest->name }}</h5>
            <p class="card-text">{{ $message->content }}</p>
            <small class="text-muted">
                Dibuat pada: {{ $message->created_at->format('d/m/Y H:i') }}<br>
                Terakhir diupdate: {{ $message->updated_at->diffForHumans() }}
            </small>
        </div>
    </div>

    <a href="{{ route('message.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection