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

$id = $_GET['view'];

  $res=$conn->query("SELECT * FROM `carros` WHERE `ID` = '".$id."' ");
  $counts = $res->num_rows;
  if($counts > 0)
  {
  while($row=$res->fetch_assoc())
  {

 $codlinha = $row['codlinha'];
 $idlinha = $row['idlinha'];
 $numerocarro = $row['numerocarro'];
 $status = $row['status'];


 switch ($status) {
    case 1:
        $status2 = "<span class='label label-danger'>Em uso</span>";
        break;
    case 0:
        $status2 = "<span class='label label-success'>Livre</span>";
        break;
      }

  $link = "<a class='deletecarro' idcarro='$id' data-tabela='carros' idlinha='$idlinha' data-codlinha='$codlinha' data-carro='$numerocarro'><button class='btn btn-sm btn-danger'>Excluir</button></a>";

  }
}
  else {
    echo "<script>alert('CARRO NAO ENCONTRADO')</script>";
    echo "<script>window.history.back(-1)</script>";
    exit;
  }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CARROS
        <small>Visualização de carros inativos e seus respectivos anuncios</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="carrosi.php">Carros Inativos</a></li>
        <li class="active"><a href="#">Visualizar Carros</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Carro:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" style="width:100%">
  <thead>
    <tr>
<!--    <th>id</th> -->
    <th>linha</th>
    <th>Carro</th>
    <th><em class="fa fa-cog"></em></th>
  </tr>
  </thead>
  <tbody>
    <tr>
<!--      <td><?php //echo $id;?></td> -->
      <td><?php echo $codlinha;?></td>
      <td><?php echo $numerocarro;?></td>
      <td><?php echo $link;?></td>
    </tr>
  </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Historico:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dtablemovimentos" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
<!--                  <th>ID</th> -->
                  <th>Cliente</th>
<!--                  <th>Descrição</th> -->
                  <th>Inicio</th>
                  <th>Fim</th>
                  <th><em class="fa fa-cog"></em></th>
                </tr>
                </thead>
                  <tbody>
<?php
$rescarro=$conn->query("SELECT * FROM `movimentos` WHERE `idcarro` = '".$id."' and `ativo` = '0' ");
  while($rowcarro=$rescarro->fetch_array()) {
          $idmov = $rowcarro['id'];
          $codlinhamov = $rowcarro['codlinha'];
          $numerocarromov = $rowcarro['numerocarro'];
          $descriaomov = $rowcarro['descricao'];
          $idclientemov = $rowcarro['idcliente'];
          $dtiniciomov = $rowcarro['dtinicio'];
          $dtfimmov = $rowcarro['dtfim'];
          $statusmov = $rowcarro['status']; 

          $rescli=$conn->query("SELECT `nome` FROM `clientes` WHERE `id` = '".$idclientemov."' ");
            while ($rowcli=$rescli->fetch_array()) {
              $nomecli = $rowcli['nome'];

              $link = "<a target='_blank' href='imprime-anuncio.php?view=$idmov'> <button class='btn btn-sm btn-info'>Imprimir</button></a>";
  }
?>
        <tr>
<!--            <td><?php //echo $idmov; ?></td> -->
            <td><?php echo $nomecli;  ?></td>
<!--            <td><?php //echo $descriaomov; ?></td> -->
            <td><?php echo $dtiniciomov;  ?></td>
            <td><?php echo $dtfimmov; ?></td>
            <td><?php echo $link;?></td>
<!--            <td><?php //echo $status2; ?></td> -->
          </tr>
        <?php
         }
          ?>
                  </tbody>
                <tfoot>
                <tr>
<!--                  <th>ID</th> -->
                  <th>Cliente</th>
<!--                  <th>Descrição</th> -->
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
   ?>