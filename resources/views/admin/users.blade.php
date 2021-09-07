@extends('layouts.app')

@section('title')
    <meta content="{{ url()->current() }}" name="current-url">
    <title>Users</title>
@endsection

@section('content')
    <h1 class="mt-4">Daftar Pengguna</h1>
    <form action="" method="post" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <label for="month" class="mb-2">Select Month</label>
                <select class="form-control" name="month" id="month">
                    <option value="">Default</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="status" class="mb-2">Select Status</label>
                 <select class="form-control" name="status" id="status">
                    <option value="">Default</option>
                    <option value="1">Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
        </div>
    </form>
    <table id="users" class="mt-10 table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <td>
                    No
                </td>
                <td>
                    Nama
                </td>
                <td>
                    Nomor Telepon
                </td>
                <td>
                    Status
                </td>
            </tr>
        </thead>
    </table>
@endsection
@push('js')
    <script defer src="{{ asset('js/datatable.js') }}"></script>
    <script defer src="{{ asset('js/ajaxCrud.js') }}"></script>
    <script>
        let columnConfig = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                // searchable: false,
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
        ];
        let url = document.querySelector("meta[name='current-url']").content

        let callbackData = function (data) {
                                data.month = $('#month').val();
                                data.status = $('#status').val();
                                
                            }

        // function make_datatable(columnConfig, table, callbackData) {
             
        // });

        $('#users').DataTable({
                ajax: {
                    url: '',
                    data: function (data) {
                            data.month = $('#month').val();
                            data.status = $('#status').val();
                            
                        }
                },
                serverSide : true,
                length: 25,
                processing: true,
                aaSorting: [
                    [0, 'desc']
                ],
                columns: columnConfig
})

        // let datatable = make_datatable(columnConfig, 'users', callbackData)
        // console.log(datatable);

        // crudDataTable.table = 'users'
        // crudDataTable.make(datatable)

        $('#month').on('change', function (event) {
            dataTable.draw()
            event.preventDefault()
        })
       
        $('#status').on('change', function (event) {
            dataTable.draw()
            event.preventDefault()
        })
    </script>
@endpush
