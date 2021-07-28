$(document).ready(function() {
        $.noConflict();

        var token = ''
        var modal = $('.modal');
        var form = $('.form');

        var btnAdd = $('.add'),
            btnSave = $('.btn-save'),
            btnUpdate = $('.btn-update');

        var table = $('#transactions').DataTable({
            ajax: '',
            serverSide: true,
            processing: true,
            // deferLoading: 10,
            aaSorting: [
                [0, 'desc']
            ],
            columns: [{
                    data: 'id',
                    name: 'id'
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
            ]
        });

    })

