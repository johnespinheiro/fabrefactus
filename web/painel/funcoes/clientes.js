$(function(){

// select2 - cadastro anuncios - viewlinhas
$('.select2').select2();

    //Datemask - data e telefone
    $('#dtinicio').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('#dtfim').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('#celular').inputmask('(99) 99999-9999', { 'placeholder': '(__) _____-____' });

$('.timepicker').datetimepicker();
    
// escrever em caps
$('.upper').keyup(function(){
    this.value = this.value.toUpperCase();
});

//INICIO ADD CLIENTE - clientes.PHP
//botao div addcliente - clientes.php
  $("#addcliente").click(function(){
      $("#tabelaclientes").hide();
      $("#mostracliente").show();
      $("#menuviewlinhas").hide();
  });

//botao fecha div addcliente - clientes.php
  $("#cancelarcliente").click(function(){
      $("#tabelaclientes").show();
      $("#mostracliente").hide();
      $("#menuviewlinhas").show();
      return false;
  });

  $("#addfotoc").click(function() {
   
  $("#fotoc").removeAttr('disabled');
          var valorc = $("#cadcliente")
        valorc.find('#comfotoc').val('1')
 return false;
  });

    $("#salvarcliente").click(function() {

  var emailcliente = $("#email").val();
  var nomecliente = $("#nome").val();
  var senhacliente = $("#senha").val();
  var emailFilter=/^.+@.+\..{2,}$/;
  var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/

if (emailcliente == "") {
  alert('Preencha o e-mail do cliente');
  return false;
}

if(!(emailFilter.test(emailcliente))||emailcliente.match(illegalChars)) {
  alert('preencha um email valido');
  return false;
}

if (nomecliente == "") {
  alert('Preencha o nome do cliente');
  return false;
}
if (senhacliente == "") {
  alert('preencha uma senha para o cliente');
  return false;
}
        //stop submit the form, we will post it manually.
//        event.preventDefault();
        // Get form
        var form = $('#cadcliente')[0];
    // Create an FormData object 
        var data = new FormData(form);
//   var dadoscliente = $('#cadcliente').serialize();
$("#cadcliente").hide();
$("#salvarcliente").attr('disabled', 'disabled');
      $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',      
      url: 'funcoes/inserecliente.php',
      data: data,
      processData: false,  // tell jQuery not to process the data
      contentType: false,   // tell jQuery not to set contentType
      cache: false,

        success: function(data) {
//             alert('Cliente cadastrado!');
                     $("#tabelaclientes").html(data);
                     $("#tabelaclientes").show(data);
                     window.location.reload();
                },
                            error: function (err) {//Detecta erros na requisição
                alert(err);
            }
            });

            return false;
        });
//verifica se já existe na db - input codlinha
$("#email").blur(function(verifica) {
  var vemailcliente = $(this).val();
    $.ajax({
      url: 'funcoes/verificacliente.php',
      type: 'POST',
      data:{emailcliente: vemailcliente},
//      dataType: JSON,
      cache: false,
      success: function(data) {
//        if(data === "Linha ja cadastrada") {
//        alert(data);
        $("#resultadoemailcliente").html(data);
//        $("#salvarlinha").attr('disabled', 'disabled');
//      }
      }
    })
return false;
    
});
//FIM ADD CLIENTES - CLIENTES.PHP


})