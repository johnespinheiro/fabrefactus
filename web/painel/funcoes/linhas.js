$(function(){
// escrever em caps
$('.upper').keyup(function(){
    this.value = this.value.toUpperCase();
});

// INICIO ADD LINHAS - PAG LINHAS.PHP
//botao abre div addlinhas
  $("#addlinhas").click(function(){
      $("#tabelalinhas").hide();
      $("#menulinhas").hide();
      $("#mostralinha").show();
  });
//botao cancelar - fecha div addlinhas
  $("#cancelarlinha").click(function(){
      $("#tabelalinhas").show();
      $("#menulinhas").show();
      $("#mostralinha").hide();
      return false;
  });

 //botao salvar linha
  $("#salvarlinha").click(function() {
var codlinha = $("#codlinha").val();
var bairro = $("#bairro").val();

if (codlinha == "") {
  alert('Preencha a linha');
  return false;
}
if (bairro == "") {
  alert('Preencha o bairro');
  return false;
}
//ajax cadastrar linha
 var dadoslinha = $('#cadlinha').serialize();
$("#cadlinha").hide();
$("#salvarlinha").attr('disabled', 'disabled');
      $.ajax({
        url: 'funcoes/inserelinha.php',
        type: 'POST',
//        dataType: 'json',
        data: dadoslinha,
        cache: false,

        success: function(data) {
//             alert('linha cadastrada!');
                     $("#tabelalinhas").html(data);
                     $("#tabelalinhas").show(data);
                     window.location.reload();
                },
                            error: function (err) {//Detecta erros na requisição
                alert(err);
            }
            });

            return false;
        });
//verifica se já existe na db - input codlinha
$("#codlinha").blur(function(verifica) {
  var vcodlinha = $(this).val();

    $.ajax({
      url: 'funcoes/verificalinha.php',
      type: 'POST',
      data:{codlinha: vcodlinha},
//      dataType: JSON,
      cache: false,
      success: function(data) {
//        if(data === "Linha ja cadastrada") {
//        alert(data);
        $("#resultado").html(data);
//        $("#salvarlinha").attr('disabled', 'disabled');
//      }
      }
    })
return false;
    
});
// FIM ADDLINHAS - PAG LINHAS.PHP


})