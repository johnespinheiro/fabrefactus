  <?php
 include '../conexao.php';
 include(HEADER_TEMPLATE_MAIL);

   $nivel = "1";
echo "<script>console.log('nv $nivel')</script>";
  if ($usuarioNivelAcesso < $nivel)
   {
     echo "<script>alert('USUARIO NAO PERMITIDO NESTA PAGINA')</script>";
    session_destroy();
    header('location:../index.php');
    exit;
  }

 $tipo = $_GET['send'];
echo "<script>console.log('session $usuarioTipo')</script>";

/*switch ($usuarioTipo) {
   case "u":
echo "<script>console.log('id - u - rec c')</script>";
  $receivertype = "c";
  $lista=$conn->query("SELECT * FROM `clientes` WHERE `ativo` = '1' ");
  $countcli = $lista->num_rows;
     break;
   
   case "c":
echo "<script>console.log('id - c - rec u')</script>";
  $receivertype = "u";
  $lista=$conn->query("SELECT * FROM `usuarios` WHERE `ativo` = '1' ");
  $countcli = $lista->num_rows;     
     break;

     default:
     echo "<script>console.log('usuario nao identificado')</script>";
     break;
 } */
if($usuarioTipo == "u")
{
  echo "<script>console.log('id - u - rec c')</script>";
  $receivertype = "c";
  $lista=$conn->query("SELECT * FROM `clientes` WHERE `ativo` = '1' ");
  $countcli = $lista->num_rows;
} elseif($usuarioTipo == "c")
{
  echo "<script>console.log('id - c - rec u')</script>";
  $receivertype = "u";
  $lista=$conn->query("SELECT * FROM `usuarios` WHERE `ativo` = '1' ");
  $countcli = $lista->num_rows;    
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SUPORTE:ESCREVER MENSAGEM
        <small><?php echo $countsvm1;?> novas mensagens</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Suporte</a></li>
        <li class="active">Enviar Mensagem</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-md-3">
          <a href="inbox.php" class="btn btn-primary btn-block margin-bottom">Voltar para entrada</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Pastas</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="inbox.php"><i class="fa fa-inbox"></i> Entrada
                  <span class="label label-primary pull-right"><?php echo $countsvm1;?></span></a></li>
                <li><a href="sent.php"><i class="fa fa-envelope-o"></i> Enviadas</a></li>
<!--                 <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                </li> -->
                <li><a href="#"><i class="fa fa-trash-o"></i> Lixeira</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
           </div>
          <!-- /. box -->    
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nova Mensagem</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form id="enviarsuporte" method="post" action=""  enctype="multipart/form-data">
              <div class="form-group">
                <input type="hidden" id="senderid" name="senderid" value="<?php echo $usuarioID;?>">
                <input type="hidden" id="sendertype" name="sendertype" value="<?php echo $tipo;?>">
                <input type="hidden" id="receivertype" name="receivertype" value="<?php echo $receivertype;?>">
<!--                <input class="form-control" placeholder="Para:"> -->
                <select class="form-control select2 upper" id="selcli" name="selcli" style="width: 100%;">
   <option value="">Para:</option>
  <?php
  while($rowcli=$lista->fetch_array())
  {

 $clientenome = $rowcli['nome'];
 $clienteid = $rowcli['id'];

 echo "<option value='$clienteid'>$clientenome</option>";
}
  ?>
   </select>                
              </div>
              <div class="form-group">
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Assunto:">
              </div>
              <div class="form-group">
                    <textarea id="suportemessage" name="suportemessage" class="form-control" style="height: 300px">
                    </textarea>
              </div>              
            <div class="box-footer">
              <div class="pull-right">
                <button class="btn btn-default" id="rascunhosuporte" disabled="disabled"><i class="fa fa-pencil"></i> Rascunho</button>
                <button class="btn btn-primary" id="enviarmsgsuporte"><i class="fa fa-envelope-o"></i> Enviar</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Descartar</button>
            </div>
            <!-- /.box-footer -->              
              </form> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->                        
     <!-------------------------- !-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
   include(FOOTER_TEMPLATE_MAIL);
   ?>