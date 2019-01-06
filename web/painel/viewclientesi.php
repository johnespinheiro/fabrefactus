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

$data = date("y/m/d");
$id = $_GET['view'];
$fotomov = "";
$foto = "";
$arrayfoto = array();
  $res=$conn->query("SELECT * FROM `clientes` WHERE `ID` = '".$id."' ");
  $counts = $res->num_rows;
  if($counts > 0)
  {
  while($row=$res->fetch_assoc())
  {

 $nome = $row['nome'];
 $telefone = $row['telefone'];
 $email = $row['email'];
 $foto = $row['foto'];
 $foto = "../$foto";
 $dfoto = $row['dfoto'];

/*   $resfm=$conn->query("SELECT `foto` FROM `movimentos` WHERE `idcliente` = '".$id."' ");
   $contfoto = $resfm->num_rows;
   if($contfoto > 0){
   while ($rowfm=$resfm->fetch_assoc()) {
      $fotomov = $rowfm['foto'];
      $fotomov = "../$fotomov";
      $arrayfoto = array($fotomov);
    }
    } */
  }
}
  else {
    echo "<script>alert('CLIENTE NAO ENCONTRADO')</script>";
    echo "<script>window.history.back(-1)</script>";
    exit;
  }

   $resfm=$conn->query("SELECT `foto` FROM `movimentos` WHERE `idcliente` = '".$id."' ");
   $contfoto = $resfm->num_rows;
   if($contfoto > 0){
   while ($rowfm=$resfm->fetch_array()) {
      $fotomov = $rowfm['foto'];
      $fotomov = "../$fotomov";
      $arrayfoto[] = ($fotomov);
    }
    }
foreach ($arrayfoto as $listfotodeleted) {
  echo"<script>console.log('$listfotodeleted')</script>";
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CLIENTES INATIVOS
        <small>Visualização de Clientes inativos e historico</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="clientesi.php">Clientes inativos</a></li>
        <li class="active"><a href="#">Visualizar Cliente</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Cliente:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" style="width:100%">
  <thead>
    <tr>
<!--    <th>id</th> -->
    <th>nome</th>
    <th>telefone</th>
    <th>email</th>
    <th><em class="fa fa-cog"></em></th>
  </tr>
  </thead>
  <tbody>
    <tr>
<!--      <td><?php //echo $id;?></td> -->
      <td><?php echo $nome;?></td>
      <td><?php echo $telefone;?></td>
      <td><?php echo $email;?></td>
      <td>
      <a class="ativarcliente" id="<?php echo $id ?>" data-tabela="clientes" data-codcliente="<?php echo $id;?>" data-usuarionome="<?php echo $usuarioNome; ?>"><button class="btn btn-sm btn-success">Ativar</button></a> <a class="deletecliente" id="<?php echo $id ?>" data-tabela="clientes" data-codcliente="<?php echo $id;?>" data-usuarionome="<?php echo $usuarioNome; ?>" data-dfoto="<?php echo $dfoto;?>" data-foto="<?php echo $foto;?>"><button class="btn btn-sm btn-danger">Excluir</button></a>
    </td>
    </tr>
  </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            <div class="box" id="tabelahistorico">
            <div class="box-header">
              <h3 class="box-title">Historico:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dtablemovimentos" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
<!--                  <th>ID</th>
                  <th>Descrição</th> -->
                  <th>Inicio</th>
                  <th>Fim</th>
                  <th><em class="fa fa-cog"></em></th>
<!--                  <th>Status</th> -->
                </tr>
                </thead>
                  <tbody>
<?php
$rescarro=$conn->query("SELECT * FROM `movimentos` WHERE `idcliente` = '".$id."' and `ativo` = '0' AND `status` = '0' ");
  while($rowcarro=$rescarro->fetch_array()) {
          $idmov = $rowcarro['id'];
          $codlinhamov = $rowcarro['codlinha'];
          $numerocarromov = $rowcarro['numerocarro'];
          $descriaomov = $rowcarro['descricao'];
          $idclientemov = $rowcarro['idcliente'];
//          $dtiniciomov = $rowcarro['dtinicio'];
//          $dtfimmov = $rowcarro['dtfim'];
          $statusmov = $rowcarro['status'];

          $dtiniciomov = new datetime(utf8_encode($rowcarro['dtinicio']));
          $dtfimmov = new datetime(utf8_encode($rowcarro['dtfim']));
          $dtiniciomov = date_format($dtiniciomov, "d/m/y");
          $dtfimmov = date_format($dtfimmov, "d/m/y");

          $linklist = "<a target='_blank' href='imprime-anuncio.php?view=$idmov'> <button class='btn btn-sm btn-info'>Imprimir</button></a>";

           // }
?>
        <tr>
<!--            <td><?php //echo $idmov; ?></td>
            <td><?php //echo $descriaomov; ?></td> -->
            <td><?php echo $dtiniciomov;  ?></td>
            <td><?php echo $dtfimmov; ?></td>
            <td><?php echo $linklist; ?></td>
<!--            <td><?php //echo $status2; ?></td> -->
          </tr>
        <?php
         }
          ?>
                  </tbody>
                <tfoot>
                <tr>
<!--                  <th>ID</th>
                  <th>Descrição</th> -->
                  <th>Inicio</th>
                  <th>Fim</th>
                  <th><em class="fa fa-cog"></em></th>
<!--                  <th>Status</th> -->
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