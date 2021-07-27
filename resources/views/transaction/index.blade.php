@extends('layouts.app')

@section('title')
    <title>Transaksi Anda</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>
                Transaksi
                {{-- <button>Tam</button> --}}
            </h3>

            <table id="transactions" class="table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th>
                            no
                        </th>
                        <th>
                            Tanggal Transaksi
                        </th>
                        <th>
                            Pembeli
                        </th>
                        <th>
                            Berat
                        </th>
                        <th>
                            Harga Perkilo
                        </th>
                        <th>
                            Total Harga
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
