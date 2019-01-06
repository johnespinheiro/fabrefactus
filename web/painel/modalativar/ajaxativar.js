$('a.ativarlinha').click(function()
{
    var id = $(this).attr('id');
    var table = $(this).attr('data-tabela');
    var codlinha = $(this).attr('data-codlinha');
//    var username = $(this).attr('data-usuarionome');
//    var carro = $(this).attr('data-carro');
//    var status = $(this).attr('data-status');
    var data = 'id=' + id ;
    var tabela = 'tabela=' + table;

    $('#confirm-ativarlinha').modal('show'); 
    $("#confirm-ativarlinha").modal().find(".btn-ok").unbind('click');
    $("#confirm-ativarlinha").modal().find(".btn-ok").on("click", function(){
    $('#confirm-ativarlinha').modal('hide'); 

     $.ajax(
        {
               type: "POST",
               url: "modalativar/ativarlinha.php",
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
                      alert('LINHA Ativada com sucesso.');  
                        window.location.href = 'linhasi.php'; 
//                        window.location.reload();
                       
//                     });
               }
         });                

      });
});
$('a.ativarcliente').click(function()
{
    var id = $(this).attr('id');
    var table = $(this).attr('data-tabela');
//    var codlinha = $(this).attr('data-codlinha');
//    var username = $(this).attr('data-usuarionome');
//    var carro = $(this).attr('data-carro');
//    var status = $(this).attr('data-status');
    var data = 'id=' + id ;
    var tabela = 'tabela=' + table;

    $('#confirm-ativarcliente').modal('show'); 
    $("#confirm-ativarcliente").modal().find(".btn-ok").unbind('click');
    $("#confirm-ativarcliente").modal().find(".btn-ok").on("click", function(){
    $('#confirm-ativarcliente').modal('hide'); 

     $.ajax(
        {
               type: "POST",
               url: "modalativar/ativarcliente.php",
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
                      alert('CLIENTE Ativado com sucesso.');  
                        window.location.href = 'clientesi.php'; 
//                        window.location.reload();
                       
//                     });
               }
         });                

      });
});