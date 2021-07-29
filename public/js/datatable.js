    $(document).ready(function() {
        
        $.noConflict();

        var id = ''
        var modal = $('.modal');
        var form = $('.form');

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
            let transaction = {};
            id = $(this).data('id')
            $.get('transactions/'+id, function (data, status) {
                transaction = data.transaction;
                $('#updateModal').modal('show');
                console.log(transaction);

                for (const field in transaction) {
                    $('#edit_'+field).val(transaction[field])
                }
            });
        })

        $('#updateBtn').click(function (event) {
            event.preventDefault();
            let form = document.getElementById('updateForm')
            let data = {
                    _method        : 'POST',
                    buyer          : $('#edit_buyer').val(),
                    weight         : $('#edit_weight').val(),
                    price_per_kilo : $('#edit_price_per_kilo').val(),
                };
            
            $.ajax({
                type        : 'POST',
                url         : 'transactions/'+id,
                headers     : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                    // "Content-Type": "application/json",
                }, 
                data        : new FormData(form),
                dataType    : "JSON",
                contentType : false,
                cache       : false,
                processData : false,
                success : function (data) {
                    console.log(data);
                    $('#messageModal').modal('show');
                    $('#updateModal').modal('hide');
                    $('#message').html(data.message);
                    $('#message').addClass('alert-' + data.class);
                    table.draw()
                },
                error:function (error) {
                    display_error(error.responseJSON.errors)
                }
            })
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

function ajax(url, formData, modal, method) {
    $.ajax({
        url         : url,
        type        : method,
        data        : formData,
        dataType    : "JSON",
        contentType : false,
        cache       : false,
        processData : false,
        success     : function (response) {
            $(modal).modal('hide');
            $('#messageModal').modal('show');
            $('#message').html(response.message);
            $('#message').addClass('alert-' + response.class);
        },
        error       : function (error) {
            display_error(error.responseJSON.errors)


            }
    });
}

function show_message(id, type, message) {
    }