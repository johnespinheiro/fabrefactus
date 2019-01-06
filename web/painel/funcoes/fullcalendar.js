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


function rgb2hex(rgb){
 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
 return (rgb && rgb.length === 4) ? "#" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}

//full calendar
$('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
//      right: 'month,agendaWeek,agendaDay,listWeek'
      right: 'month,listWeek'
      },
//        defaultDate: '2016-01-12',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true,
          eventClick: function(event) {        
            $('#informacoesevento #id').text(event.id);
            $('#informacoesevento #id').val(event.id);
            $('#informacoesevento #userid').text(event.userid);
            $('#informacoesevento #userid').val(event.userid);
            $('#informacoesevento #title').text(event.title);
            $('#informacoesevento #title').val(event.title);
            $('#informacoesevento #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
            $('#informacoesevento #start').val(event.start.format('DD/MM/YYYY HH:mm:ss'));
            $('#informacoesevento #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
            $('#informacoesevento #end').val(event.end.format('DD/MM/YYYY HH:mm:ss'));
            $(".botoeseditevento").show();
            return false;
          },

        events: 'funcoes/eventos.php',
}); 

var colorChooser = $('#color-chooser-btn');

var currColor = 'rgb(60, 141, 188)';
var hex = '#3c8dbc';
$('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
    currColor = $(this).css('color');
      //Add color effect to button
    hex = rgb2hex(currColor);
      console.log(currColor);
      console.log(hex);
    }),

$("#add-new-event").click(function() {

var title = $("#new-event").val();
var datahorainicio = $("#datahorainicio").val();
var datahorafim = $("#datahorafim").val();
var userid = $("#userid").val();
  
if(title == "")
{
  alert('preencha o titulo do evento');
  return false;
}
if(datahorainicio == "")
{
  alert('preencha a data/hora de inicio do evento');
  return false;
}
if(datahorafim == "")
{
  alert('preencha a data/hora de fim do evento');
return false;
}
//alert(hex);

$.ajax({
  url: 'funcoes/cadastrar_evento.php',
  type: 'POST',
//  dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
  data: {cor: hex,
         nome: title,
         datahorainicio: datahorainicio,
         datahorafim: datahorafim,
         userid: userid,
  },
  cache: false,
  success: function(data) {
    alert(data);
    window.location.reload();
  },
});
});

$("#formeditarevento").click(function() {
  $(".editevento").show();
  $(".editevento").removeAttr('disabled');
  $(".botoeseditevento").hide();
});

$("#frmsalvareditevento").click(function() {

var ideditevento = $("#edita_evento #id").val();
var titleeditevento = $("#edita_evento #title").val();
var starteditevento = $("#edita_evento #start").val();
var endeditevento = $("#edita_evento #end").val();

$.ajax({
  url: 'funcoes/editarevento.php',
  type: 'POST',
//  dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
  data: {id: ideditevento,
         title: titleeditevento,
         start: starteditevento,
         end: endeditevento,
  },
    cache: false,
    success: function(data) {
      alert(data);
      console.log(data);
      window.location.reload();
    },
  });
});

$("#formdeletarevento").click(function() {
  var iddeleteevento = $(".ideventoedit").val();

//alert(iddeleteevento);
  $.ajax({
    url: 'funcoes/deletarevento.php',
    type: 'POST',
//    dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
    data: {id: iddeleteevento},
    cache: false,
    success: function(data) {
      alert(data);
      console.log(data);
      window.location.reload();
    },
  });
  return false;
});





})