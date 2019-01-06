$('a.deletelinha').click(function()
{
    var id = $(this).attr('id');
    var table = $(this).attr('data-tabela');
    var codlinha = $(this).attr('data-codlinha');
//    var fotomov = $(this).attr('data-fotomov');
//    var foto = $(this).attr('data-foto');
//    var username = $(this).attr('data-usuarionome');
//    var carro = $(this).attr('data-carro');
//    var status = $(this).attr('data-status');
    var data = 'id=' + id ;
    var tabela = 'tabela=' + table;

    $('#confirm-deletelinha').modal('show'); 
    $("#confirm-deletelinha").modal().find(".btn-ok").unbind('click');
    $("#confirm-deletelinha").modal().find(".btn-ok").on("click", function(){
    $('#confirm-deletelinha').modal('hide'); 

     $.ajax(
        {
               type: "POST",
               url: "modaldelete/deletarlinha.php",
               data: {id: id,
               tabela: table,
               codlinha: codlinha,
//               fotomov: fotomov,
//               foto: foto,
//               usuarionome: username,
//               carro: carro,
//               status: status,
             },
               cache: false,

               success: function()
               {
//                    $('#confirm-delete2').modal('show');
//                     $("#confirm-delete2").modal().find(".confirmado").on("click", function(){
//                     $('.botao-form').attr("disabled", true);                                
//                     $('.botao-form').html("Aguarde...");
//                      $('confirm-delete').modal('show');
                      alert('LINHA excluida com sucesso.');  
                        window.location.href = 'linhas.php'; 
//                        window.location.reload();
                       
//                     });
               }
         });                

      });
});

$('a.deletecarro').click(function()
{
    var idcarro = $(this).attr('idcarro');
    var idlinha = $(this).attr('idlinha');
    var table = $(this).attr('data-tabela');
    var codlinha = $(this).attr('data-codlinha');
    var carro = $(this).attr('data-carro');
//    var username = $(this).attr('data-usuarionome');
//    var carro = $(this).attr('data-carro');
//    var status = $(this).attr('data-status');
//    var data = 'id=' + id ;
//    var tabela = 'tabela=' + table;

    $('#confirm-deletecarro').modal('show'); 
    $("#confirm-deletecarro").modal().find(".btn-ok").unbind('click');
    $("#confirm-deletecarro").modal().find(".btn-ok").on("click", function(){
    $('#confirm-deletecarro').modal('hide'); 

     $.ajax(
        {
               type: "POST",
               url: "modaldelete/deletarcarro.php",
               data: {idcarro: idcarro,
               idlinha: idlinha,
               tabela: table,
               codlinha: codlinha,
//               usuarionome: username,
               carro: carro,
//               status: status,
             },
               cache: false,

               success: function()
               {
//                    $('#confirm-delete2').modal('show');
//                     $("#confirm-delete2").modal().find(".confirmado").on("click", function(){
//                     $('.botao-form').attr("disabled", true);                                
//                     $('.botao-form').html("Aguarde...");
//                      $('confirm-delete').modal('show');
                      alert('CARRO excluido com sucesso.');  
                        window.location.href = "carrosi.php"; 
//                        window.location.reload();
                       
//                     });
               }
         });                

      });
});
$('a.deletecliente').click(function()
{
    var id = $(this).attr('id');
    var table = $(this).attr('data-tabela');
    var foto = $(this).attr('data-foto');
    var dfoto = $(this).attr('data-dfoto');
//    var fotomov = $(this).attr('data-fotomov');
//    var codlinha = $(this).attr('data-codlinha');
//    var carro = $(this).attr('data-carro');
//    var username = $(this).attr('data-usuarionome');
//    var carro = $(this).attr('data-carro');
//    var status = $(this).attr('data-status');
//    var data = 'id=' + id ;
//    var tabela = 'tabela=' + table;

    $('#confirm-deletecliente').modal('show'); 
    $("#confirm-deletecliente").modal().find(".btn-ok").unbind('click');
    $("#confirm-deletecliente").modal().find(".btn-ok").on("click", function(){
    $('#confirm-deletecliente').modal('hide'); 

     $.ajax(
        {
               type: "POST",
               url: "modaldelete/deletarcliente.php",
               data: {id: id,
               tabela: table,
               foto: foto,
               dfoto: dfoto,
//               fotomov: fotomov,
//               codlinha: codlinha,
//               usuarionome: username,
//               carro: carro,
//               status: status,
             },
               cache: false,

               success: function()
               {
//                    $('#confirm-delete2').modal('show');
//                     $("#confirm-delete2").modal().find(".confirmado").on("click", function(){
//                     $('.botao-form').attr("disabled", true);                                
//                     $('.botao-form').html("Aguarde...");
//                      $('confirm-delete').modal('show');
//alert(foto);
                      alert('CLIENTE excluido com sucesso.');  
                        window.location.href ='clientesi.php'; 
//                        window.location.reload();
                       
//                     });
               }
         });                

      });
});
