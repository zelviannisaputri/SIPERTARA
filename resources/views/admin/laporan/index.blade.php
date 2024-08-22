{{-- <x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Laporan Registrasi Tanah</h2>
        </div>
        <style>
            .print-button {
                float: right;
                color: #fff;
                background-color: #128f3c;
                border: none;
                padding: 10px 12px;
                cursor: pointer;
                border-radius: 5px;
                font-size: 14px;
                transition: background-color 0.3s;
                margin-bottom: 10px;
            }

            .print-button i {
                margin-right: 5px;
            }

            .print-button:hover {
                background-color: #0a6431;
            }

            .form-group {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .form-control {
                height: 40px;
                width: calc(100% - 180px);
            }

            .btn-primary {
                width: 90px;
                margin-left: auto;
            }
        </style>
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <select class="form-control" id="suratType">
                            <option value="pilihsurat">Pilih Surat</option>
                            <option value="spgr">Surat Pernyataan Ganti Rugi (SPGR) Tanah</option>
                            <option value="hibah">Surat Hibah Tanah</option>
                            <option value="skpt">Surat Keterangan Pendaftaran Tanah (SKPT)</option>
                        </select>
                        <input type="month" class="form-control" id="filterMonth">
                        <input type="number" class="form-control" id="filterYear" placeholder="YYYY" min="2020" max="2100">
                        <button type="button" class="btn bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded" onclick="showData()">Pilih</button>
                    </div>
                </form>
                <form id="printForm" action="" method="GET" target="_blank">
                    <input type="hidden" name="month" id="printFilterMonth">
                    <input type="hidden" name="year" id="printFilterYear">
                </form>
                <div id="dataContainer" class="mt-4"></div>
            </div>
        </div>
    </div>

    <script>
        const spgrData = @json($spgrData);
        const surathibahData = @json($surathibahData);
        const skptData = @json($skptData);

        function getPrintUrl(suratType) {
            const routes = {
                spgr: "{{ route('laporan.cetak.spgr') }}",
                hibah: "{{ route('laporan.cetak.surathibah') }}",
                skpt: "{{ route('laporan.cetak.skpt') }}"
            };
            return routes[suratType];
        }

        function showData() {
    var suratType = document.getElementById('suratType').value;
    var filterMonth = document.getElementById('filterMonth').value;
    var filterYear = document.getElementById('filterYear').value;
    var dataContainer = document.getElementById('dataContainer');

    if (suratType === 'pilihsurat' || (!filterMonth && !filterYear)) {
        alert("Pilih jenis surat dan bulan atau tahun.");
        return;
    }

    var data = {
        spgr: spgrData,
        hibah: surathibahData,
        skpt: skptData
    };

    var filteredData = data[suratType];
    if (filterMonth) {
        filteredData = filteredData.filter(item => item.tanggal.startsWith(filterMonth));
    } else if (filterYear) {
        filteredData = filteredData.filter(item => item.tanggal.startsWith(filterYear));
    }

    var tableHeaders = {
        spgr: ['No', 'Tanggal', 'Nomor Surat', 'Penjual', 'Pembeli', 'Kelurahan', 'RT', 'RW', 'Batas-Batas Sempadan', 'Ukuran', 'Luas Tanah', 'Dasar Surat'],
        hibah: ['No', 'Tanggal', 'Nomor Surat', 'Pemberi', 'Penerima', 'Kelurahan', 'RT', 'RW', 'Batas-Batas Sempadan', 'Ukuran', 'Luas Tanah', 'Dasar Surat'],
        skpt: ['No', 'Tanggal', 'Nomor Surat', 'Nama Pemilik', 'Kelurahan', 'RT', 'RW', 'Batas-Batas Sempadan', 'Ukuran', 'Luas Tanah', 'Dasar Surat']
    };

    var tableContent = `
        <button class="print-button" onclick="printData('${suratType}', '${filterMonth}', '${filterYear}')">
            <i class="fas fa-print"></i>Cetak PDF
        </button>
        <div class="bg-white rounded-lg shadow-md">
            <table class="w-full table-auto">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>${tableHeaders[suratType].map(header => `<th class="py-3 px-2">${header}</th>`).join('')}</tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    ${generateTableRows(suratType, filteredData)}
                </tbody>
            </table>
        </div>
    `;

    dataContainer.innerHTML = tableContent;
}

function generateTableRows(suratType, data) {
    if (suratType === 'skpt') {
        return data.map((item, key) => `
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-4 text-center">${key + 1}</td>
                <td class="py-3 px-4">${item.tanggal}</td>
                <td class="py-3 px-4">${item.nomorsurat}</td>
                <td class="py-3 px-4">${item.nama}</td>
                <td class="py-3 px-4">${item.kelurahan}</td>
                <td class="py-3 px-4">${item.rt}</td>
                <td class="py-3 px-4">${item.rw}</td>
                <td class="py-3 px-4">
                    <strong>Utara:</strong> ${item.utara}<br>
                    <strong>Selatan:</strong> ${item.selatan}<br>
                    <strong>Timur:</strong> ${item.timur}<br>
                    <strong>Barat:</strong> ${item.barat}
                </td>
                <td class="py-3 px-4">
                    ${item.ukuranutara} -m<br>
                    ${item.ukuranselatan} -m<br>
                    ${item.ukurantimur} -m<br>
                    ${item.ukuranbarat} -m
                </td>
                <td class="py-3 px-4">${item.luas} m²</td>
                <td class="py-3 px-4">${item.dasar}</td>
            </tr>
        `).join('');
    } else {
        return data.map((item, key) => `
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-4 text-center">${key + 1}</td>
                <td class="py-3 px-4">${item.tanggal}</td>
                <td class="py-3 px-4">${item.nomorsurat}</td>
                <td class="py-3 px-4">${item.penjual ?? item.pemberi}</td>
                <td class="py-3 px-4">${item.pembeli ?? item.penerima}</td>
                <td class="py-3 px-4">${item.kelurahan}</td>
                <td class="py-3 px-4">${item.rt}</td>
                <td class="py-3 px-4">${item.rw}</td>
                <td class="py-3 px-4">
                    <strong>Utara:</strong> ${item.utara}<br>
                    <strong>Selatan:</strong> ${item.selatan}<br>
                    <strong>Timur:</strong> ${item.timur}<br>
                    <strong>Barat:</strong> ${item.barat}
                </td>
                <td class="py-3 px-4">
                    ${item.ukuranutara} -m<br>
                    ${item.ukuranselatan} -m<br>
                    ${item.ukurantimur} -m<br>
                    ${item.ukuranbarat} -m
                </td>
                <td class="py-3 px-4">${item.luas} m²</td>
                <td class="py-3 px-4">${item.dasar}</td>
            </tr>
        `).join('');
    }
}


        function printData(suratType, filterMonth, filterYear) {
            var printForm = document.getElementById('printForm');
            printForm.action = getPrintUrl(suratType);
            document.getElementById('printFilterMonth').value = filterMonth;
            document.getElementById('printFilterYear').value = filterYear;
            printForm.submit();
        }
    </script>
</x-app-layout> --}}
<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Laporan Registrasi Tanah</h2>
        </div>
        <style>
            .print-button {
                float: right;
                color: #fff;
                background-color: #128f3c;
                border: none;
                padding: 10px 12px;
                cursor: pointer;
                border-radius: 5px;
                font-size: 14px;
                transition: background-color 0.3s;
                margin-bottom: 10px;
            }

            .print-button i {
                margin-right: 5px;
            }

            .print-button:hover {
                background-color: #0a6431;
            }

            .form-group {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .form-control {
                height: 40px;
                width: calc(100% - 180px);
            }

            .btn-primary {
                width: 90px;
                margin-left: auto;
            }
        </style>
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <select class="form-control" id="suratType">
                            <option value="pilihsurat">Pilih Surat</option>
                            <option value="spgr">Surat Pernyataan Ganti Rugi (SPGR) Tanah</option>
                            <option value="hibah">Surat Hibah Tanah</option>
                            <option value="skpt">Surat Keterangan Pendaftaran Tanah (SKPT)</option>
                        </select>
                        <input type="month" class="form-control" id="filterMonth">
                        <input type="number" class="form-control" id="filterYear" placeholder="YYYY" min="2020" max="2100">
                        <button type="button" class="btn bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded" onclick="showData()">Pilih</button>
                    </div>
                </form>
                <form id="printForm" action="" method="GET" target="_blank">
                    <input type="hidden" name="month" id="printFilterMonth">
                    <input type="hidden" name="year" id="printFilterYear">
                </form>
                <div id="dataContainer" class="mt-4"></div>
                <div id="noDataMessage" class="mt-4 text-red-500"></div> <!-- Elemen untuk pesan tidak ada data -->
            </div>
        </div>
    </div>

    <script>
        const spgrData = @json($spgrData);
        const surathibahData = @json($surathibahData);
        const skptData = @json($skptData);

        function getPrintUrl(suratType) {
            const routes = {
                spgr: "{{ route('laporan.cetak.spgr') }}",
                hibah: "{{ route('laporan.cetak.surathibah') }}",
                skpt: "{{ route('laporan.cetak.skpt') }}"
            };
            return routes[suratType];
        }

        function showData() {
            const suratType = document.getElementById('suratType').value;
            const filterMonth = document.getElementById('filterMonth').value;
            const filterYear = document.getElementById('filterYear').value;
            const dataContainer = document.getElementById('dataContainer');
            const noDataMessage = document.getElementById('noDataMessage');

            if (suratType === 'pilihsurat' || (!filterMonth && !filterYear)) {
                alert("Pilih jenis surat dan bulan atau tahun.");
                return;
            }

            const data = {
                spgr: spgrData,
                hibah: surathibahData,
                skpt: skptData
            };

            let filteredData = data[suratType];
            if (filterMonth) {
                filteredData = filteredData.filter(item => item.tanggal.startsWith(filterMonth));
            } else if (filterYear) {
                filteredData = filteredData.filter(item => item.tanggal.startsWith(filterYear));
            }

            if (filteredData.length === 0) {
                noDataMessage.innerHTML = 'Tidak ada data yang tersedia untuk ditampilkan.';
                dataContainer.innerHTML = '';
                return;
            } else {
                noDataMessage.innerHTML = '';
            }

            const tableHeaders = {
                spgr: ['No', 'Tanggal', 'Nomor Surat', 'Penjual', 'Pembeli', 'Kelurahan', 'RT', 'RW', 'Batas-Batas Sempadan', 'Ukuran', 'Luas Tanah', 'Dasar Surat'],
                hibah: ['No', 'Tanggal', 'Nomor Surat', 'Pemberi', 'Penerima', 'Kelurahan', 'RT', 'RW', 'Batas-Batas Sempadan', 'Ukuran', 'Luas Tanah', 'Dasar Surat'],
                skpt: ['No', 'Tanggal', 'Nomor Surat', 'Nama Pemilik', 'Kelurahan', 'RT', 'RW', 'Batas-Batas Sempadan', 'Ukuran', 'Luas Tanah', 'Dasar Surat']
            };

            const tableContent = `
                <button class="print-button" onclick="printData('${suratType}', '${filterMonth}', '${filterYear}')">
                    <i class="fas fa-print"></i>Cetak PDF
                </button>
                <div class="bg-white rounded-lg shadow-md">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <tr>${tableHeaders[suratType].map(header => `<th class="py-3 px-2">${header}</th>`).join('')}</tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            ${generateTableRows(suratType, filteredData)}
                        </tbody>
                    </table>
                </div>
            `;

            dataContainer.innerHTML = tableContent;
        }

        function generateTableRows(suratType, data) {
            if (suratType === 'skpt') {
                return data.map((item, key) => `
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-4 text-center">${key + 1}</td>
                        <td class="py-3 px-4">${item.tanggal}</td>
                        <td class="py-3 px-4">${item.nomorsurat}</td>
                        <td class="py-3 px-4">${item.nama}</td>
                        <td class="py-3 px-4">${item.kelurahan}</td>
                        <td class="py-3 px-4">${item.rt}</td>
                        <td class="py-3 px-4">${item.rw}</td>
                        <td class="py-3 px-4">
                            <strong>Utara:</strong> ${item.utara}<br>
                            <strong>Selatan:</strong> ${item.selatan}<br>
                            <strong>Timur:</strong> ${item.timur}<br>
                            <strong>Barat:</strong> ${item.barat}
                        </td>
                        <td class="py-3 px-4">
                            ${item.ukuranutara} -m<br>
                            ${item.ukuranselatan} -m<br>
                            ${item.ukurantimur} -m<br>
                            ${item.ukuranbarat} -m
                        </td>
                        <td class="py-3 px-4">${item.luas} m²</td>
                        <td class="py-3 px-4">${item.dasar}</td>
                    </tr>
                `).join('');
            } else {
                return data.map((item, key) => `
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-4 text-center">${key + 1}</td>
                        <td class="py-3 px-4">${item.tanggal}</td>
                        <td class="py-3 px-4">${item.nomorsurat}</td>
                        <td class="py-3 px-4">${item.penjual ?? item.pemberi}</td>
                        <td class="py-3 px-4">${item.pembeli ?? item.penerima}</td>
                        <td class="py-3 px-4">${item.kelurahan}</td>
                        <td class="py-3 px-4">${item.rt}</td>
                        <td class="py-3 px-4">${item.rw}</td>
                        <td class="py-3 px-4">
                            <strong>Utara:</strong> ${item.utara}<br>
                            <strong>Selatan:</strong> ${item.selatan}<br>
                            <strong>Timur:</strong> ${item.timur}<br>
                            <strong>Barat:</strong> ${item.barat}
                        </td>
                        <td class="py-3 px-4">
                            ${item.ukuranutara} -m<br>
                            ${item.ukuranselatan} -m<br>
                            ${item.ukurantimur} -m<br>
                            ${item.ukuranbarat} -m
                        </td>
                        <td class="py-3 px-4">${item.luas} m²</td>
                        <td class="py-3 px-4">${item.dasar}</td>
                    </tr>
                `).join('');
            }
        }

        function printData(suratType, filterMonth, filterYear) {
            const printForm = document.getElementById('printForm');
            printForm.action = getPrintUrl(suratType);
            document.getElementById('printFilterMonth').value = filterMonth;
            document.getElementById('printFilterYear').value = filterYear;
            printForm.submit();
        }
    </script>
</x-app-layout>
