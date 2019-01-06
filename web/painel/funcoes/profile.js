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
   
//    });

//INICIO ADICIONAR USER - PROFILE.PHP
  $("#addfotou").click(function() {
  $("#fotou").removeAttr('disabled');
          var valoru = $("#frmadduser")
        valoru.find('#comfotou').val('1')
 return false;
  });
//INICIO FORM
$("#frmadicionaruser").click(function() {
  var nomeusuario = $("#nomeusuario").val();
  var emailusuario = $("#emailusuario").val();
  var senhausuario = $("#senhausuario").val();

if (nomeusuario == "") {
  alert('Preencha o nome do usuario');
  return false;
}
if (emailusuario == "") {
  alert('Preencha o e-mail do usuario');
  return false;
}
if (senhausuario == "") {
  alert('preencha a senha do usuario');
  return false;
}
   //stop submit the form, we will post it manually.
   event.preventDefault();
    // Get form
   var formaduser = $('#frmadduser')[0];
   // Create an FormData object 
   var dataaduser = new FormData(formaduser);
$("#frmadicionaruser").attr('disabled', 'disabled');
$.ajax({
      type: "POST",
      enctype: 'multipart/form-data',      
      url: 'funcoes/insereusuario.php',
      data: dataaduser,
      processData: false,  // tell jQuery not to process the data
      contentType: false,   // tell jQuery not to set contentType
      cache: false,
        success: function(data) {
//alert(data);

if(data == "2")
{
  alert('usuario ja cadastrado');
  $("#frmadicionaruser").removeAttr('disabled');
  console.log(data);
  return false;
}
if(data =="1")
{
  alert('Usuario cadastrado com sucesso');
  window.location.reload();
return false;
} 
                },
                error: function (err) {//Detecta erros na requisição
                alert(err);
            }
 
            });
            return false;
        });

$("#emailusuario").blur(function(verifica) {
  var vemailusuario = $(this).val();

    $.ajax({
      url: 'funcoes/verificausuario.php',
      type: 'POST',
      data:{emailusuario: vemailusuario},
//      dataType: JSON,
      cache: false,
      success: function(data) {
//        if(data === "Linha ja cadastrada") {
//        alert(data);
        $("#resultadoemailusuario").html(data);
//        $("#salvarlinha").attr('disabled', 'disabled');
//      }
      }
    })
return false;
    
});

$("#alterarsenhauser").click(function() {
var inputatualuser = $("#inputAtualUser").val();
var inputnovauser = $("#inputNovaUser").val();
var idaltsenhauser = $("#idaltsenhauser").val();

if(inputatualuser == "")
{
  alert('preencha a senha atual');
  return false;
}
if(inputnovauser == "")
{
  alert('preencha a nova senha');
  return false;
}

//alert(alterarsenhauser);

$.ajax({
  url: 'funcoes/alterarsenhauser.php',
  type: 'POST',
//  dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
  data: {id: idaltsenhauser,
         inputatualuser: inputatualuser,
         inputnovauser: inputnovauser,
  },

  success: function(data) {
    alert(data);
    window.location.reload();
  }
})
return false;
});

$("#alterarsenhacliente").click(function() {
var inputatualcliente = $("#inputAtualcliente").val();
var inputnovacliente = $("#inputNovacliente").val();
var idaltsenhacliente = $("#idaltsenhacliente").val();

if(inputatualcliente == "")
{
  alert('preencha a senha atual');
  return false;
}
if(inputnovacliente == "")
{
  alert('preencha a nova senha');
  return false;
}
//alert(alterarsenhauser);
$.ajax({
  url: 'funcoes/alterarsenhacliente.php',
  type: 'POST',
//  dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
  data: {id: idaltsenhcliente,
         inputatualcliente: inputatualcliente,
         inputnovacliente: inputnovacliente,
  },

  success: function(data) {
    alert(data);
    window.location.reload();
  }
})
return false;
});

});