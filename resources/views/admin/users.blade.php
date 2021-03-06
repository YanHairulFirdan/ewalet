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
                <select class="form-control filter" name="month" id="month">
                    <option value="">Default</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="year" class="mb-2">Select year</label>
                 <select class="form-control filter" name="year" id="year">
                    <option value="">Default</option>
                    @foreach ($signUpYears as $signUpYear)
                        <option value="{{$signUpYear->year}}">{{$signUpYear->year}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="status" class="mb-2">Select Status</label>
                 <select class="form-control filter" name="status" id="status">
                    <option value="">Default</option>
                    <option value="1">Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
        </div>
    </form>
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
