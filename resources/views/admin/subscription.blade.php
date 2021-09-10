@extends('layouts.app')

@section('title')
    <meta content="{{ url()->current() }}" name="current-url">
    <title>Users</title>
@endsection

@section('content')
    <h1 class="mt-4">Daftar Harga Langganan</h1>
    <table id="users" class="m-0 w-80 table table-bordered table-condensed table-striped" style="">
        <thead>
            <tr class="text-center">
                <td>
                    No
                </td>
                <td>
                    Nama
                </td>
                <td>
                    Harga
                </td>
                <td>
                    Masa Berlangganan
                </td>
                <td>
                    Aksi
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$type->name}}</td>
                    <td>{{$type->price}}</td>
                    <td>{{$type->subscription_days}}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-id="{{$type->id}}">Edit</button>
                        <button class="btn btn-sm btn-danger"data-id="{{$type->id}}">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

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
                            <label for="name">
                                Nama
                            </label>
                            <input type="text" class="form-control" name="name" id="edit_name">
                        </div>
                        <div id="name_error" class="alert">

                        </div>
                        <div class="form-group">
                            <label for="price">
                                Harga
                            </label>
                            <input type="text" class="form-control" name="price" id="edit_price">
                        </div>
                        <div id="price_error" class="alert">

                        </div>
                        <div class="form-group">
                            <label for="subscription_days">
                                Masa Berlangganan
                            </label>
                            <input type="text" class="form-control" name="subscription_days" id="edit_subscription_days">
                        </div>
                        <div id="subscription_days_error" class="alert">

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
    <script src="{{ asset('js/ajaxCrud.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script defer>
        console.log(crudDataTable);
        $('.btn').click(function (event) {
            crudDataTable.edit(event)
        })
    </script>
    {{-- <script defer>
        const months = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];

        months.forEach(month=>$('#month').append(`<option value="${month}">${month}</option>`))

        let config = {
            column : [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                },
            {
                data: 'name',
                name: 'name',
                
            },
            {
                data: 'phone_number',
                name: 'phone_number',
                
            },
            {
                data: 'status',
                name: 'user.subscription',
                orderable: false,
                searchable: false,
            },
            ],
            callbackData : function (data) {
                                data.month = $('#month').val();
                                data.year = $('#year').val();
                                data.status = $('#status').val();
                                
            }
        };

        let datatable = datatableObj.make(config, 'users')
        
        $('.filter').on('change', function (event) {
            console.log('filter running');
            datatable.draw()
            event.preventDefault()
        });
    </script> --}}
@endpush
