<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Daftar Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Program Studi</th>
                <th>Fakultas</th>
                <th>Tahun Masuk</th>
                <th>Status</th>
                <th>Judul Skripsi</th>
                <th>Status Skripsi</th>
                <th>Dosen Pembimbing</th>
                <th>Tgl Mulai Skripsi</th>
                <th>Tgl Sidang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $i => $mhs)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->user->name }}</td>
                    <td>{{ $mhs->user->email }}</td>
                    <td>{{ $mhs->prodi->nama_prodi }}</td>
                    <td>{{ $mhs->prodi->fakultas->nama_fakultas }}</td>
                    <td>{{ $mhs->tahun_masuk }}</td>
                    <td>{{ ucfirst($mhs->status) }}</td>
                    <td>{{ $mhs->judul_skripsi }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $mhs->status_skripsi)) }}</td>
                    <td>{{ $mhs->dosen_pembimbing }}</td>
                    <td>{{ $mhs->tanggal_mulai_skripsi }}</td>
                    <td>{{ $mhs->tanggal_sidang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
