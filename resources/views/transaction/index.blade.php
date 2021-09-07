@extends('layouts.app')

@section('title')
    <title>Transaksi Anda</title>
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-12">
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

            <div class="row">
                <div class="col-md-2">
                    <form action="" method="post" class="mb-4">
                        <select name="month" id="month" class="form-control">
                            <option value="">Select month</option>
                        </select>
                    </form>
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
                        <div class="form-group">
                            <label for="buyer">
                                Pembeli
                            </label>
                            <input type="text" class="form-control" name="buyer">
                        </div>
                        <div id="buyer_error" class="alert">

                        </div>
                        <div class="form-group">
                            <label for="weight">
                                Berat Total
                            </label>
                            <input type="text" class="form-control" name="weight">
                        </div>
                        <div id="weight_error" class="alert">

                        </div>
                        <div class="form-group">
                            <label for="price_per_kilo">
                                Harga Perkilo
                            </label>
                            <input type="text" class="form-control" name="price_per_kilo">
                        </div>
                        <div id="price_per_kilo_error" class="alert">

                        </div>
                        <button type="submit" id="saveBtn" onclick="crudDataTable.store(event, 'transactions')"
                            class="btn btn-primary btn-lg btn-block mt-10 ml-auto">Simpan
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
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="updateForm">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="buyer">
                                Pembeli
                            </label>
                            <input type="text" class="form-control" name="buyer" id="edit_buyer">
                        </div>
                        <div id="buyer_error" class="alert">

                        </div>
                        <div class="form-group">
                            <label for="weight">
                                Berat Total
                            </label>
                            <input type="text" class="form-control" name="weight" id="edit_weight">
                        </div>
                        <div id="weight_error" class="alert">

                        </div>
                        <div class="form-group">
                            <label for="price_per_kilo">
                                Harga Perkilo
                            </label>
                            <input type="text" class="form-control" name="price_per_kilo" id="edit_price_per_kilo">
                        </div>
                        <div id="price_per_kilo_error" class="alert">

                        </div>
                        <button type="submit" id="updateBtn" onclick="crudDataTable.update(event)"
                            class="btn btn-primary ml-auto">Perbarui
                            data
                        </button>
                    </form>
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
    {{-- <script src="{{ asset('js/ajaxCrud.js') }}"></script> --}}
    <script>
        let columnConfig = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'buyer',
                name: 'buyer'
            },
            {
                data: 'weight',
                name: 'weight'
            },
            {
                data: 'price_per_kilo',
                name: 'price_per_kilo'
            },
            {
                data: 'total_price',
                name: 'total_price'
            },
            {
                data: 'Aksi',
                name: 'Aksi',
                orderable: false,
                searchable: false,
            }
        ];

        crudDataTable.table = 'transactions'
        crudDataTable.columnConfig = columnConfig
        console.log(crudDataTable.columnConfig);
        crudDataTable.make()

        $('#month').on('change', function (event) {
            crudDataTable.dataTable.draw()
            event.preventDefault()
        })
    </script>
@endpush
