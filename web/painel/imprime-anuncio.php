  <?php
 include "conexao.php";
 //include(HEADER_TEMPLATE);
 include_once "inc/sessao.php";
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

$hoje = new DateTime(date('d-m-Y'));

$id = $_GET['view'];

  $res=$conn->query("SELECT * FROM `movimentos` WHERE `ID` = '".$id."' ");
  $counts = $res->num_rows;
  if($counts  < 1)
  {
    echo "<script>alert('Anuncio nao encontrado.')</script>";
    header('location:../index.php');
//    exit;
}
  while($row=$res->fetch_assoc())
  {
    $codlinha = $row['codlinha'];
    $carro = $row['numerocarro'];
    $descricao = $row['descricao'];
//    $dtinicio = $row['dtinicio'];
//    $dtfim = $row['dtfim'];
    $foto = $row['foto'];
    $idcliente = $row['idcliente'];

    $inicioativo = new datetime(utf8_encode($row['dtinicio']));
    $fimativo = new datetime(utf8_encode($row['dtfim']));
    $inicioativo = date_format($inicioativo, "d-m-y");
    $fimativo = date_format($fimativo, "d-m-y");

    $status = "";

    switch ($status) {
      case $fimativo > $hoje:
        $status = "ativo";
        break;
   
      case $fimativo < $hoje:
        $status = "Finalizado";
        break;
    }

    $res2=$conn->query("SELECT * FROM `clientes` WHERE `id` = '".$idcliente."' ");
    while ($row2=$res2->fetch_assoc()) {
      $nomecli = $row2['nome'];
      $telefonecli = $row2['telefone'];
      $emailcli = $row2['email'];
      $ativo = $row2['ativo'];

      switch ($ativo) {
        case '1':
          $ativo = "Ativo";
          break;
        
        case '0':
          $ativo = "Inativo";
          break;
      }
    }
  }
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fabrefactus | Sistema de gerenciamento de anuncios</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

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
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Fabrefactus - Impressao de Anuncio
          <small class="pull-right">Data: <?php echo date('d-m-y');?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-sm-4 invoice-col">
Cliente: <br/>
<strong><?php echo $nomecli;?></strong><br>
telefone: <?php echo $telefonecli;?> <br/>
E-mail: <?php echo $emailcli;?> <br/>
Status: <?php echo $ativo;?> <br/>
      </div>
      <div class="col-sm-4 invoice-col">
Anuncio: <br/>
<strong><?php echo $id;?></strong><br>
Inicio: <?php echo $inicioativo;?> <br/>
Fim: <?php echo $fimativo;?> <br/>
<!--Status: <?php //echo $status;?> <br/> -->
      </div>
      <div class="col-sm-4 invoice-col">
Linha/Carro: <br/>
Linha: <strong><?php echo $codlinha;?></strong><br>
Carro: <strong><?php echo $carro;?></strong> <br/>
      </div>
  </div>
    <!-- /.row -->
<div class="row">
  <div class="col-xs-12 text-center">
    <hr><br/>
    <img src="<?php echo $foto;?>" width="350" height="200" /> <br/>
  
  </div>
<!-- /.col-xs-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-xs-12 text-center">
    <hr><br/>
    <strong>Descrição:</strong> <br/>
    <?php echo $descricao;?>
  
  </div>
<!-- /.col-xs-12 -->
</div>
<!-- /.row -->
</section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>