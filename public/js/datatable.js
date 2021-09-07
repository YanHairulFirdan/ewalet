const datatableObj = {
    make : function(columnConfig, table, callbackData) {
        $.noConflict(callbackData);

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

