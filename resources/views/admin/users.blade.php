@extends('layouts.app')

@section('title')
    <meta content="{{ url()->current() }}" name="current-url">
    <title>Users</title>
@endsection

@section('content')
    <h1 class="mt-4">Daftar Pengguna</h1>
    <form action="" method="post" class="mb-4">
        <select name="month" id="month">

        </select>
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
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script>
        let columnConfig = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                // searchable: false,
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'phone_number',
                name: 'phone_number'
            },
            {
                data: 'status',
                name: 'user.subscription',
                orderable: false,
                searchable: false,
            },
        ];
        let url = document.querySelector("meta[name='current-url']").content

        crudDataTable.table = 'users'
        crudDataTable.columnConfig = columnConfig
        console.log(crudDataTable.columnConfig);
        crudDataTable.make()

        $('#month').on('change', function (event) {
            crudDataTable.dataTable.draw()
            event.preventDefault()
        })
    </script>
@endpush
