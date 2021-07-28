@extends('layouts.app')

@section('title')
    <title>Transaksi Anda</title>
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">
                <div class="p-2">
                    <h3>
                        Transaksi
                    </h3>
                </div>
                <div class="p-2">
                    <!-- Button trigger modal -->
                    <button type="button" class=" d-inline-block btn btn-primary ml-auto" data-toggle="modal"
                        data-target="#insertModal">
                        Input Transaksi
                    </button>
                </div>
            </div>

            <table id="transactions" class="mt-10 table table-bordered table-condensed table-striped">
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

    {{-- insert modal --}}
    <!-- Modal -->
    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="insertForm">
                        @csrf
                        @method('POST')
                        <div class="form-group"><label for="buyer">
                                Pembeli
                            </label>
                            <input type="text" class="form-control" name="buyer">
                        </div>
                        <div id="buyer_error" class="alert alert-danger d-none">

                        </div>
                        <div class="form-group"><label for="weight">
                                Berat Total
                            </label>
                            <input type="text" class="form-control" name="weight">
                        </div>
                        <div id="weight_error" class="alert alert-danger d-none">

                        </div>
                        <div class="form-group"><label for="price_per_kilo">
                                Harga Perkilo
                            </label>
                            <input type="text" class="form-control" name="price_per_kilo">
                        </div>
                        <div id="price_per_kilo_error" class="alert alert-danger d-none">

                        </div>
                        <button type="submit" id="saveBtn" class="btn btn-primary btn-lg btn-block mt-10 ml-auto">Simpan
                            data</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- end of insert modal --}}

    {{-- update modal --}}
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of update modal --}}

    {{-- message modal --}}
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert" id="message">
                        Are you sure?
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- end of message modal --}}

@endsection
@push('js')
    {{-- @include('layouts.datatable') --}}
    <script src="{{ asset('js/datatable.js') }}"></script>
@endpush