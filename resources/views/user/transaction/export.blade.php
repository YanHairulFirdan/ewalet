@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered">
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
                            {{$loop->index}}
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
@endsection