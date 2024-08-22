<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi SIPERTARA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 400px;
            margin: 20px auto;
            border: 1px solid #00bfa5;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #000;
        }

        .header p {
            margin: 0;
            font-size: 14px;
            color: #000;
        }

        .info-box,
        .detail,
        .keterangan {
            border: 1px solid #00bfa5;
            padding: 10px;
            background-color: #e0f2f1;
            margin-top: 10px;
        }

        .info-box p,
        .detail h2,
        .keterangan h2 {
            margin: 0;
            font-size: 14px;
            color: #000;
        }

        .detail h2,
        .keterangan h2 {
            border-bottom: 1px solid #00bfa5;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .detail table,
        .keterangan table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail table td,
        .keterangan table td {
            padding: 5px;
            vertical-align: top;
            font-size: 14px;
        }

        .detail table td:first-child {
            width: 40%;
            font-weight: bold;
        }

        .keterangan p {
            font-size: 14px;
        }

        .keterangan ul {
            margin: 10px 0 0;
            padding: 0;
            list-style: none;
        }

        .keterangan ul li {
            font-size: 14px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>RESI SIPERTARA</h1>
            <p>KANTOR CAMAT RUMBAI BARAT</p>
            <p>sipertara@gmail.com</p>
        </div>
        <div class="info-box">
            <p><strong>No. Pengajuan:</strong> {{ $pengajuan->nomorpengajuan }}</p>
            <p><strong>Tanggal Pengajuan:</strong> {{ $tanggalFormat }}</p>
        </div>
        <div class="detail">
            <h2>DETAIL</h2>
            <table>
                <tr>
                    <td>Nama Pemohon</td>
                    <td>: {{ $pengajuan->nama }}</td>
                </tr>
                <tr>
                    <td>NIK Pemohon</td>
                    <td>: {{ $pengajuan->nik }}</td>
                </tr>
                <tr>
                    <td>Jenis Surat</td>
                    <td>: {{ $pengajuan->jenissurat }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>: {{ $pengajuan->status }}</td>
                </tr>
            </table>
        </div>
        <div class="keterangan">
            <h2>KETERANGAN</h2>
            <p>{!! $keterangan !!}</p>
        </div>
    </div>
</body>

</html>
