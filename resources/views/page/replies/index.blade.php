@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Replies</h1>

    <a href="{{ route('replies.create') }}" class="btn btn-primary mb-4">Tambah Balasan</a>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Message ID</th>
                <th class="px-4 py-2">Reply</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($replies as $reply)
            <tr>
                <td class="border px-4 py-2">{{ $reply->id }}</td>
                <td class="border px-4 py-2">{{ $reply->message_id }}</td>
                <td class="border px-4 py-2">{{ $reply->reply }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('replies.edit', $reply->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('replies.destroy', $reply->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus balasan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
