<x-app-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Edit Surat Pernyataan Ganti Rugi (SPGR) Tanah</h2>
    </div>
    <div class="max-w-full px-4 sm:px-6 lg:px-8">
        <form action="{{ route('spgr.update', $spgr->id) }}" method="POST" class="shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div class="mb-2">
                    <label for="tanggal" class="block mb-2 text-gray-700">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ $spgr->tanggal }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-2">
                    <label for="nomorsurat" class="block mb-2 text-gray-700">Nomor Surat</label>
                    <input type="text" id="nomorsurat" name="nomorsurat" value="{{ $spgr->nomorsurat }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-2">
                    <label for="noreg" class="block mb-2 text-gray-700">Nomor Registrasi</label>
                    <input type="text" id="noreg" name="noreg" value="{{ $spgr->noreg }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-2">
                    <label for="penjual" class="block mb-2 text-gray-700">Penjual</label>
                    <input type="text" id="penjual" name="penjual" value="{{ $spgr->penjual }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-2">
                    <label for="pembeli" class="block mb-2 text-gray-700">Pembeli</label>
                    <input type="text" id="pembeli" name="pembeli" value="{{ $spgr->pembeli }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-2">
                    <label for="kelurahan" class="block mb-2 text-gray-700">Kelurahan</label>
                    <select id="kelurahan" name="kelurahan"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <option value="">Pilih Kelurahan</option>
                        <option value="Kelurahan Muara Fajar Barat"
                            {{ $spgr->kelurahan == 'Kelurahan Muara Fajar Barat' ? 'selected' : '' }}>Kelurahan Muara
                            Fajar Barat</option>
                        <option value="Kelurahan Muara Fajar Timur"
                            {{ $spgr->kelurahan == 'Kelurahan Muara Fajar Timur' ? 'selected' : '' }}>Kelurahan Muara
                            Fajar Timur</option>
                        <option value="Kelurahan Rumbai Bukit"
                            {{ $spgr->kelurahan == 'Kelurahan Rumbai Bukit' ? 'selected' : '' }}>Kelurahan Rumbai Bukit
                        </option>
                        <option value="Kelurahan Rantau Panjang"
                            {{ $spgr->kelurahan == 'Kelurahan Rantau Panjang' ? 'selected' : '' }}>Kelurahan Rantau
                            Panjang</option>
                        <option value="Kelurahan Maharani"
                            {{ $spgr->kelurahan == 'Kelurahan Maharani' ? 'selected' : '' }}>Kelurahan Maharani
                        </option>
                        <option value="Kelurahan Agro Wisata"
                            {{ $spgr->kelurahan == 'Kelurahan Agro Wisata' ? 'selected' : '' }}>Kelurahan Agro Wisata
                        </option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="rt" class="block mb-2 text-gray-700">RT</label>
                    <input type="text" id="rt" name="rt" value="{{ $spgr->rt }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-2">
                    <label for="rw" class="block mb-2 text-gray-700">RW</label>
                    <input type="text" id="rw" name="rw" value="{{ $spgr->rw }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <div class="col-span-1 md:col-span-2">
                <label class="block mb-2 text-gray-700">Batas Batas Sempadan</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center mb-2">
                        <label for="utara" class="mr-2 w-36">Sebelah Utara :</label>
                        <input type="text" id="utara" name="utara" value="{{ $spgr->utara }}"
                            class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <label for="ukuranutara" class="mx-2">Uk :</label>
                        <input type="text" id="ukuranutara" name="ukuranutara" value="{{ $spgr->ukuranutara }}"
                            class="w-20 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="ml-2">-M</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <label for="selatan" class="mr-2 w-36">Sebelah Selatan :</label>
                        <input type="text" id="selatan" name="selatan" value="{{ $spgr->selatan }}"
                            class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <label for="ukuranselatan" class="mx-2">Uk :</label>
                        <input type="text" id="ukuranselatan" name="ukuranselatan"
                            value="{{ $spgr->ukuranselatan }}"
                            class="w-20 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="ml-2">-M</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <label for="timur" class="mr-2 w-36">Sebelah Timur :</label>
                        <input type="text" id="timur" name="timur" value="{{ $spgr->timur }}"
                            class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <label for="ukurantimur" class="mx-2">Uk :</label>
                        <input type="text" id="ukurantimur" name="ukurantimur" value="{{ $spgr->ukurantimur }}"
                            class="w-20 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="ml-2">-M</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <label for="barat" class="mr-2 w-36">Sebelah Barat :</label>
                        <input type="text" id="barat" name="barat" value="{{ $spgr->barat }}"
                            class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <label for="ukuranbarat" class="mx-2">Uk :</label>
                        <input type="text" id="ukuranbarat" name="ukuranbarat" value="{{ $spgr->ukuranbarat }}"
                            class="w-20 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="ml-2">-M</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-2">
                    <label for="luas" class="block mb-2 text-gray-700">Luas</label>
                    <input type="text" id="luas" name="luas" value="{{ $spgr->luas }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-2">
                    <label for="letak" class="block mb-2 text-gray-700">Letak Surat</label>
                    <input type="text" id="letak" name="letak" value="{{ $spgr->letak }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-2 col-span-1 md:col-span-2">
                    <label for="dasar" class="block mb-2 text-gray-700">Dasar Surat</label>
                    <input type="text" id="dasar" name="dasar" value="{{ $spgr->dasar }}"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <div class="flex justify-between items-center">
                <a href="{{ route('spgr.index') }}"
                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-800">
                    Simpan Perubahan Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
