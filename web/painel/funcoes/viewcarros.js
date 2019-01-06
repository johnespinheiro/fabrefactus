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

// INICIO EDIT ANUNCIO
      $("#editanuncio").click(function(){
      $("#tabelacarro").hide();
      $("#meditanuncio").show();
      $("#tabelahistorico").hide();
      $("#selectcli").hide();
      $("#linkedit").hide();

      var id = $(this).data('id');
      var idcliente = $(this).data('idcliente');
      var nomecliente = $(this).data('nomecliente');
      var descricao = $(this).data('descricao');
      var dtinicio = $(this).data('dtinicio');
      var dtfim = $(this).data('dtfim');
      var foto = $(this).data('foto');

        var valor = $("#meditanuncio");
        valor.find('#descricao').val(descricao);
        valor.find('#idanuncioedit').val(id);
        valor.find('#idclisel').val(idcliente);
        valor.find('#sel1').val(nomecliente);
        valor.find('#showcliativo2').val(nomecliente);
        valor.find('#dtinicio').val(dtinicio);
        valor.find('#dtfim').val(dtfim);
        valor.find('#fotoold').val(foto);

  });
      $("#canceditanuncio").click(function(){
      $("#tabelacarro").show();
      $("#meditanuncio").hide();
      $("#tabelahistorico").show();
      $("#linkedit").show();
      return false;
  });

$("#editcli").click(function(event) {
 $("#sel1").removeAttr('disabled');
 $("#selectcli").show();
 $("#showcliativo").hide();
 return false;
});

  $("#addfotoa").click(function() {
   
  $("#fotoa").removeAttr('disabled');
          var valora = $("#seditanuncio")
        valora.find('#comfotoa').val('1')
 return false;
  });

          $("#salvareditanuncio").click(function() {
//      var dadoseditanuncio = $('#seditanuncio').serialize();

        //stop submit the form, we will post it manually.
        event.preventDefault();

        // Get form
        var form = $('#seditanuncio')[0];

    // Create an FormData object 
        var data = new FormData(form);

 //     var dadosanuncio = $('#cadanuncio').serialize()

$("#meditanuncio").hide();

      $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: 'funcoes/editanuncio.php',
      data: data,
      processData: false,  // tell jQuery not to process the data
      contentType: false,   // tell jQuery not to set contentType
      cache: false,

        success: function(data) {
             alert('Anuncio atualizado!');
//                     $("#tabelacarro").html(data);
//                     $("#tabelacarro").show(data);
                     window.location.reload();
                },
                            error: function (err) {//Detecta erros na requisição
                alert(err);
            }
            });

            return false;
        });

//});
//FIM EDIT ANUNCIO
//INICIO FINALIZAR ANUNCIO
$("#finalizaranuncio").click(function() {
      var id = $(this).data('id')
      var dtfim = $(this).data('dtfim')
      var codlinha = $(this).data('codlinha')
      var numerocarro = $(this).data('numerocarro')
      $.ajax({
        url: 'funcoes/finalizaranuncio.php',
        type: 'POST',
//        dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {id: id,
               dtfim: dtfim,
               codlinha: codlinha,
               numerocarro: numerocarro,
        },
        cache: false,

        success: function(data) {
             alert('Anuncio Finalizado!');
//                     $("#tabelacarro").html(data);
//                     $("#tabelacarro").show(data);
                     window.location.reload();
                },
                            error: function (err) {//Detecta erros na requisição
                alert(err);
            }
            });

            return false;
        });
//FIM FINALIZAR ANUNCIO

})