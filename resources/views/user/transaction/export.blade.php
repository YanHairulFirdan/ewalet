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
    <h4 class="text-center font-weight-bold">{{$title}}</h4>
    <hr>
     <div class="container-fluid">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td class="small text-center font-weight-bold">
                        No
                    </th>
                    <td class="small text-center font-weight-bold">
                        Nama Pembeli
                    </th>
                    <td class="small text-center font-weight-bold">
                        Berat
                    </th>
                    <td class="small text-center font-weight-bold">
                        Harga Jual Perkilogram
                    </th>
                    <td class="small text-center font-weight-bold">
                        Hasil
                    </th>
                    <td class="small text-center font-weight-bold">
                        Tanggal Transaksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td class="small">
                            {{$loop->iteration}}
                        </td>
                        <td class="small">
                            {{$transaction->buyer}}
                        </td>
                        <td class="small">
                            {{$transaction->weight}} Kg
                        </td>
                        <td class="small">
                            Rp. {{$transaction->price_per_kilo}}
                        </td>
                        <td class="small">
                            Rp. {{$transaction->total_price}}
                        </td>
                        <td class="small">
                            {{$transaction->created_at}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>