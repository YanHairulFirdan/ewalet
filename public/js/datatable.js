const crudDataTable = {
    dataTable : null,
    make : function (columnConfig, tableId, url = '') {
        $.noConflict();
    
        this.dataTable = $('#'+tableId).DataTable({
            ajax: url,
            serverSide: true,
            length: 25,
            processing: true,
            aaSorting: [
                [0, 'desc']
            ],
            columns: columnConfig
        });
    },
    edit : function (event) {
        let transaction = {};
        let button = event.target
        let id = button.getAttribute('data-id')
        let url = button.getAttribute('data-url')

        $.get(url+'/'+id, function (data, status) {
            transaction = data.transaction;
            $('#updateModal').modal('show');
            console.log(transaction)
            for (const field in transaction) {
                $('#edit_'+field).val(transaction[field])
            }
        });
    },
    delete : function (event) {
        let transaction = {};
        let button = event.target
        let id = button.getAttribute('data-id')
        let url = button.getAttribute('data-url')

        if(confirm('Apakah anda ingin menghapus data ini?')){
            let form = new FormData();
            form.append('_method', 'DELETE');
            this.ajax(url+'/'+id, form, '', 'DELETE', table);
        }
    },
    display_error : function(errors) {
        for (const error of Object.keys(errors)) {
            let alert = document.getElementById(error + "_error");
            
            alert.classList.toggle('d-none');

            alert.innerText = errors[error];
            
            $("#" + error + "_error").fadeOut(5000, function () {
                document.getElementById(error + "_error").classList.toggle('d-none');
            })
        }
    },
    update : function (event) {
        event.preventDefault();
        let form = document.getElementById('updateForm')

        this.ajax('transactions/'+id, new FormData(form), '#updateModal', 'POST', table)
    },

    ajax : function(url, formData, modal, method) {
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
                this.datatable.draw()
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

}

    // $(document).ready(function() {
        
        

        
    // });

    
