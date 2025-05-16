<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detil Mahasiswa</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
            width: 30%;
        }
        h2 {
            text-align: center;
        }
        .ttd {
            margin-top: 60px;
            width: 100%;
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>Detil Data Mahasiswa</h2>
    <table>
        <tbody>
            <tr>
                <th>NIM</th>
                <td>{{ $mahasiswa->nim }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $mahasiswa->user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $mahasiswa->user->email }}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $mahasiswa->prodi->nama_prodi }}</td>
            </tr>
            <tr>
                <th>Fakultas</th>
                <td>{{ $mahasiswa->prodi->fakultas->nama_fakultas }}</td>
            </tr>
            <tr>
                <th>Tahun Masuk</th>
                <td>{{ $mahasiswa->tahun_masuk }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $mahasiswa->alamat }}</td>
            </tr>
            <tr>
                <th>No. HP</th>
                <td>{{ $mahasiswa->no_hp }}</td>
            </tr>
            <tr>
                <th>Judul Skripsi</th>
                <td>{{ $mahasiswa->judul_skripsi }}</td>
            </tr>
            <tr>
                <th>Dosen Pembimbing</th>
                <td>{{ $mahasiswa->dosen_pembimbing }}</td>
            </tr>
            <tr>
                <th>Status Skripsi</th>
                <td>{{ ucwords(str_replace('_', ' ', $mahasiswa->status_skripsi)) }}</td>
            </tr>
            <tr>
                <th>Tanggal Mulai Skripsi</th>
                <td>{{ $mahasiswa->tanggal_mulai_skripsi }}</td>
            </tr>
            <tr>
                <th>Tanggal Sidang</th>
                <td>{{ $mahasiswa->tanggal_sidang ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="ttd">
        <p>Mengetahui,</p>
        <p>Dosen Pembimbing</p>
        <br><br><br>
        <p style="font-weight: bold; text-decoration: underline;">{{ $mahasiswa->dosen_pembimbing }}</p>
    </div>
</body>
</html>
