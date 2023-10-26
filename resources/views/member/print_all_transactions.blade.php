
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Transaksi</title>
</head>

<body>
    <div class="container">
            <h1>Semua Transaksi</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Member</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->member->name }}</td>
                            <td>{{ $transaction->created_at->format('d F Y') }}</td>
                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script type="text/javascript">
            window.print();
        </script>
</body>

</html>

    
