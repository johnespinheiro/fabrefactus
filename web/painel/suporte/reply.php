  <?php
 include '../conexao.php';
 include(HEADER_TEMPLATE_MAIL);
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

  $nivel = "1";
echo "<script>console.log('nv $nivel')</script>";
  if ($usuarioNivelAcesso < $nivel)
   {
     echo "<script>alert('USUARIO NAO PERMITIDO NESTA PAGINA')</script>";
    session_destroy();
    header('location:../index.php');
    exit;
  }

 $id = $_GET['rp'];
 //$id2 = $_GET['pag'];
 $today = date("Y-m-d H:i:s");

  $res=$conn->query("SELECT * FROM `messages` WHERE `id` = '".$id."' ");
  $counts = $res->num_rows;
//  $conn->query("UPDATE messages SET `status`='1', `readdate`='$today' WHERE `id`='".$id."' ");

  while($row=$res->fetch_assoc())
    {
  $messageid = $row['id'];
  $senderid = $row['senderid'];
  $receiverid = $row['receiverid'];
  $sendertype = $row['sendertype'];
  $receivertype = $row['receivertype'];
  $subject = $row['subject'];
  $message = $row['message'];
  $status = $row['status'];
  $boxsender = $row['boxsender'];
  $boxreceiver = $row['boxreceiver'];
  $senddate = $row['senddate'];
  $readdate = $row['readdate'];

      $senddate2 = new datetime($row['senddate']);
      $senddate2 = date_format($senddate2, "d-m-y h:i:s");

switch ($receivertype) {
  case 'c':
      echo "<script>console.log('identificou c - busca u')</script>";
      $usernome=$conn->query("SELECT `nome`,`email` FROM `usuarios` WHERE `id` = '".$senderid."' ");
      while($rowuser=$usernome->fetch_assoc())
      {
        $sendernome = $rowuser['nome'];
        $sendermail = $rowuser['email'];
      }
    break;
  
  case 'u':
      echo "<script>console.log('identificou u - busca c')</script>";
      $usernome=$conn->query("SELECT `nome`,`email` FROM `clientes` WHERE `id` = '".$senderid."' ");
      while($rowuser=$usernome->fetch_assoc())
      {
        $sendernome = $rowuser['nome'];
        $sendermail = $rowuser['email'];
      }
    break;
}

}
   if($counts < 1)
  {
    echo "<script>alert('MENSAGEM INVALIDA')</script>";
    echo "<script>window.location.href = ('inbox.php')</script>";
    exit();
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
        <li class="active">Responder Mensagem</li>
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
              <h3 class="box-title">Responder Mensagem</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form id="replysuporte" method="post" action=""  enctype="multipart/form-data">
              <div class="form-group">
                <input type="hidden" id="senderid" name="senderid" value="<?php echo $usuarioID;?>">
                <input type="hidden" id="sendertype" name="sendertype" value="<?php echo $usuarioTipo;?>">
                <input type="hidden" id="receivertype" name="receivertype" value="<?php echo $sendertype;?>">
                <input type="hidden" id="receiverid" name="receiverid" value="<?php echo $senderid;?>">

                <label for="replyreceiver">Para:</label>
                <input id="replyreceiver" type="text" class="form-control" value="<?php echo $sendernome;?>" disabled="disabled">
              </div>

              <div class="form-group">
                <label for="replysubject">Assunto:</label>
                <input type="text" id="replysubject" name="replysubject" class="form-control" value="[res] <?php echo $subject;?>">
              </div>

              <div class="form-group">
                    <textarea id="replymessage" name="replymessage" class="form-control" style="height: 300px">
 ->
<br/>_____________________________
<p><b>De:</b> <?php echo "$sendernome - $sendermail";?><br/>
<b>Data:</b> <?php echo $senddate2;?><br/>
<b>Mensagem:</b><br/>
<?php echo $message;?>
                    </textarea>
              </div>

            <div class="box-footer">
              <div class="pull-right">
                <button class="btn btn-default" id="rascunhoreplysuporte" disabled="disabled"><i class="fa fa-pencil"></i> Rascunho</button>
                <button class="btn btn-primary" id="enviarreplysuporte"><i class="fa fa-envelope-o"></i> Enviar</button>
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