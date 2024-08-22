<x-app-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Pengguna SIPERTARA</h2>
    </div>
    <div class="max-w-full px-4 sm:px-6 lg:px-8">
        <form action="{{ route('pengguna.update', $user->id) }}" method="POST" class="shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label for="name" class="block mb-2 text-gray-700">Nama</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-2">
                <label for="role" class="block mb-2 text-gray-700">Status Pengguna</label>
                <select name="role"
                    class="form-control w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <option value="Admin"{{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Kasipem"{{ $user->role == 'Kasipem' ? 'selected' : '' }}>Kasipem</option>
                    <option value="User"{{ $user->role == 'User' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="phone" class="block mb-2 text-gray-700">Nomor HP</label>
                <input type="text" id="phone" name="phone" value="{{ $user->phone }}"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-2">
                <label for="email" class="block mb-2 text-gray-700">Alamat Email</label>
                <input type="text" id="email" name="email" value="{{ $user->email }}"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div style="display: flex; justify-content: space-between;">
                <a href="{{ route('pengguna.index') }}" class="btn btn-secondary"
                    style="padding: 10px 20px; border-radius: 5px; background-color: #6c757d; color: white; text-decoration: none; text-align: center; display: inline-block;">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit"
                    style="background-color: #128F3C; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    Simpan Perubahan Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
