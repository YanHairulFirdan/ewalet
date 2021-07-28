$(document).ready(function () {
    $.noConflict();

    var token = ''
    var modal = $('.modal')
    var form  = $('.form')

    var btnAdd = $('.add'),
    btnSave    = $('.btn-save'),
    btnUpdate  = $('.btn-update');

    var table = $('#transactions').DataTable({
        ajax:'',
        serverSide : true,
        processing : true,
        aaSorting  : [[0,'desc']],
        columns    : [
            {data:'id', name:'id'},
            {data:'tanggal transaksi', name:'created_at'},
            {data:'buyer', name:'buyer'},
            {data:'berat', name:'weight'},
            {data:'harga perkilo', name:'price_per_kilo'},
            {data:'total harga', name:'total_price'},
        ]
    });

})