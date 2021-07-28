
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
            let form = document.getElementById('insertForm')
        
            $.ajax({
                url         : 'transactions',
                data        : new FormData(form),
                type        : 'post',
                dataType    : "JSON",
                contentType : false,
                cache       : false,
                processData : false,
                success : function (data) {
                    $('#messageModal').modal('show');
                    $('#insertModal').modal('hide');
                    $('#message').html(data.message);
                    $('#message').addClass('alert-' + data.class);
                    table.draw()
                },
                error:function (error) {
                    display_error(error.responseJSON.errors)
                }
            })
        })
    })

    function display_error(errors) {
    for (const error of Object.keys(errors)) {
        let alert = document.getElementById(error + "_error");
        
        alert.classList.toggle('d-none');

        alert.innerText = errors[error];
        
        $("#" + error + "_error").fadeOut(5000, function () {
            document.getElementById(error + "_error").classList.toggle('d-none');
        })
    }
}

function show_message(id, type, message) {
    // $('#'+id).
}