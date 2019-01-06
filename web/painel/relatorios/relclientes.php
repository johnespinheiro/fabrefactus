<html>
<head>
<title>Relatorio Clientes</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-html5-1.5.1/b-print-1.5.1/sl-1.2.5/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.2.1/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-html5-1.5.1/b-print-1.5.1/sl-1.2.5/datatables.min.js"></script>



<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<?php 
date_default_timezone_set('America/Sao_Paulo'); 

$today = date("d-m-y H:i:s");
?>
<script type="text/javascript">
	$(document).ready(function() {
    var table = $('#example').DataTable( {

       lengthChange: false,
        buttons: [ 
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                title: 'Clientes - <?php echo $today;?>',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Clientes - <?php echo $today;?>',
                exportOptions: {
                    columns: ':visible'
                }
            },
                     {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
//                    modifier: {
  //                      selected: null
    //                }
                }
            },
            'colvis',
            'selectAll',
            'selectNone',
        ],
        select: {
            style: 'multi'
        },
/*        columnDefs: [ {
            targets: -1,
            visible: false
        } ], */   
//        "processing": true,
//        "serverSide": true,
        "ajax": "listclientes.php",
        "columns": [
//            { "data": "id" },
            { "data": "nome" },
            { "data": "endereco" },
            { "data": "telefone" },
            { "data": "email" },
            { "data": "anuncios" },
            { "data": "ativo" }
        ],
//        serverSide: true,
initComplete : function () {
    table.buttons().container()
           .appendTo( $('#example_wrapper .col-sm-6:eq(0)'));
},
         "language": {
                "url": "Portuguese-Brasil.json",
                 buttons: {
                colvis: 'Colunas',
                copy: 'Copiar',
                print: 'Imprimir',
                selectAll: 'Marcar todos',
                selectNone: 'Desmarcar'
            }
            }
    } );
 
//    table.buttons().container()
//        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );

</script>

<body> <div class="container">
    <h3> Relatório de Clientes </h3>
</div>
    <div class="container">
<table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
            <tr>
                <th>Nome</th>
                <th>Endereco</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Anuncios Ativos</th>
                <th>Ativo</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nome</th>
                <th>Endereco</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Anuncios Ativos</th>
                <th>Ativo</th>
            </tr>
        </tfoot>
    </table> </div>

</body>
</html>