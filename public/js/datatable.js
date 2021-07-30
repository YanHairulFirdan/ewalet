    $(document).ready(function() {
        
        $.noConflict();

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
        
        $('body').on('click','.btn-delete',function () {
            let transaction = {};
            id = $(this).data('id')
            // let confirm = confirm('Apakah anda ingin menghapus data ini?');

            if(confirm('Apakah anda ingin menghapus data ini?')){
                // console.log(confirm);
                let form = new FormData();
                form.append('_method', 'DELETE');

                ajax('transactions/'+id, form, '', 'DELETE', table);
            }
        })

        $('#updateBtn').click(function (event) {
            event.preventDefault();
            let form = document.getElementById('updateForm')
            
            ajax('transactions/'+id, new FormData(form), '#updateModal', 'POST', table)
            
            })
        
        $('#saveBtn').click(function (event) {
            event.preventDefault();
            let form = document.getElementById('insertForm')

            ajax('transactions', new FormData(form), '#insertModal', 'POST', table)
        
            })
    });

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

    function ajax(url, formData, modal, method, datatable) {
        $.ajax({
            type        : method,
            url         : url,
            headers     : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
            }, 
            data        : formData,
            dataType    : "JSON",
            contentType : false,
            cache       : false,
            processData : false,
            success : function (data) {
                $('#messageModal').modal('show');
                $(modal).modal('hide');
                $('#message').html(data.message);
                $('#message').addClass('alert-' + data.class);
                datatable.draw()
            },
            error:function (error) {
                console.log(error);
                if(error.statusCode){
                    console.log(error);
                    $('#messageModal').modal('show');
                    $('#message').html(error.statusCode.statusText);
                    $('#message').addClass('alert-danger');
                }
                display_error(error.responseJSON.errors)
            }
         })
    }
