$('a.desativarlinha').click(function()
{
    var id = $(this).attr('id');
    var table = $(this).attr('data-tabela');
    var codlinha = $(this).attr('data-codlinha');
//    var username = $(this).attr('data-usuarionome');
//    var carro = $(this).attr('data-carro');
//    var status = $(this).attr('data-status');
    var data = 'id=' + id ;
    var tabela = 'tabela=' + table;

    $('#confirm-desativarlinha').modal('show'); 
    $("#confirm-desativarlinha").modal().find(".btn-ok").unbind('click');
    $("#confirm-desativarlinha").modal().find(".btn-ok").on("click", function(){
    $('#confirm-desativarlinha').modal('hide'); 

     $.ajax(
        {
               type: "POST",
               url: "modaldesativar/desativarlinha.php",
               data: {id: id,
               tabela: table,
               codlinha: codlinha,
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
                      alert('LINHA desativada com sucesso.');  
                        window.location.href = 'linhas.php'; 
//                        window.location.reload();
                       
//                     });
               }
         });                

      });
});

$('a.desativarcarro').click(function()
{
    var id = $(this).attr('id');
    var table = $(this).attr('data-tabela');
    var codlinha = $(this).attr('data-codlinha');
//    var username = $(this).attr('data-usuarionome');
    var carro = $(this).attr('data-carro');
//    var status = $(this).attr('data-status');
    var data = 'id=' + id ;
    var tabela = 'tabela=' + table;

    $('#confirm-desativarcarro').modal('show'); 
    $("#confirm-desativarcarro").modal().find(".btn-ok").unbind('click');
    $("#confirm-desativarcarro").modal().find(".btn-ok").on("click", function(){
    $('#confirm-desativarcarro').modal('hide'); 

     $.ajax(
        {
               type: "POST",
               url: "modaldesativar/desativarcarro.php",
               data: {id: id,
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
                      alert('CARRO desativado com sucesso.');  
//                        window.location.href = 'linhas.php'; 
                        window.location.reload();
                       
//                     });
               }
         });                

      });
});
$('a.desativarcliente').click(function()
{
    var id = $(this).attr('id');
    var table = $(this).attr('data-tabela');
//    var codlinha = $(this).attr('data-codlinha');
//    var username = $(this).attr('data-usuarionome');
//    var carro = $(this).attr('data-carro');
//    var status = $(this).attr('data-status');
    var data = 'id=' + id ;
    var tabela = 'tabela=' + table;

    $('#confirm-desativarcliente').modal('show'); 
    $("#confirm-desativarcliente").modal().find(".btn-ok").unbind('click');
    $("#confirm-desativarcliente").modal().find(".btn-ok").on("click", function(){
    $('#confirm-desativarcliente').modal('hide'); 

     $.ajax(
        {
               type: "POST",
               url: "modaldesativar/desativarcliente.php",
               data: {id: id,
               tabela: table,
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
                      alert('CLIENTE desativado com sucesso.');  
                        window.location.href = 'clientes.php'; 
//                        window.location.reload();
                       
//                     });
               }
         });                

      });
});