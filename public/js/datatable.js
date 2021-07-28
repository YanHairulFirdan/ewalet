
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
        

        $('body').on('click','.btn-edit',function () {
            let id = $(this).data('id');
        })

        $('#saveBtn').click(function (event) {
            event.preventDefault();
            let token = $('meta[name="csrf-token"]').attr('content');
            let form = document.getElementById('insertForm')
            console.log(token);
            // console.log($('#insertForm').serialize());

            $.ajax({
                url         : 'transactions',
                data        : new FormData(form),
                type        : 'post',
                dataType    : "JSON",
                contentType : false,
                cache       : false,
                processData : false,
                success : function (data) {
                    console.log(data);
                    table.draw()
                },
                error:function (error) {
                    console.error(error);
                    console.error(error.responseText);
                }
            })
            })
    })

