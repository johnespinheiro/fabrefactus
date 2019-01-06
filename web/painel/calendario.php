  <?php
 include 'conexao.php';
 include(HEADER_TEMPLATE);

   $nivel = "2";
echo "<script>console.log('nv $nivel')</script>";
  if ($usuarioNivelAcesso < $nivel)
   {
     echo "<script>alert('USUARIO NAO PERMITIDO NESTA PAGINA')</script>";
    session_destroy();
    header('location:../index.php');
    exit;
  }
  
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CALENDARIO
        <small>Agenda compartilhada</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active"><a href="calendario.php">Calendario</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
<div class="row">
  <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Criar Evento</h3>
            </div>
              <form class="form-horizontal" method="post" action="" id="cadastra_evento" enctype="multipart/form-data"> 
              <input type="hidden" id="userid" value="<?php echo $usuarioID;?>">           
            <div class="box-body">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                </ul>
              </div>
<!--            </div> -->
              <!-- /btn-group -->
              <div class="input-group">
                <input id="new-event" type="text" class="form-control" placeholder="Evento">
                <input type="text" id="datahorainicio" class="form-control timepicker" placeholder="Data/hora Inicio">
                <input type="text" id="datahorafim" class="form-control timepicker" placeholder="Data/hora Fim">  
              </div>
            </div>
                <div class="box-footer">
                  <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Adicionar</button>
                </div>
                <!-- /footer -->
              </form>
              </div>
              <!-- /box -->

          <div class="box box-solid" id="informacoesevento">
            <div class="box-header with-border">
              <h3 class="box-title">Informações</h3>
            </div>
<form class="form-horizontal" method="post" action="" id="edita_evento" enctype="multipart/form-data">
                <input type="hidden" id="userid" value="<?php echo $usuarioID;?>">
                <input type="hidden" id="id" class="ideventoedit">
                <div class="box-body">
                    <label for="title">Evento:</label><br/> <input type="text" id="title" class="form-control editevento" disabled="disabled">
                    <label for="title">Inicio:</label><br/> <input type="text" id="start" class="form-control timepicker editevento" disabled="disabled">
                    <label for="title">Fim:</label><br/> <input type="text" id="end" class="form-control timepicker editevento" disabled="disabled">
                </div>               
                <div class="box-footer editevento" id="funcoeseditevento" name="funcoeseditevento" style="display: none;">
                    <button class="btn btn-success" id="frmsalvareditevento">Salvar</button>
                    <button class="btn btn-danger pull-right" id="formcancelareditevento">Cancelar</button>
                </div> 
                </form>             
          </div>
          <div class="box box-solid">
            <div class="box-body botoeseditevento" id="botoeseditevento" style="display: none;">
              <button class="btn btn-warning" id="formeditarevento">Editar</button>
              <button class="btn btn-danger pull-right" id="formdeletarevento">Apagar</button>                
            </div>
          </div>
        </div>
        <!-- /.col -->    
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->    
  </div>
    
     <!-------------------------- !-->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
   include(FOOTER_TEMPLATE);
   ?>
   <script src="funcoes/fullcalendar.js"></script>