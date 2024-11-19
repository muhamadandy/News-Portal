<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Manajemen Users</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna..." class="border p-2 rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
    </form>

        <table class="min-w-full bg-white mb-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="w-1/4 py-2">Nama</th>
                    <th class="w-1/4 py-2">Email</th>
                    <th class="w-1/4 py-2">Peran</th>
                    <th class="w-1/4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4">{{ $user->role }}</td>
                        <td class="py-2 px-4 flex space-x-4">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>
</x-admin-layout>
