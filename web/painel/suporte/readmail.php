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

 $id = $_GET['read'];
 $id2 = $_GET['pag'];
$today = date("Y-m-d H:i:s");

//echo "<script>alert('$id2')</script>";

switch ($id2) {
  case '1':
//    echo "<script>alert('alerta id 1')</script>";
    echo "<script>console.log('identificou 1')</script>";

  $link = "<a href='reply.php?rp=$id'><button type='button' class='btn btn-default'><i class='fa fa-reply'></i> Responder</button></a>";
  $res=$conn->query("SELECT * FROM `messages` WHERE `id` = '".$id."' ");
  $counts = $res->num_rows;
  $conn->query("UPDATE messages SET `status`='1', `readdate`='$today' WHERE `id`='".$id."' ");

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
      $boxid = $row['boxid'];
      $senddate = $row['senddate'];
      $readdate = $row['readdate'];

      $senddate2 = new datetime($row['senddate']);
      $senddate2 = date_format($senddate2, "d-m-y h:i:s");

//echo "<script>alert('sendertype $sendertype - ta idenficando esse')</script>";

if($sendertype == "u") {

  echo "<script>console.log('detectou sender u')</script>";
    $usernome=$conn->query("SELECT `nome` FROM `usuarios` WHERE `id` = '".$senderid."' ");
      while($rowuser=$usernome->fetch_assoc())
      {
        $sendernome = $rowuser['nome'];
        $sendermail = $rowuser['email'];
      } 
  
 } elseif($sendertype == "c") {

    echo "<script>console.log('detectou sender c')</script>";
    $usernome=$conn->query("SELECT `nome` FROM `clientes` WHERE `id` = '".$senderid."' ");
      while($rowuser=$usernome->fetch_assoc())
      {
        $sendernome = $rowuser['nome'];
        $sendermail = $rowuser['email'];
      } 
}}
break;

  case '2':
//    echo "<script>alert('alerta id 2')</script>";
    echo "<script>console.log('identificou 2')</script>";

  $link = "<button type='button' class='btn btn-default' disabled='disabled'><i class='fa fa-reply'></i> Reply</button></a>";
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
      $boxid = $row['boxid'];
      $senddate = $row['senddate'];
      $readdate = $row['readdate'];

      $senddate2 = new datetime($row['senddate']);
      $senddate2 = date_format($senddate2, "d-m-y h:i:s");

if($sendertype == "u") {

  echo "<script>console.log('detectou sender u')</script>";
    $usernome=$conn->query("SELECT `nome` FROM `usuarios` WHERE `id` = '".$senderid."' ");
      while($rowuser=$usernome->fetch_assoc())
      {
        $sendernome = $rowuser['nome'];
        $sendermail = $rowuser['email'];
      } 
  
 } elseif($sendertype == "c") {

    echo "<script>console.log('detectou sender c')</script>";
    $usernome=$conn->query("SELECT `nome` FROM `clientes` WHERE `id` = '".$senderid."' ");
      while($rowuser=$usernome->fetch_assoc())
      {
        $sendernome = $rowuser['nome'];
        $sendermail = $rowuser['email'];
      } 
}}
break;

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
        SUPORTE:LER MENSAGEM
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Suporte</a></li>
        <li class="active">Ler Mensagem</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-md-3">
          <a href="compose.php?send=<?php echo $usuarioTipo;?>" class="btn btn-primary btn-block margin-bottom">Nova mensagem</a>

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
              <h3 class="box-title">Ler Mensagem</h3>

              <div class="box-tools pull-right">
<!--                 <a href="readmail.php?read=<?php //echo $messageid - 1;?>" class="btn btn-box-tool" data-toggle="tooltip" title="Previous" disabled="disabled"><i class="fa fa-chevron-left"></i></a>
                <a disabled="disabled" href="readmail.php?read=<?php //echo $messageid + 1;?>" class="btn btn-box-tool" data-toggle="tooltip" title="Next" disabled="disabled"><i class="fa fa-chevron-right"></i></a> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo $subject;?></h3>
                <h5>DE: <?php echo "$sendernome - $sendermail";?>
                  <span class="mailbox-read-time pull-right"><?php echo $senddate2;?></span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete" disabled="disabled">
                    <i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Responder" disabled="disabled">
                    <i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Encaminhar" disabled="disabled">
                    <i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Imprimir" onclick="window.print();">
                  <i class="fa fa-print"></i></button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <?php echo $message;?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <?php echo $link; ?>
                <button type="button" class="btn btn-default" disabled="disabled"><i class="fa fa-share"></i> Encaminhar</button>
              </div>
              <button type="button" class="btn btn-default" disabled="disabled"><i class="fa fa-trash-o"></i> Apagar</button>
              <button type="button" class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Imprimir</button>
            </div>
            <!-- /.box-footer -->
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