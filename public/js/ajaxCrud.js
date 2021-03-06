const crudDataTable = {
    dataTable : null,
    url : function () {
        let url = window.location.href;
        let cleaneUurl = url.charAt(url.length-1) == '/'? url.slice(0,-1):url;

        return cleaneUurl;
    },
    make : function (datatable) {
        this.dataTable = datatable
    },
    store : function (event, url) {
        event.preventDefault();

        let form = document.getElementById('insertForm')

        this.ajax(url, new FormData(form), '#insertModal', 'POST')

        form.reset();
    },
    edit : function (event) {
        let responseData = {};
        let button = event.target
        let id = button.getAttribute('data-id')

        $.get(this.url() +'/'+ id, function (data, status) {
            let keys = Object.keys(data)
            console.log(data);
            let responseData = data[keys[0]];
            console.log(responseData);
            $('#updateModal').modal('show');
            $('#updateModal').css('opacity',1);
            $('#edit_id').val(id)
            for (const field in responseData) {
                $('#edit_'+field).val(responseData[field])
            }
        });
    },
    delete : function (event) {
        let button = event.target
        let id = button.getAttribute('data-id')

        console.log(this.url() +'/'+id);
        if(confirm('Apakah anda ingin menghapus data ini?')){
            let form = new FormData();
            form.append('_method', 'DELETE');

            this.ajax(this.url() +'/'+id, form, '', 'DELETE');
        }
    },
    update : function (event) {
        event.preventDefault();
        let form = document.getElementById('updateForm')
        let id = $('#edit_id').val();
        let formData =  new FormData(form);

        if ($('*[data-type="price"]').length) {
            let name = $('*[data-type="price"]').attr('name');
            formData.set(name, removeComma(formData.get(name)))
        }

        this.ajax(this.url() +'/'+id, formData, '#updateModal', 'POST')
    },
    ajax : function(url, formData, modal, method) {
        let dataTableObj = this.dataTable;

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
                swal("Done!", data.message, "success");

                dataTableObj? dataTableObj.draw() : window.location.reload();
            },
            error:function (error) {
                if(error.status){
                    let errors = error.responseJSON.errors;

                    for (const error of Object.keys(errors)) {
                        let alert = document.getElementById(error + "_error");

                        if(alert.classList.contains('d-none'))
                            alert.classList.remove('d-none');

                        alert.innerText = errors[error][0];
                    }
                }
            }
         })
    },
    showErrors : function(errors) {
        for (const error of Object.keys(errors)) {
            let alert = document.getElementById(error + "_error");
            alert.classList.toggle('d-none');
            alert.innerText = errors[error];

            $("#" + error + "_error").fadeOut(5000, function () {
                document.getElementById(error + "_error").classList.toggle('d-none');
            })
        }
    },
    success : function () {
        this.dataTable.draw()
    }

}


function removeComma(value) {
    return value.replace(/,/g,'');
}
