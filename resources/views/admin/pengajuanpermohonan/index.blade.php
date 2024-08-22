<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Pengajuan Pengecekan Registrasi Surat Tanah</h2>
        </div>
        <div class="flex justify-end mb-4">
            <form action="{{ route('pengajuan.index') }}" method="GET" class="flex">
                <input type="text" name="query" class="form-input px-4 py-2 rounded-l border border-gray-300"
                    placeholder="Cari Surat">
                <button type="submit" class="btn bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-r">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="bg-white shadow-md overflow-x-auto">

            <table class="w-full table-auto">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        @foreach (['No', 'No. Pengajuan', 'Nama Pemohon', 'NIK', 'Jenis Surat', 'No. Registrasi', 'Tanggal Surat', 'Surat Tanah', 'Surat Permohonan', 'KTP', 'Status Surat', 'Status Permohonan', 'Aksi', 'Keterangan'] as $header)
                            <th class="py-3 px-2">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @if ($pengajuan->isEmpty())
                        <tr>
                            <td colspan="15" class="text-center py-3 px-2">Data tidak ditemukan.</td>
                        </tr>
                    @else
                        @foreach ($pengajuan as $index => $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-2 text-center">{{ $index + 1 }}</td>
                                <td class="py-3 px-2">{{ $item->nomorpengajuan }}</td>
                                <td class="py-3 px-2">{{ $item->nama }}</td>
                                <td class="py-3 px-2">{{ $item->nik }}</td>
                                <td class="py-3 px-2">{{ $item->jenissurat }}</td>
                                <td class="py-3 px-2">{{ $item->noreg }}</td>
                                <td class="py-3 px-2">{{ $item->tanggal }}</td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ asset('storage/' . $item->surattanah) }}" target="_blank"
                                        class="btn btn-info btn-sm btn-detail-container">
                                        <i class="fa-solid fa-file-image"></i> </a>
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ asset('storage/' . $item->suratpermohonan) }}" target="_blank"
                                        class="btn btn-info btn-sm btn-detail-container">
                                        <i class="fa-solid fa-file-image"></i> </a>
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <a href="{{ asset('storage/' . $item->ktp) }}" target="_blank"
                                        class="btn btn-info btn-sm btn-detail-container">
                                        <i class="fa-solid fa-file-image"></i> </a>
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <form action="{{ route('pengajuan.updateStatus', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="statussurat" onchange="this.form.submit()">
                                            <option value="Ter-Register"
                                                {{ $item->statussurat == 'Ter-Register' ? 'selected' : '' }}>
                                                Ter-Register
                                            </option>
                                            <option value="Tidak Ter-Register"
                                                {{ $item->statussurat == 'Tidak Ter-Register' ? 'selected' : '' }}>
                                                Tidak
                                                Ter-Register</option>
                                            <option value="Belum Ditemukan"
                                                {{ $item->statussurat == 'Belum Ditemukan' ? 'selected' : '' }}>Belum
                                                Ditemukan</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-3 px-2">{{ $item->status }}</td>
                                <td class="py-3 px-2" style="white-space: nowrap; width: 120px;">
                                    @if ($item->status === 'Disetujui' || $item->status === 'Ditolak oleh Kasipem' || $item->status === 'Ditolak oleh Admin')
                                        <button
                                            class="bg-green-300 text-white font-bold text-sm py-1 px-2 rounded mb-2 btn-sm btn-disabled"
                                            disabled>
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                        <button
                                            class="bg-red-300 text-white font-bold text-sm py-1 px-2 rounded mb-2 btn-sm btn-disabled"
                                            disabled>
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    @elseif ($item->status === 'Menunggu Persetujuan Kasipem')
                                        <button
                                            class="bg-green-300 text-white font-bold text-sm py-1 px-2 rounded mb-2 btn-sm btn-disabled"
                                            disabled>
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                        <button
                                            class="bg-red-300 text-white font-bold text-sm py-1 px-2 rounded mb-2 btn-sm btn-disabled"
                                            disabled>
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    @else
                                        <form action="{{ route('pengajuan.approve', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold text-sm py-1 px-2 rounded mb-2">
                                                <i class="fas fa-check"></i> Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('pengajuan.reject', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold text-sm py-1 px-2 rounded mb-2"
                                                data-toggle="modal" data-target="#rejectModal-{{ $item->id }}">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-center">
                                    @if ($item->status === 'Disetujui')
                                        <button
                                            class="bg-green-500 text-white py-1 px-2 rounded-full text-xs"
                                            onclick="window.location.href='{{ route('pengajuan.print', $item->id) }}'">
                                            <i class="fa-solid fa-file-pdf"></i> Surat Keterangan
                                        </button>
                                    @elseif ($item->status === 'Ditolak oleh Admin' && $item->keterangan)
                                        <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs"
                                            onclick="alert('{{ $item->keterangan }}')">
                                            <i class="fa-solid fa-exclamation-triangle"></i> Detail Penolakan
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $pengajuan->links() }}
            </div>
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
        <!-- Modal Template -->
        @foreach ($pengajuan as $item)
            <div id="rejectModal-{{ $item->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Alasan Penolakan
                            </h3>
                            <div class="mt-2">
                                <form action="{{ route('pengajuan.reject', $item->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="keterangan"
                                            class="block text-sm font-medium text-gray-700">Alasan</label>
                                        <textarea id="keterangan" name="keterangan" rows="4"
                                            class="form-input mt-1 block w-full rounded-md border border-gray-300 shadow-sm" required></textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold text-sm py-1 px-2 rounded mb-2 mr-2"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold text-sm py-1 px-2 rounded mb-2">Kirim
                                            Alasan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- Script JavaScript -->
        <script>
            function openRejectModal(id) {
                document.getElementById('rejectModal-' + id).classList.remove('hidden');
            }

            function closeRejectModal(id) {
                console.log("Tutup modal dengan ID: " + id); // Menampilkan ID modal
                var modal = document.getElementById('rejectModal-' + id);
                if (modal) {
                    modal.classList.add('hidden');
                    console.log("Modal berhasil disembunyikan."); // Konfirmasi modal disembunyikan
                } else {
                    console.log("Modal tidak ditemukan.");
                }
            }
            window.onclick = function(event) {
                const modals = document.querySelectorAll("[id^='rejectModal-']");
                modals.forEach(modal => {
                    // Jika klik di luar konten modal dan di atas background modal, tutup modal
                    if (event.target === modal || event.target === modal.querySelector('.bg-gray-500')) {
                        modal.classList.add('hidden');
                    }
                });
            }
        </script>
    </div>
    </div>
</x-app-layout>
