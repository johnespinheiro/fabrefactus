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

$auth = $_GET['auth'];
$id = $_GET['view'];
$fotomov = "";
$foto = "";
$arrayfoto = array();
$verificaauth = md5($id);

if($auth != $verificaauth)
{
  echo "<script>alert('erro - autenticacao invalida')</script>";
    echo "<script>window.history.back(-1)</script>";
    exit;
}

  $res=$conn->query("SELECT * FROM `linhas` WHERE `ID` = '".$id."' ");
  $counts = $res->num_rows;
  if($counts > 0)
  {
  while($row=$res->fetch_assoc())
  {

 $codlinha = $row['codlinha'];
 $bairro = $row['bairro'];

}
}
  else {
    echo "<script>alert('LINHA INVALIDA')</script>";
    echo "<script>window.history.back(-1)</script>";
    exit;
  }

   $resfm=$conn->query("SELECT `foto` FROM `movimentos` WHERE `idlinha` = '".$id."' ");
   $contfoto = $resfm->num_rows;
   if($contfoto > 0){
   while ($rowfm=$resfm->fetch_array()) {
      $fotomov = $rowfm['foto'];
      $fotomov = "../$fotomov";
      $arrayfoto[] = ($fotomov);
    }
    }

/*  else {
    echo "<script>alert('LINHA INVALIDA')</script>";
    echo "<script>window.history.back(-1)</script>";
    exit;
  }*/
  
  foreach ($arrayfoto as $listfotodeleted) {
  echo"<script>console.log('$listfotodeleted')</script>";
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LINHAS INATIVAS
        <small>Visualização de linha inativa e carros vinculados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="linhasi.php">Linhas Inativas</a></li>
        <li class="active"><a href="#">Visualizar Linha</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Linha:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" style="width:100%">
  <thead>
    <tr>
<!--    <th>id</th> -->
    <th>linha</th>
    <th>bairro</th>
    <th><em class="fa fa-cog"></em></th>
  </tr>
  </thead>
  <tbody>
    <tr>
 <!--     <td><?php //echo $row['id'];?></td> -->
      <td><?php echo $codlinha;?></td>
      <td><?php echo $bairro;?></td>
      <td>
      <a class="ativarlinha" id="<?php echo $id ?>" data-tabela="linhas" data-codlinha="<?php echo $codlinha;?>" data-usuarionome="<?php echo $usuarioNome; ?>" data-bairro="<?php echo $bairro;?>"><button class="btn btn-sm btn-success">Ativar</button></a> <a class="deletelinha" id="<?php echo $id ?>" data-tabela="linhas" data-codlinha="<?php echo $codlinha;?>" data-usuarionome="<?php echo $usuarioNome; ?>" data-bairro="<?php echo $bairro;?>"><button class="btn btn-sm btn-danger">Excluir</button></a>
    </td>
    </tr>
  </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            <div class="box" id="tabelacarros">
            <div class="box-header">
              <h3 class="box-title">Carros:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dtablecarros" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
<!--                  <th>ID</th> -->
                  <th>Carro</th>
                  <th>Status</th>
                  <th><em class="fa fa-cog"></em></th>
                </tr>
                </thead>
                  <tbody>
<?php
        $sqlcarro=$conn->query("SELECT * FROM `carros` WHERE `idlinha` = '".$id."' AND `ativo` = '0' ");
//        $resultcarro = $conn->query($sqlcarro);
        while ($rowcarro = $sqlcarro->fetch_array()) {
            $idcarro = $rowcarro['id'];
            $codlinha2 = $rowcarro['codlinha'];
            $numerocarro = $rowcarro['numerocarro'];
            $status = $rowcarro['status'];

            switch ($status) {
    case 1:
        $status2 = "<span class='label label-danger'>Em uso</span>";
        break;
    case 0:
        $status2 = "<span class='label label-success'>Livre</span>";
        break;
        }

        $link = "<a class='deletecarro' idcarro='$idcarro' data-tabela='carros' data-idlinha='$id' data-codlinha='$codlinha2' data-carro='$numerocarro'><button class='btn btn-sm btn-danger'>Excluir</button></a><a href='viewcarrosi.php?view=$idcarro'> <button class='btn btn-sm btn-info'>Visualizar</button></a>";                    
?>

        <tr>
<!--            <td><?php //echo $idcarro; ?></td> -->
            <td><?php echo $numerocarro;  ?></td>
            <td><?php echo $status2;  ?></td>
            <td><?php echo $link; ?></td>
          </tr>
        <?php } ?>

                  </tbody>
                <tfoot>
                <tr>
<!--                  <th>ID</th> -->
                  <th>Carro</th>
                  <th>Status</th>
                  <th><em class="fa fa-cog"></em></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->                       
     
     <!-------------fim conteudo------------- !-->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
   include(FOOTER_TEMPLATE);
   include(MODAL_DELETE);
   include(MODAL_ATIVAR);
   ?>