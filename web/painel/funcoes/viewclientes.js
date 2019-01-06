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
      $("#editcliente").click(function(){
      $("#meditcliente").show();
      $("#tabelahistorico").hide();
      $("#anuncioativo").hide();

      var id = $(this).data('id');
      var nome = $(this).data('nome');
      var endereco = $(this).data('endereco');
      var telefone = $(this).data('telefone');
      var email = $(this).data('email');
      var foto = $(this).data('foto');

      var valor = $("#meditcliente");
      valor.find("#nome").val(nome);
      valor.find("#endereco").val(endereco);
      valor.find("#celular").val(telefone);
      valor.find("#email").val(email);
      valor.find("#fotoold").val(foto);
      valor.find("#idcliente").val(id);

      });
      
      $("#cancelareditcliente").click(function(){
      $("#meditcliente").hide();
      $("#tabelahistorico").show();
      $("#anuncioativo").show();
      return false;
  });

  $("#addfotoc").click(function() { 
  $("#fotoc").removeAttr('disabled');
          var valorc = $("#meditcliente")
        valorc.find('#comfotoc').val('1')
 return false;
  });

          $("#salvareditcliente").click(function() {
        //stop submit the form, we will post it manually.
        event.preventDefault();
        // Get form
        var form = $('#seditcliente')[0];
    // Create an FormData object 
        var data = new FormData(form);
 //     var dadosanuncio = $('#cadanuncio').serialize()
$("#meditcliente").hide();
$("#salvareditcliente").attr('disabled', 'disabled');

      $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: 'funcoes/editcliente.php',
      data: data,
      processData: false,  // tell jQuery not to process the data
      contentType: false,   // tell jQuery not to set contentType
      cache: false,
       success: function(data) {
             alert('Cliente atualizado!');
             $("#salvareditcliente").removeAttr('disabled');
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
})