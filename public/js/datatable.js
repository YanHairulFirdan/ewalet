const datatableObj = {
    make : function(columnConfig, table, callbackData) {
        console.log('ok');
        return $('#'+table).DataTable({
            ajax: {
                url: '',
                data: callbackData
            },
            serverSide : true,
            length: 25,
            processing: true,
            aaSorting: [
                [0, 'desc']
            ],
            columns: columnConfig
        })
    }
}

console.log(datatableObj);