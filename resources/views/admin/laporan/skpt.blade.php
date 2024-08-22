<!DOCTYPE html>
<html>

<head>
    <title>Laporan Surat Keterangan Pendaftaran (SKPT) Tanah</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            size: landscape;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            margin-top: 250px;
            /* Adjust this value as needed */
        }

        .header {
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            /* Ensure header is on top */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('images/Kop Surat.jpg') }}" alt="Kop Surat" style="width: 100%;">
    </div>

    <div class="content">
        <h1 style="text-align: center;">Surat Keterangan Pendaftaran Tanah (SKPT)</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nomor Surat</th>
                    <th>Nama Pemilik</th>
                    <th>Kelurahan</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>Batas-Batas Sempadan</th>
                    <th>Ukuran</th>
                    <th>Luas Tanah</th>
                    <th>Dasar Surat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($skptData as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->tanggal }}</td>
                        <td>{{ $data->nomorsurat }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->kelurahan }}</td>
                        <td>{{ $data->rt }}</td>
                        <td>{{ $data->rw }}</td>
                        <td>
                            <div>
                                <strong>Utara:</strong> {{ $data->utara }}<br>
                                <strong>Selatan:</strong> {{ $data->selatan }}<br>
                                <strong>Timur:</strong> {{ $data->timur }}<br>
                                <strong>Barat:</strong> {{ $data->barat }}
                            </div>
                        </td>
                        <td>
                            <div>
                                ({{ $data->ukuranutara }} -m)
                                <br>
                                ({{ $data->ukuranselatan }} -m)<br>
                                ({{ $data->ukurantimur }} -m)<br>
                                ({{ $data->ukuranbarat }} -m)
                            </div>
                        </td>
                        <td>{{ $data->luas }} m²</td>
                        <td>{{ $data->dasar }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>

</html>
