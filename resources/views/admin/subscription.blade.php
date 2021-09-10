@extends('layouts.app')

@section('title')
    <meta content="{{ url()->current() }}" name="current-url">
    <title>Users</title>
@endsection

@section('content')
    <h1 class="mt-4">Daftar Harga Langganan</h1>
    <table id="users" class="m-0 w-100 table table-bordered table-condensed table-striped" style="">
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
    <script defer>
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
    </script>
@endpush
