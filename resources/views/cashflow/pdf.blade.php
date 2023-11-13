<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        .title-table:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #04AA6D;
            color: white;
        }

        h2 {
            font-family: Cursive;
        }
    </style>
</head>

<body>

    <table>
        <thead>
           <tr>
                <td colspan="5">
                    <center>
                        <h2>Keungan.IO</h2>
                    </center>
                </td>
           </tr>
            <tr class="title-table">
                <th>Title</th>
                <th>Kategori</th>
                <th>Nominal</th>
                <th>Jenis</th>
                <th>Waktu Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="title-table">
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category_id }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <center><p>footer</p></center>
                </td>
            </tr>
        </tfoot>
    </table>
</body>


</html>
