<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin Keluar Sekolah</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 14px; margin: 0; padding: 20px; }
        .surat-container { width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #000; padding: 30px; box-sizing: border-box; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 15px; margin-bottom: 20px; }
        .header h3, .header h2 { margin: 5px 0; }
        .content table { width: 100%; margin-bottom: 20px; }
        .content table td { padding: 5px 0; vertical-align: top; }
        .content table td:first-child { width: 120px; font-weight: bold; }
        .footer { margin-top: 50px; display: table; width: 100%; }
        .footer-ttd { display: table-cell; width: 50%; text-align: center; }
        .footer-ttd p { margin: 0; }
        .footer-ttd .nama-ttd { margin-top: 70px; font-weight: bold; text-decoration: underline; }
        
        @media print {
            body { padding: 0; }
            .surat-container { border: none; padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">

<div class="surat-container">
    <div class="header">
        <h2>SURAT IZIN KELUAR SEKOLAH</h2>
        <h3>MAN 2 (Sistem SAIS-NG)</h3>
    </div>

    <div class="content">
        <p>Diberikan izin keluar lingkungan sekolah pada hari ini, kepada:</p>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $izin->siswa->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: {{ $izin->kelas->nama_kelas ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ date('d F Y', strtotime($izin->tanggal)) }}</td>
            </tr>
            <tr>
                <td>Keperluan</td>
                <td>: {{ $izin->alasan }}</td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>: <b>{{ $izin->is_pulang ? 'Izin Pulang (Tidak Kembali)' : 'Izin Keluar Sementara (Wajib lapor saat kembali)' }}</b></td>
            </tr>
        </table>
        
        <p>Demikian surat izin ini diberikan agar dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="footer">
        <div class="footer-ttd">
            <p>Guru Piket / Satpam</p>
            <p class="nama-ttd">___________________</p>
        </div>
        <div class="footer-ttd">
            <p>Guru Pemberi Izin</p>
            <p class="nama-ttd">{{ $izin->guruPemberi->name ?? '___________________' }}</p>
        </div>
    </div>
</div>

</body>
</html>
