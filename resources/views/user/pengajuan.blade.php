<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Pengajuan Pengecekan Registrasi Surat Tanah</h2>
    </div>
    <div class="max-w-full px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="text-center mb-5 text-green-500">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('pengajuanuser.store') }}" method="POST" enctype="multipart/form-data"
            class="shadow-md rounded-lg p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-2">
                    <label for="nomorpengajuan">Nomor Pengajuan</label>
                    <input type="text" id="nomorpengajuan" name="nomorpengajuan" class="form-control"
                        value="{{ 'KRB-' . strtoupper(uniqid()) }}" readonly>
                </div>
                <div class="mb-2">
                    <label for="nama">Nama Pemohon</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ $user->name }}"
                        readonly>
                </div>
                <div class="mb-2">
                    <label for="nik">NIK</label>
                    <input type="text" id="nik" name="nik" class="form-control" value="{{ $user->nik }}"
                        readonly>
                </div>
                <div class="mb-2">
                    <label for="tempat">Tempat / Tanggal Lahir</label>
                    <input type="text" id="tempat" name="tempat" class="form-control"
                        value="{{ $user->tempat }} / {{ isset($user->tanggallahir) ? \Carbon\Carbon::parse($user->tanggallahir)->format('d-m-Y') : '' }} "
                        readonly>
                </div>
                <div class="mb-2">
                    <label for="pekerjaan">Pekerjaan</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" value="{{ $user->pekerjaan }}"
                    readonly>
                </div>
                <div class="mb-2">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" value="{{ $user->alamat }}"
                        readonly>
                </div>
                <div class="mb-2">
                    <label for="jenissurat">Jenis Surat</label>
                    <select id="jenissurat" name="jenissurat" class="form-control" required>
                        <option value="">Pilih Jenis Surat</option>
                        <option value="Surat Pernyataan Ganti Rugi (SPGR)">Surat Pernyataan Ganti Rugi (SPGR)</option>
                        <option value="Surat Hibah Tanah">Surat Hibah Tanah</option>
                        <option value="Surat Keterangan Pendaftaran Tanah (SKPT)">Surat Keterangan Pendaftaran Tanah
                            (SKPT)</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="tanggal">Tanggal Terbit Surat</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label for="noreg">Nomor Registrasi</label>
                    <input type="text" id="noreg" name="noreg" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label for="kelurahan" class="block mb-2 text-gray-700">Kelurahan Surat Tanah</label>
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
                    <label for="surattanah">Surat Tanah</label>
                    <input type="file" id="surattanah" name="surattanah" class="form-control-file" required>
                </div>

                <div class="mb-2">
                    <label for="suratpermohonan">Surat Permohonan</label>
                    <input type="file" id="suratpermohonan" name="suratpermohonan" class="form-control-file"
                        required>
                </div>
                <div class="mb-2">
                    <label for="ktp">KTP</label>
                    <input type="file" id="ktp" name="ktp" class="form-control-file" required>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <a href="{{ url('/home') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke
                    Beranda</a>
                <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
            </div>
        </form>
    </div>
</x-app-layout>
