<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Surat Hibah Tanah</h2>
        </div>
        <div class="flex justify-between mb-4">
            @if (Auth::user()->role == 'Admin')
                <a class="btn bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
                    href="{{ route('surathibah.create') }}">+ Tambah Surat Baru</a>
                <form action="{{ route('surathibah.index') }}" method="GET" class="flex">
                    <input type="text" name="query" class="form-input px-4 py-2 rounded-l border border-gray-300"
                        placeholder="Cari Surat">
                    <button type="submit" class="btn bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-r">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            @endif
        </div>
        <div class="bg-white rounded-lg shadow-md">
            <table class="w-full table-auto">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        @foreach (['No', 'Tanggal', 'No.Surat', 'No.Registrasi', 'Pemberi', 'Penerima', 'Detail', 'Letak Surat'] as $header)
                            <th class="py-3 px-2">{{ $header }}</th>
                        @endforeach

                        @if (Auth::user()->role == 'Admin')
                            <th class="py-3 px-2">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @if ($surathibah->isEmpty())
                        <tr>
                            <td colspan="15" class="text-center py-3 px-2">Data tidak ditemukan.</td>
                        </tr>
                    @else
                        @foreach ($surathibah as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-2 text-center">{{ $loop->iteration }}</td>
                                <td class="py-3 px-2 text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                <td class="py-3 px-2 text-center">{{ $item->nomorsurat }}</td>
                                <td class="py-3 px-2 text-center">{{ $item->noreg }}</td>
                                <td class="py-3 px-2 text-center">{{ $item->pemberi }}</td>
                                <td class="py-3 px-2 text-center">{{ $item->penerima }}</td>
                                <td class="py-3 px-2 text-center">
                                    <button class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded "
                                        onclick="openModal('{{ $item->kelurahan }}', '{{ $item->rt }}', '{{ $item->rw }}', '{{ $item->utara }}, {{ $item->selatan }}, {{ $item->timur }}, {{ $item->barat }}', '{{ $item->ukuranutara }}, {{ $item->ukuranselatan }}, {{ $item->ukurantimur }}, {{ $item->ukuranbarat }}', '{{ $item->luas }}', '{{ $item->dasar }}')">
                                        <i class="fas fa-info-circle"></i> Detail Surat Hibah
                                    </button>
                                </td>
                                <td class="py-3 px-2 text-center">{{ $item->letak }}</td>
                                @if (Auth::user()->role == 'Admin')
                                    <td class="py-3 px-2">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('surathibah.edit', $item->id) }}"
                                                class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('surathibah.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus?')"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $surathibah->links() }}
    </div>
    <!-- Modal -->
    <div id="detailModal"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-300 bg-opacity-25 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-3/4 md:w-1/2 relative">
            <div class="p-4 border">
                <h3 class="text-lg font-semibold">Detail SPGR</h3>
                <button id="modalCloseButton"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-4">
                <table class="w-full border border-black">
                    <tbody>
                        <tr class="border">
                            <th class="text-left py-2 border-r w-1/4">Kelurahan</th>
                            <td id="modalKelurahan" class="border-b"></td>
                        </tr>
                        <tr class="border">
                            <th class="text-left py-2 border-r">RT / RW</th>
                            <td id="modalRT" class="border-b"></td>
                        </tr>
                        <tr class="border">
                            <th class="text-left py-2 border-r">Batas – Batas Sempadan Tanah</th>
                            <td id="modalBatas" class="border-b">
                                <table class="w-full border-collapse">
                                    <tbody>
                                        <tr>
                                            <td class="border-r p-1 w-1/4">Utara: <span id="modalUtara"></span></td>
                                            <td class="border-r p-1 w-1/4">Selatan: <span id="modalSelatan"></span>
                                            </td>
                                            <td class="border-r p-1 w-1/4">Barat: <span id="modalBarat"></span></td>
                                            <td class="p-1 w-1/4">Timur: <span id="modalTimur"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="border">
                            <th class="text-left py-2 border-r">Ukuran Tanah</th>
                            <td id="modalUkuran" class="border-b"></td>
                        </tr>
                        <tr class="border">
                            <th class="text-left py-2 border-r">Luas Tanah</th>
                            <td id="modalLuasTanah" class="border-b"></td>
                        </tr>
                        <tr class="border">
                            <th class="text-left py-2 border-r">Dasar Surat Tanah</th>
                            <td id="modalDasarSurat"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function openModal(kelurahan, rt, rw, batas, ukuran, luas, dasar) {
            document.getElementById('modalKelurahan').textContent = kelurahan;
            document.getElementById('modalRT').textContent = `${rt} / ${rw}`;
            const [utara, selatan, timur, barat] = batas.split(", ");
            document.getElementById('modalUtara').textContent = utara;
            document.getElementById('modalSelatan').textContent = selatan;
            document.getElementById('modalTimur').textContent = timur;
            document.getElementById('modalBarat').textContent = barat;
            const [ukuranUtara, ukuranSelatan, ukuranTimur, ukuranBarat] = ukuran.split(", ");
            document.getElementById('modalUkuran').innerHTML = `
            <table class="w-full border-collapse">
                <tbody>
                    <tr>
                        <td class="border-r p-1 w-1/4">${ukuranUtara}</td>
                        <td class="border-r p-1 w-1/4">${ukuranSelatan}</td>
                        <td class="border-r p-1 w-1/4">${ukuranTimur}</td>
                        <td class="p-1 w-1/4">${ukuranBarat}</td>
                    </tr>
                </tbody>
            </table>
        `;
            document.getElementById('modalLuasTanah').textContent = luas;
            document.getElementById('modalDasarSurat').textContent = dasar;
            document.getElementById('detailModal').classList.remove('hidden');
        }
        document.getElementById('modalCloseButton').addEventListener('click', function() {
            document.getElementById('detailModal').classList.add('hidden');
        });
    </script>
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
</x-app-layout>
