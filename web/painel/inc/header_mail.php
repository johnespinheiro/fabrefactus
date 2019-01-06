<!DOCTYPE html>
<?php
include_once "../conexao.php";
include ("sessao.php");
date_default_timezone_set('America/Sao_Paulo'); 

 $resvm1=$conn->query("SELECT * FROM `messages` WHERE `receiverid` = '".$usuarioID."' AND `status` = '0' AND `boxreceiver` = '1' ");
 $countsvm1 = $resvm1->num_rows;

  ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fabrefactus | Sistema de gerenciamento de anuncios</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- datatable responsive -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
    <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

                  <?php switch ($usuarioNivelAcesso) {
                    case '1':
                      echo "<a href='../indexc.php' class='logo'>";
                      break;
                    
                    case $usuarioNivelAcesso > 1 :
                      echo "<a href='../index.php' class='logo'>";
                      break;
                  } ?>
    <!-- Logo -->
<!--    <a href="../index.php" class="logo"> -->
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>F</b>abrefactus</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo $countsvm1;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você tem <?php echo $countsvm1;?> mensagens</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
<?php                  
$resvm=$conn->query("SELECT * FROM `messages` WHERE `receiverid` = '".$usuarioID."' AND `status` = '0' AND `boxreceiver` = '1' LIMIT 6 ");
 $countsvm = $resvm->num_rows;

  while($rowvm=$resvm->fetch_array())
    {

  $messageidvm = $rowvm['id'];
  $senderidvm = $rowvm['senderid'];
//  $receiveridvm = $rowvm['receiverid'];
  $subjectvm = $rowvm['subject'];
  $sendertypevm = $rowvm['sendertype'];
//  $message = $rowvm['message'];
//  $statusvm = $rowvm['status'];
//  $boxid = $rowvm['boxid'];
  $senddatevm = $rowvm['senddate'];
//  $readdate = $rowvm['readdate'];

  $atual = new DateTime(date('Y-m-d H:i:s'));
  $fim = new datetime($rowvm['senddate']);

  $tempovm = $atual->diff($fim);

switch ($sendertypevm) {
  case 'u':

//  echo "<script>alert('detectou sender u')</script>";
      $usernomevm=$conn->query("SELECT * FROM `usuarios` WHERE `id` = '".$senderidvm."' ");
      while($rowuservm=$usernomevm->fetch_array())
      {
        $sendernomevm = $rowuservm['nome'];
        $senderfotovm = $rowuservm['foto'];
      } 
    break;
  
  case 'c':
//    echo "<script>alert('detectou sender c')</script>";
      $usernomevm=$conn->query("SELECT * FROM `clientes` WHERE `id` = '".$senderidvm."' ");
      while($rowuservm=$usernomevm->fetch_array())
      {
        $sendernomevm = $rowuservm['nome'];
        $senderfotovm = $rowuservm['foto'];
      } 
    break;
}

  //}
  ?>
                  <li><!-- start message -->
                    <a href="readmail.php?read=<?php echo $messageidvm;?>&pag=1">
                      <div class="pull-left">
                        <img src="../<?php echo $senderfotovm;?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?php echo $sendernomevm;?>
                        <small><i class="fa fa-clock-o"></i> <?php echo $tempovm->format('%h hrs %i mins');?></small>
                      </h4>
                      <p><?php echo $subjectvm;?></p>
                    </a>
                  </li>
<?php } ?>       <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="inbox.php">Ver todas as mensagens</a></li>
            </ul>
          </li>
         <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
<!--              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <img src="../<?php echo $usuarioFoto;?>" class="user-image" alt="<?php echo $usuarioNome;?>"> 
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $usuarioNome;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
<!--                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
              <img src="../<?php echo $usuarioFoto;?>" class="img-circle" alt="<?php echo $usuarioNome;?>"> 
                <p>
                  <?php echo $usuarioNome;?> - <?php echo $usuarioTipo;?>
                  <small>Cadastrado em <?php echo $created;?></small> 
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                  <!--  <a href="#">Followers</a> -->
                  </div>
                  <div class="col-xs-4 text-center">
                    <!-- <a href="#">Sales</a> -->
                  </div>
                  <div class="col-xs-4 text-center">
                    <!-- <a href="#">Friends</a> -->
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <?php switch ($usuarioNivelAcesso) {
                    case '1':
                      echo "<a href='../indexc.php' class='btn btn-default btn-flat'>Perfil</a>";
                      break;
                    
                    case '2' :
                      echo "<a href='../profile.php' class='btn btn-default btn-flat'>Perfil</a>";
                      break;
                  } ?>
              <!--    <a href="#" class="btn btn-default btn-flat">Perfil</a> -->
                </div>
                <div class="pull-right">
                  <a href="../sair.php" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
<!--          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
<!--          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
          <img src="../<?php echo $usuarioFoto;?>" class="img-circle" alt="<?php echo $usuarioNome;?>">
        </div>
        <div class="pull-left info">
          <p><?php echo $usuarioNome;?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

<?php
 include(MENU_TEMPLATE_MAIL);
 ?>
    </section>
    <!-- /.sidebar -->
  </aside>