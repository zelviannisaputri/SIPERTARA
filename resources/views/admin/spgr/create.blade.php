<x-app-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Surat Pernyataan Ganti Rugi (SPGR) Tanah</h2>
    </div>
    <div class="max-w-full px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="text-center mb-5 text-green-500">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('spgr.store') }}" method="POST" class="shadow-md rounded-lg p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-2">
                    <label for="tanggal" class="block mb-2 text-gray-700">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div class="mb-2">
                    <label for="nomorsurat" class="block mb-2 text-gray-700">Nomor Surat</label>
                    <input type="text" id="nomorsurat" name="nomorsurat"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div class="mb-2">
                    <label for="noreg" class="block mb-2 text-gray-700">Nomor Registrasi</label>
                    <input type="text" id="noreg" name="noreg"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div class="mb-2">
                    <label for="penjual" class="block mb-2 text-gray-700">Penjual</label>
                    <input type="text" id="penjual" name="penjual"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div class="mb-2">
                    <label for="pembeli" class="block mb-2 text-gray-700">Pembeli</label>
                    <input type="text" id="pembeli" name="pembeli"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div class="mb-2">
                    <label for="kelurahan" class="block mb-2 text-gray-700">Kelurahan</label>
                    <select id="kelurahan" name="kelurahan"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                        <option value="">Pilih Kelurahan</option>
                        <option value="Kelurahan Muara Fajar Barat">Kelurahan Muara Fajar Barat</option>
                        <option value="Kelurahan Muara Fajar Timur">Kelurahan Muara Fajar Timur</option>
                        <option value="Kelurahan Rumbai Bukit">Kelurahan Rumbai Bukit</option>
                        <option value="Kelurahan Rantau Panjang">Kelurahan Rantau Panjang</option>
                        <option value="Kelurahan Maharani">Kelurahan Maharani</option>
                        <option value="Kelurahan Agro Wisata">Kelurahan Agro Wisata</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="rt" class="block mb-2 text-gray-700">RT</label>
                    <input type="text" id="rt" name="rt"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div class="mb-2">
                    <label for="rw" class="block mb-2 text-gray-700">RW</label>
                    <input type="text" id="rw" name="rw"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
            </div>
            <div class="col-span-1 md:col-span-2">
                <label class="block mb-2 text-gray-700">Batas Batas Sempadan</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center mb-2">
                        <label for="utara" class="mr-2 w-36">Sebelah Utara :</label>
                        <input type="text" id="utara" name="utara"
                            class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            required>
                        <label for="ukuranutara" class="mx-2">Uk :</label>
                        <input type="text" id="ukuranutara" name="ukuranutara" pattern="^\d+(\,\d{1,4})?$"
                            class="w-20 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            required>
                        <span class="ml-2">-m</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <label for="selatan" class="mr-2 w-36">Sebelah Selatan :</label>
                        <input type="text" id="selatan" name="selatan"
                            class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            required>
                        <label for="ukuranselatan" class="mx-2">Uk :</label>
                        <input type="text" id="ukuranselatan" name="ukuranselatan" pattern="^\d+(\,\d{1,4})?$"
                            class="w-20 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            required>
                        <span class="ml-2">-m</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <label for="timur" class="mr-2 w-36">Sebelah Timur :</label>
                        <input type="text" id="timur" name="timur"
                            class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            required>
                        <label for="ukurantimur" class="mx-2">Uk :</label>
                        <input type="text" id="ukurantimur" name="ukurantimur" pattern="^\d+(\,\d{1,4})?$"
                            class="w-20 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            required>
                        <span class="ml-2">-m</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <label for="barat" class="mr-2 w-36">Sebelah Barat :</label>
                        <input type="text" id="barat" name="barat"
                            class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            required>
                        <label for="ukuranbarat" class="mx-2">Uk :</label>
                        <input type="text" id="ukuranbarat" name="ukuranbarat" pattern="^\d+(\,\d{1,4})?$"
                            class="w-20 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            required>
                        <span class="ml-2">-m</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-2">
                    <label for="luas" class="block mb-2 text-gray-700">Luas Tanah</label>
                    <input type="text" id="luas" name="luas" pattern="^\d+(\,\d{1,4})?$"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div class="mb-2">
                    <label for="letak" class="block mb-2 text-gray-700">Letak Berkas</label>
                    <input type="text" id="letak" name="letak"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div class="mb-2 col-span-1 md:col-span-2">
                    <label for="dasar" class="block mb-2 text-gray-700">Dasar Surat Tanah</label>
                    <input type="text" id="dasar" name="dasar"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        required>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button class="btn bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded" type="submit">Tambah
                    Data</button>
            </div>
        </form>
    </div>
</x-app-layout>
