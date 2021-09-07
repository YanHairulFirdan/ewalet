const datatableObj = {
    make : function(config, table) {
        $.noConflict(config.callbackData);

        return $('#'+table).DataTable({
            ajax: {
                url: '',
                data: config.callbackData
            },
            serverSide : true,
            length: 25,
            processing: true,
            aaSorting: [
                [0, 'desc']
            ],
            columns: config.column,
        })
    }
}

