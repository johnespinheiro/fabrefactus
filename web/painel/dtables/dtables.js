  $(function () {
    $('#dtablelinhas').DataTable( {
        "ajax": "dtables/tblinhas.php",
        "columns": [
        //    { "data": "id" },
            { "data": "linha" },
            { "data": "bairro" },
            { "data": "link" }
        ],
/*initComplete : function () {
    table.buttons().container()
           .appendTo( $('#dtablelinhas_wrapper .col-sm-6:eq(0)'));
},*/	
         "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
    } );

    $('#dtablelinhasi').DataTable( {
        "ajax": "dtables/tblinhasi.php",
        "columns": [
        //    { "data": "id" },
            { "data": "linha" },
            { "data": "bairro" },
            { "data": "link" }
        ],
/*initComplete : function () {
    table.buttons().container()
           .appendTo( $('#dtablelinhas_wrapper .col-sm-6:eq(0)'));
},*/    
         "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
    } );

    $('#dtablecarros').DataTable({


             "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
        });

    $('#dtablecarrosi').DataTable({
        "ajax": "dtables/tblcarrosi.php",
        "columns": [
        //    { "data": "id" },
            { "data": "linha" },
            { "data": "bairro" },
            { "data": "carro" },
            { "data": "link" }
        ],
             "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
        });

    $('#dtablecarros2').DataTable({
        "ajax": "dtables/tblcarros2.php",
        "columns": [
        //    { "data": "id" },
            { "data": "linha" },
            { "data": "bairro" },
            { "data": "carro" },
            { "data": "status" },
            { "data": "link" }
        ],
             "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
        });

    $('#dtablemovimentos').DataTable({
             "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
});

    $('#dtableanuncioativo').DataTable({
             "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
});

    $('#dtableclientes').DataTable( {
        "ajax": "dtables/tblclientes.php",
        "columns": [
        //    { "data": "id" },
            { "data": "nome" },
//            { "data": "endereco" },
            { "data": "telefone" },
            { "data": "email" },
            { "data": "link"}
        ],
/*initComplete : function () {
    table.buttons().container()
           .appendTo( $('#dtablelinhas_wrapper .col-sm-6:eq(0)'));
},*/    
         "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
    });

    $('#dtableclientesi').DataTable( {
        "ajax": "dtables/tblclientesi.php",
        "columns": [
        //    { "data": "id" },
            { "data": "nome" },
//            { "data": "endereco" },
            { "data": "telefone" },
            { "data": "email" },
            { "data": "link"}
        ],
/*initComplete : function () {
    table.buttons().container()
           .appendTo( $('#dtablelinhas_wrapper .col-sm-6:eq(0)'));
},*/    
         "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
    });

    $('#dtableusuarios').DataTable( {
        "ajax": "dtables/tblusuarios.php",
        "columns": [
        //    { "data": "id" },
            { "data": "nome" },
//            { "data": "endereco" },
//            { "data": "telefone" },
            { "data": "email" },
            { "data": "link"}
        ],
/*initComplete : function () {
    table.buttons().container()
           .appendTo( $('#dtablelinhas_wrapper .col-sm-6:eq(0)'));
},*/    
         "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
    });

    $('#dtablehistoricocli').DataTable({

          "language": {
                "url": "inc/Portuguese-Brasil.json"
            }
        });
 
    $('#dtablemail').DataTable({

          "language": {
                "url": "../inc/Portuguese-Brasil.json"
            }
        });
} );
