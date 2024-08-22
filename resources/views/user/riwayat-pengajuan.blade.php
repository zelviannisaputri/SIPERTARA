<x-app-layout>
    <title>Riwayat Pengajuan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Riwayat Pengajuan Pengecekan Registrasi Surat Tanah</h2>
        <p class="text-center mb-6">Lihat semua riwayat pengajuan surat permohonan Pengecekan Registrasi Surat Tanah disini</p>
    </div>

    <div class="bg-white rounded-lg shadow-md">
        <table class="w-full table-auto">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                @foreach (['No', 'Nomor Pengajuan', 'Nomor Registrasi', 'Status', 'Aksi'] as $header)
                    <th class="py-3 px-2">{{ $header }}</th>
                @endforeach
            </thead>
            <tbody class="text-gray-600 text-sm">
                @if ($pengajuan->isEmpty())
                    <tr>
                        <td colspan="15" class="text-center py-3 px-2">Data tidak ditemukan.</td>
                    </tr>
                @else
                    @foreach ($pengajuan as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 text-center">{{ $item->nomorpengajuan }}</td>
                            <td class="py-3 px-4 text-center">{{ $item->noreg }}</td>
                            <td class="py-3 px-4 text-center">
                                @if ($item->status == 'Disetujui')
                                    <span class="bg-green-500 text-white py-1 px-3 rounded-full text-xs">{{ $item->status }}</span>
                                @elseif ($item->status == 'Menunggu' || $item->status == 'Menunggu Persetujuan Kasipem')
                                    <span class="bg-yellow-500 text-white py-1 px-3 rounded-full text-xs">{{ $item->status }}</span>
                                @elseif ($item->status == 'Ditolak oleh Admin')
                                    <span class="bg-red-500 text-white py-1 px-3 rounded-full text-xs">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                @if ($item->status === 'Disetujui')
                                    <a href="{{ route('user.print.resi', ['id' => $item->id]) }}"
                                        class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 transition duration-300">
                                        <i class="fas fa-print"></i> Cetak Resi
                                    </a>
                                @elseif ($item->status === 'Ditolak oleh Admin')
                                    <button type="button" data-modal-toggle="modal-{{ $item->id }}"
                                        class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-300">
                                        <i class="fa-solid fa-exclamation-triangle"></i> Alasan Tolak
                                    </button>
                                    <!-- Modal -->
                                    <div id="modal-{{ $item->id }}"
                                        class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                        <div class="bg-white p-4 rounded-md shadow-lg w-80 relative z-10">
                                            <h3 class="text-lg font-semibold">Alasan Penolakan</h3>
                                            <p class="mt-2 text-gray-500">{{ $item->keterangan }}</p>
                                            <button type="button"
                                                class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300 close-modal" data-modal-dismiss="modal-{{ $item->id }}">
                                                Tutup
                                            </button>
                                        </div>
                                        <div class="fixed inset-0 bg-black opacity-50 z-0"></div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="text-center mt-6">
        <a href="/home" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-modal-toggle]').forEach(button => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-modal-toggle');
                    const modal = document.getElementById(modalId);
                    modal.classList.toggle('hidden');
                });
            });

            document.querySelectorAll('.close-modal').forEach(button => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-modal-dismiss');
                    const modal = document.getElementById(modalId);
                    modal.classList.add('hidden');
                });
            });
        });
    </script>

</x-app-layout>
