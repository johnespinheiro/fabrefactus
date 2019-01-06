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

//INICIO ADD CARROS - PAG VIEWLINHAS.PHP
//botao abre div addcarros
  $("#addcarros").click(function(){
      $("#tabelacarros").hide();
      $("#mostracarro").show();
      $("#menuviewlinhas").hide();
  });
// botao cancelar - fecha div addcarros
  $("#cancelarcarro").click(function(){
      $("#tabelacarros").show();
      $("#mostracarro").hide();
      $("#menuviewlinhas").show();
      $("#numerocarro").val("");
//      $("#resultado").hide();
      return false;
  });
// botao salvar carro
$("#salvarcarro").click(function() {
  var numerocarro = $("#numerocarro").val();

if (numerocarro == "") {
  alert('Preencha o numero do carro');
  return false;
}
 //ajax cadastrar carro
  var dadoscarro = $('#cadcarro').serialize();
$("#cadcarro").hide();
$("#salvarcarro").attr('disabled', 'disabled');

      $.ajax({
        url: 'funcoes/inserecarro.php',
        type: 'POST',
 //       dataType: 'json',
        data: dadoscarro,
        cache: false,

        success: function(data) {
//             alert('Carro cadastrado!');
                     $("#tabelacarros").html(data);
                     $("#tabelacarros").show(data);
                     window.location.reload();
                },
                            error: function (err) {//Detecta erros na requisição
                alert(err);
            }
            });

            return false;
        });
//verifica se já existe na db - input codlinha
$("#numerocarro").blur(function(verifica) {
  var vnumerocarro = $(this).val();
  var vidlinha = $("#idlinha").val();

    $.ajax({
      url: 'funcoes/verificacarro.php',
      type: 'POST',
      data:{numerocarro: vnumerocarro,
            idlinha: vidlinha,
      },
//      dataType: JSON,
      cache: false,
      success: function(data) {
//        if(data === "Linha ja cadastrada") {
//        alert(data);
        $("#resultadonumerocarro").html(data);
//        $("#salvarlinha").attr('disabled', 'disabled');
//      }
      }
    })
return false;
    
});
//FIM ADD CARRO - PAG VIEWLINHAS.PHP
//INICIO ADD CLIENTE - VIEWLINHAS.PHP
//botao div addcliente - viewlinhas
  $("#addcliente").click(function(){
      $("#tabelacarros").hide();
      $("#mostracliente").show();
      $("#menuviewlinhas").hide();
  });

//botao fecha div addcliente - viewlinhas
  $("#cancelarcliente").click(function(){
      $("#tabelacarros").show();
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

if (emailcliente == "") {
  alert('Preencha o e-mail do cliente');
  return false;
}
if (nomecliente == "") {
  alert('Preencha o nome do cliente');
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
                     $("#tabelacarros").html(data);
                     $("#tabelacarros").show(data);
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
//FIM ADD CLIENTES - VIEWLINHAS.PHP
//INICIO ADD ANUNCIO - VIEWLINHAS.PHP
      $("#addanuncio").click(function(){
      $("#tabelacarros").hide();
      $("#mostraanuncio").show();
      $("#menuviewlinhas").hide();
  });

  $("#cancelaranuncio").click(function(){
      $("#tabelacarros").show();
      $("#mostraanuncio").hide();
      $("#menuviewlinhas").show();
      return false;
  });

  $("#addfotoa").click(function() {
   
  $("#fotoa").removeAttr('disabled');
          var valora = $("#cadanuncio")
        valora.find('#comfotoa').val('1')
 return false;
  });

    $("#salvaranuncio").click(function() {

        //stop submit the form, we will post it manually.
        event.preventDefault();

        // Get form
        var form = $('#cadanuncio')[0];

    // Create an FormData object 
        var data = new FormData(form);

 //     var dadosanuncio = $('#cadanuncio').serialize()
$("#salvaranuncio").attr('disabled', 'disabled');

$("#cadanuncio").hide();

      $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',      
      url: 'funcoes/insereanuncio.php',
      data: data,
      processData: false,  // tell jQuery not to process the data
      contentType: false,   // tell jQuery not to set contentType
      cache: false,

        success: function(data) {
//             alert('Anuncio cadastrado!');
                     $("#tabelacarros").html(data);
                     $("#tabelacarros").show(data);
                     $("#salvaranuncio").removeAttr('disabled');
                     window.location.reload();
                },
                            error: function (err) {//Detecta erros na requisição
                alert(err);
            }
            });

            return false;
        });

})