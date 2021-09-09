<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
     <div class="container-fluid">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Nama Pembeli
                    </th>
                    <th>
                        Berat
                    </th>
                    <th>
                        Harga Jual Perkilogram
                    </th>
                    <th>
                        Hasil
                    </th>
                    <th>
                        Tanggal Transaksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$transaction->buyer}}
                        </td>
                        <td>
                            {{$transaction->weigth}}
                        </td>
                        <td>
                            {{$transaction->price_per_kilo}}
                        </td>
                        <td>
                            {{$transaction->total_price}}
                        </td>
                        <td>
                            {{$transaction->created_at}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>