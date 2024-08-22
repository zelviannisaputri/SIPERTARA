<x-app-layout>
    <title>Status Pengajuan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .status-card {
            background: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .btn-print {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-print:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        .d-flex {
            display: flex;
        }

        .flex-column {
            flex-direction: column;
        }

        .flex-grow-1 {
            flex-grow: 1;
        }
    </style>
    </head>

    <body>
        <div class="mb-4 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Status Pengajuan Pengecekan Registrasi Surat Tanah</h2>
            <p class="text-center mb-6">Cek status pengajuan surat permohonan Pengecekan Registrasi Surat Tanah disini
            </p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex flex-column">
                    <div class="status-card flex-grow-1">
                        <h5 class="font-bold text-gray-800">Detail Pemohon Pengajuan Pengecekan Registrasi Surat Tanah
                        </h5>
                        <p><strong>No.Pengajuan:</strong> {{ $pengajuan->nomorpengajuan }}</p>
                        <p><strong>Nama Pemohon:</strong> {{ $user->nama }}</p>
                        <p><strong>NIK Pemohon:</strong> {{ $user->nik }}</p>
                        <p><strong>Tempat / Tanggal Lahir:</strong> {{ $user->tempat }} /
                            {{ $user->tanggallahir }}</p>
                        <p><strong>Alamat:</strong> {{ $pengajuan->alamat }}</p>
                        <p><strong>Pekerjaan:</strong> {{ $pengajuan->pekerjaan }}</p>
                        <p><strong>Jenis Surat:</strong> {{ $pengajuan->jenissurat }}</p>
                        <p><strong>Nomor Registrasi Surat:</strong> {{ $pengajuan->noreg }}</p>
                        <p><strong>Tanggal Terbit Surat:</strong> {{ $pengajuan->tanggal }}</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <div class="status-card flex-grow-1">
                        <h5 class="font-bold text-gray-800">Status Pengajuan</h5>
                        <p><strong>Status:</strong>
                            @if ($pengajuan->status === 'Disetujui')
                                <span class="badge badge-success">{{ $pengajuan->status }}</span>
                            @elseif ($pengajuan->status === 'Ditolak oleh Admin')
                                <span class="badge badge-danger">{{ $pengajuan->status }}</span>
                            @else
                                <span class="badge badge-secondary">{{ $pengajuan->status }}</span>
                            @endif
                        </p>
                        <p><strong>Keterangan:</strong> {!! $keterangan !!}</p>
                        <div class="text-right mt-4">
                            <a href="/home" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke
                                Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
