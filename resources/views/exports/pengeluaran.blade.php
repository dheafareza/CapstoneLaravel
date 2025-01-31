<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengeluaran</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Data Pengeluaran</h2>
    <table>
        <thead>
            <tr>
                <th>ID Pengeluaran</th>
                <th>Tgl Pengeluaran</th>
                <th>Jumlah</th>
                <th>ID Sumber</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->tgl_pengeluaran }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->id_sumber_pengeluaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
