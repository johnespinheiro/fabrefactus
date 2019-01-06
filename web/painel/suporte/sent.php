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
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SUPORTE:MENSAGENS
        <small><?php echo $countsvm1;?> novas mensagens</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Suporte</a></li>
        <li class="active">Mensagens Enviadas</li>
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
                <li class="active"><a href="sent.php"><i class="fa fa-envelope-o"></i> Enviadas</a></li>
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
              <h3 class="box-title">Enviadas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table id="dtablemail" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>Para:</th>
                      <th>Assunto:</th>
                      <th>Data:</th>
                  </thead>
                  <tbody>
<?php
  $res=$conn->query("SELECT * FROM `messages` WHERE `senderid` = '".$usuarioID."' AND `boxsender` = '2' order by id ASC, senddate DESC ");
  $counts = $res->num_rows;

  while($row=$res->fetch_array())
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
  case 'u':

//  echo "<script>alert('detectou sender u')</script>";
    $usernome=$conn->query("SELECT `nome` FROM `usuarios` WHERE `id` = '".$receiverid."' ");
      while($rowuser=$usernome->fetch_assoc())
      {
        $receivername = $rowuser['nome'];
      } 
    break;
  
  case 'c':
//    echo "<script>alert('detectou sender c')</script>";
    $usernome=$conn->query("SELECT `nome` FROM `clientes` WHERE `id` = '".$receiverid."' ");
      while($rowuser=$usernome->fetch_assoc())
      {
        $receivername = $rowuser['nome'];
      } 
    break;
}
 
?>              
                  <tr>
                    <td><a href="readmail.php?read=<?php echo $messageid;?>&pag=2"><?php echo $receivername;?></a></td>
                    <td><?php echo $subject;?></td>
                    <td><?php echo $senddate2;?></td>
<?php } ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
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