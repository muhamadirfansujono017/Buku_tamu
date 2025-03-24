@extends('layouts.app')

@section('content')
<h1>Tambah Balasan</h1>

<form action="{{ route('replies.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Tamu</label>
                <select name="guest_id" class="form-control" required>
                    @foreach($guests as $id => $nama)
                        <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Pesan</label>
                <select name="message_id" class="form-control" required>
                    @foreach($messages as $id => $judul)
                        <option value="{{ $id }}">{{ $judul }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>Balasan Utama</label>
                <select name="Reply_id" class="form-control">
                    <option value="">Tidak ada</option>
                    @foreach($parentReplies as $reply)
                        <option value="{{ $reply->id }}">
                            {{ Str::limit($reply->isi_balasan, 50) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label>Isi Balasan</label>
        <textarea name="isi_balasan" class="form-control" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection