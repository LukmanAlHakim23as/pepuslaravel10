<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        /* CSS styling untuk laporan PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Laporan Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Peminjam</th>
                <th>Admin/Pustakawan</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $pinjam)
                <tr>
                    <td>{{ $pinjam->id }}</td>
                    <td>{{ $pinjam->buku->judul }}</td>
                    <td>{{ $pinjam->user->name }}</td>
                    <td>{{ $pinjam->admin->name }}</td>
                    <td>{{ $pinjam->created_at->format('d M Y') }}</td>
                    <td>{{ $pinjam->tgl_kembali }}</td>
                    <td class="text-center"><span
                        class="p-2 badge badge-{{ $pinjam->history ? 'success' : 'warning' }}">{{ $pinjam->history ? 'Dikembalikan' : 'Dipinjam' }}</span>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
