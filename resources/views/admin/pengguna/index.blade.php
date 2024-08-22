<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h2>
        </div>
        <div class="flex justify-end mb-4">
            <form action="{{ route('pengguna.index') }}" method="GET" class="flex">
                <input type="text" name="query" class="form-input px-4 py-2 rounded-l border border-gray-300" placeholder="Cari Pengguna">
                <button type="submit" class="btn bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-r">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="bg-white rounded-lg shadow-md">
            <table class="w-full table-auto">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        @foreach (['No', 'Nama Pengguna', 'NIK', 'Tempat / Tanggal Lahir', 'Nomor Telefon', 'Pekerjaan', 'Alamat', 'Role', 'Alamat Email', 'Aksi'] as $header)
                            <th class="py-3 px-2">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @if ($users->isEmpty())
                        <tr>
                            <td colspan="15" class="text-center py-3 px-2">Data tidak ditemukan.</td>
                        </tr>
                    @else
                    @foreach ($users as $index => $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-2 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-2 text-center">{{ $user->name }}</td>
                            <td class="py-3 px-2 text-center">{{ $user->nik }}</td>
                            <td class="py-3 px-2 text-center">{{ $user->tempat }} / {{ $user->tanggallahir }}</td>
                            <td class="py-3 px-2 text-center">{{ $user->phone }}</td>
                            <td class="py-3 px-2 text-center">{{ $user->pekerjaan }}</td>
                            <td class="py-3 px-2 text-center">{{ $user->alamat }}</td>
                            <td class="py-3 px-2 text-center">{{ $user->role }}</td>
                            <td class="py-3 px-2 text-center">{{ $user->email }}</td>
                            <td class="py-3 px-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('pengguna.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @if (!$user->is_approved)
                                        <form action="{{ route('pengguna.approve', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-800">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links() }}
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: '{{ session('success') }}',
                            timer: 1000,
                            showConfirmButton: false
                        });
                    });
                </script>
            @endif
        </div>
    </div>
</x-app-layout>
