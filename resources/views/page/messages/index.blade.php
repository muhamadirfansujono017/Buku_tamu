<x-app-layout>
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Messages</h1>

    <a href="{{ route('messages.create') }}" class="btn btn-primary mb-4">Tambah Pesan</a>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Guest ID</th>
                <th class="px-4 py-2">Message</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
            <tr>
                <td class="border px-4 py-2">{{ $message->id }}</td>
                <td class="border px-4 py-2">{{ $message->guest_id }}</td>
                <td class="border px-4 py-2">{{ $message->message }}</td>
                <td class="border px-4 py-2">{{ $message->status }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pesan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
