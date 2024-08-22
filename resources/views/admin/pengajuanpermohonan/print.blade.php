<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan</title>
    <style>
        @page {
            size: 210mm 330mm;
            /* F4 paper size */
            margin: 20mm;
            /* Adjust the margin as needed */
        }

        body,
        .content {
            line-height: 24px;
            /* 1.5 times the font size of 16px */
            font-size: 16px;
            /* Ensure font size consistency */
        }


        .header img {
            width: 100%;
        }

        .signature {
            page-break-inside: avoid;
            /* Prevent breaking within the signature block */
        }
    </style>
</head>

<body>
    <div class="header" style="text-align: center; position: fixed; width: 100%; top: 0;">
        <img src="{{ asset('images/Kop Surat.jpg') }}" alt="Kop Surat">
    </div>
    <div>
        <h2
            style="margin-top: 180px; text-align: center; font-size: 18px; text-decoration: underline; margin-bottom: 0;">
            SURAT KETERANGAN</h2>
        <p style="text-align: center; margin-top: 5px; font-size: 16px;">
            Nomor: 100/KRB-PEM/&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2024
        </p>
    </div>
    <div class="content">
        <p style="text-align: justify; text-indent: 20px; margin: 20px 0 20px 80px;"><strong>CAMAT RUMBAI BARAT KOTA
                PEKANBARU,</strong> dengan ini menerangkan:</p>
        <table style="width: 100%; margin: 20px 0 20px 80px; border-collapse: collapse;">
            <tr style="text-align: left; justify; text-indent: 20px;">
                <td style="width: 30%; padding-right: 10px;">Nama</td>
                <td style="width: 70%;">: <strong>{{ $pengajuan->nama }}</strong></td>
            </tr>
            <tr style="text-align: left; justify; text-indent: 20px;">
                <td style="width: 30%; padding-right: 10px;">NIK</td>
                <td style="width: 70%;">: {{ $pengajuan->nik }}</td>
            </tr>
            <tr style="text-align: left; justify; text-indent: 20px;">
                <td style="width: 30%; padding-right: 10px;">Tempat, Tanggal Lahir</td>
                <td style="width: 70%;">: {{ $pengajuan->tempat }},
                    {{ \Carbon\Carbon::parse($pengajuan->tanggallahir)->isoFormat('DD MMMM YYYY') }}</td>
            </tr>
            <tr style="text-align: left; justify; text-indent: 20px;">
                <td style="width: 30%; padding-right: 10px;">Pekerjaan</td>
                <td style="width: 70%;">: {{ $pengajuan->pekerjaan }}</td>
            </tr>
            <tr style="text-align: left; justify; text-indent: 20px;">
                <td style="width: 30%; padding-right: 10px;">Alamat</td>
                <td style="width: 70%;">: {{ $pengajuan->alamat }}</td>
            </tr>
        </table>
        <p style="text-align: justify; text-indent: 50px; margin: 20px 0 20px 50px;">Bahwa dari surat permohonan nama
            tersebut di atas bahwasannya <strong>a.n {{ $pengajuan->nama }}</strong> memiliki sebidang tanah yang
            terletak di {{ $pengajuan->kelurahan }} dengan nomor <strong>{{ $pengajuan->noreg }}</strong> Tanggal :
            <strong>{{ \Carbon\Carbon::parse($pengajuan->tanggal)->isoFormat('DD MMMM YYYY') }}</strong> dapat
            dijelaskan bahwasannya tanah tersebut {{ $pengajuan->statussurat }} di buku pertanahan Kecamatan Rumbai
            pada tahun {{ $tahunPengecekan }}.
        </p>
        <p style="text-align: justify; text-indent: 50px; margin: 20px 0 20px 50px;">Demikian Surat Keterangan ini
            diberikan kepada yang bersangkutan untuk dipergunakan seperlunya.</p>
    </div>
    <div class="signature"
        style="display: flex; flex-direction: column; align-items: flex-end; justify-content: center; height: 300px; text-align: right; margin-top: 50px;">
        <p style="margin: 0;">Pekanbaru, {{ \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') }}</p><br>
        <strong style="font-size: 16px; margin-right: 70px;">CAMAT RUMBAI BARAT</strong>
        <br>
        <strong style="font-size: 16px; margin-right: 40px;">a.n Sekretaris Camat Rumbai Barat</strong>
        <div style="margin-right: 150px;">
            <strong style="font-size: 16px;">u.b.</strong>
        </div>
        <strong style="font-size: 16px; margin-right: 70px;">Kepala Seksi Pemerintahan</strong>
        <div style="margin-top: 90px; margin-right: 100px;">
            <strong style="font-size: 16px; text-decoration: underline;">IMAN PRATIKNO</strong>
        </div>
        <strong style="font-size: 16px; margin-right: 70px;">NIP. 19670608 199303 1 006</strong>
    </div>
</body>

</html>
