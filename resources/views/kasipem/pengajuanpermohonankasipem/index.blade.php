<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Pengecekan Registrasi Surat Tanah</h2>
        </div>
        <div class="flex justify-end mb-4">
            <form action="{{ route('kasipem.pengajuan.index') }}" method="GET" class="flex">
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
                        @foreach (['No', 'No. Pengajuan', 'Nama Pemohon', 'NIK', 'Jenis Surat', 'Nomor Registrasi', 'Tanggal Terbit Surat', 'Surat Tanah', 'Surat Permohonan', 'KTP', 'Status Surat', 'Status Permohonan', 'Aksi'] as $header)
                            <th class="py-3 px-2">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($pengajuan as $index => $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-4 text-center">{{ $index + 1 }}</td>
                            <td class="py-3 px-4">{{ $item->nomorpengajuan }}</td>
                            <td class="py-3 px-4">{{ $item->nama }}</td>
                            <td class="py-3 px-4">{{ $item->nik }}</td>
                            <td class="py-3 px-4">{{ $item->jenissurat }}</td>
                            <td class="py-3 px-4">{{ $item->noreg }}</td>
                            <td class="py-3 px-4">{{ $item->tanggal }}</td>
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
                            <td class="py-3 px-4">
                                <form action="{{ route('pengajuan.updateStatus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="statussurat" onchange="this.form.submit()" disabled>
                                        <option value="Ter-Register" {{ $item->statussurat == 'Ter-Register' ? 'selected' : '' }}>Ter-Register</option>
                                        <option value="Tidak Ter-Register" {{ $item->statussurat == 'Tidak Ter-Register' ? 'selected' : '' }}>Tidak Ter-Register</option>
                                        <option value="Belum Ditemukan" {{ $item->statussurat == 'Belum Ditemukan' ? 'selected' : '' }}>Belum Ditemukan</option>
                                    </select>
                                </form>
                            </td>
                            
                            <td class="py-3 px-4">{{ $item->status }}</td>
                            <td class="py-3 px-4" style="white-space: nowrap; width: 120px;">
                                @if ($item->status === 'Disetujui')
                                    <button
                                        class="bg-green-300 text-white font-bold text-sm py-1 px-2 rounded mb-2 btn-sm btn-disabled"
                                        disabled>
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                @elseif ($item->status === 'Menunggu Persetujuan Kasipem')
                                    <form action="{{ route('kasipem.pengajuan.approve', $item->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold text-sm py-1 px-2 rounded mb-2">
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('pengajuan.approve', $item->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mb-2">
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
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
    </div>
</x-app-layout>
