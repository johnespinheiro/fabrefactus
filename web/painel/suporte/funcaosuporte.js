$(function(){

$("#suportemessage").wysihtml5();
$("#replymessage").wysihtml5();

$('.select2').select2();

$("#enviarmsgsuporte").click(function(e) {
//  var enviarsuporte = $('#enviarsuporte').serialize();
//var data = $("#enviarsuporte").serialize();
var mensagem = $("#suportemessage").val();
var assunto = $("#subject").val();
var receiver = $("#selcli").val();

//alert(assunto);
//alert(receiver);

if (assunto == "") {
	alert('Preencha o assunto');
	return false;
}
if (receiver == ""){
	alert('selecione o destinatario');
	return false;
}
if (mensagem == "")
{
	alert('mensagem nao pode ser em branco');
	return false;
}
       e.preventDefault();
        // Get form
        var form = $('#enviarsuporte')[0];
    // Create an FormData object 
        var data = new FormData(form);

  $.ajax({
  	type: 'POST',
    enctype: 'multipart/form-data', 
  	url: 'enviarsuporte.php',
  	data: data,
    processData: false,  // tell jQuery not to process the data
    contentType: false,   // tell jQuery not to set contentType
    cache: false,
  	success: function(data)
  	{
  		console.log("enviado com sucesso");
  		alert('mensagem enviada com sucesso!');
  		window.location.href = ("inbox.php");
  	},
  })
  .done(function() {
  	console.log("success");
  })
  .fail(function() {
  	console.log("erro ao enviar mensagem, tente novamente");
  })
  	return false;
});

$("#enviarreplysuporte").click(function(e) {
    e.preventDefault();
        // Get form
    var form = $('#replysuporte')[0];
    // Create an FormData object 
    var data = new FormData(form);

  $.ajax({
    type: 'POST',
    enctype: 'multipart/form-data', 
    url: 'enviarreplysuporte.php',
    data: data,
    processData: false,  // tell jQuery not to process the data
    contentType: false,   // tell jQuery not to set contentType
    cache: false,
    success: function(data)
    {
      console.log("enviado com sucesso");
      alert('mensagem enviada com sucesso!');
      window.location.href = ("inbox.php");
    },
  })
  .done(function() {
    console.log("success");
  })
  .fail(function() {
    console.log("erro ao enviar mensagem, tente novamente");
  })
    return false;
});

});