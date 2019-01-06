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

$auth = $_GET['auth'];
$id = $_GET['view'];

$verificaauth = md5($id);

if($auth != $verificaauth)
{
  echo "<script>alert('erro - autenticacao invalida')</script>";
    echo "<script>window.history.back(-1)</script>";
    exit;
}

  $res=$conn->query("SELECT * FROM `carros` WHERE `ID` = '".$id."' ");
  $counts = $res->num_rows;
  if($counts > 0)
  {
  while($row=$res->fetch_assoc())
  {

 $codlinha = $row['codlinha'];
 $numerocarro = $row['numerocarro'];
 $status = $row['status'];
 $linhauso = $row['linhauso'];


 switch ($status) {
    case 1:
        $status2 = "<span class='label label-danger'>Em uso - linha $linhauso</span>";
        break;
    case 0:
        $status2 = "<span class='label label-success'>Livre</span>";
        break;
      }
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
        <small>Visualização de carros ativos e seus respectivos anuncios</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="carros.php">Carros</a></li>
        <li class="active"><a href="#">Visualizar Carros</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box" id="tabelacarro">
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
    <th>Status</th>
  </tr>
  </thead>
  <tbody>
    <tr>
<!--      <td><?php //echo $id;?></td> -->
      <td><?php echo $codlinha;?></td>
      <td><?php echo $numerocarro;?></td>
      <td><?php echo $status2;?></td>
    </tr>
  </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
<!-- box anuncio ativo -->
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Anuncio Ativo:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" style="width:100%">
  <thead>
    <tr>
<!--                  <th>ID</th> -->
                  <th>Cliente</th>
<!--                  <th>Descrição</th> -->
                  <th>Inicio</th>
                  <th>Fim</th>
<!--                  <th><em class="fa fa-cog"></em></th> -->
  </tr>
  </thead>
  <tbody>
    <?php
    $resativo=$conn->query("SELECT * FROM `movimentos` WHERE `idcarro` = '".$id."' AND `ativo` = '1' ");
  $countativo = $resativo->num_rows;
  if($countativo > 0)
  {
  while($rowativo=$resativo->fetch_assoc())
  {
    $idativo = $rowativo['id'];
    $descricaoativo = $rowativo['descricao'];
//    $inicioativo = $rowativo['dtinicio'];
//    $fimativo = $rowativo['dtfim'];
    $idclienteativo = $rowativo['idcliente'];
    $fotoativo = $rowativo['foto'];

    $inicioativo = new datetime(utf8_encode($rowativo['dtinicio']));
    $fimativo = new datetime(utf8_encode($rowativo['dtfim']));
    $inicioativo = date_format($inicioativo, "d/m/y");
    $fimativo = date_format($fimativo, "d/m/y");
  }
            $rescliativo=$conn->query("SELECT `nome` FROM `clientes` WHERE `id` = '".$idclienteativo."' ");
            while ($rowcliativo=$rescliativo->fetch_assoc()) {
              $nomecliativo = $rowcliativo['nome'];
  }

 $linkedit = "<button class='btn btn-sm btn-warning' id='editanuncio' data-id='$idativo' data-idcliente='$idclienteativo' data-descricao='$descricaoativo' data-dtinicio='$inicioativo' data-dtfim='$fimativo' data-nomecliente='$nomecliativo' data-foto='$fotoativo'>Editar</button> <button class='btn btn-sm btn-danger' id='finalizaranuncio' data-id='$idativo' data-dtfim='$data' data-codlinha='$codlinha' data-numerocarro='$numerocarro'>Finalizar</button><a target='_blank' href='imprime-anuncio.php?view=$idativo'> <button class='btn btn-sm btn-info'>Imprimir</button></a>";
?>

    <tr>
<!--      <td><?php //echo $idativo;?></td> -->
      <td><?php echo $nomecliativo;?></td>
<!--      <td><?php //echo $descricaoativo; ?></td> -->
      <td><?php echo $inicioativo;?></td>
      <td><?php echo $fimativo;?></td>
<!--      <td><?php //echo $linkedit;?>xx</td> -->
    </tr>
<?php
} else {
  
 echo "<tbody><tr><td colspan='3'>Nao existe anuncio ativo</td></tr></tbody>";
  
  }
?>
  </tbody>
              </table>
            </div>
            <!-- /.box-body -->
<?php if ($countativo > 0) {
  echo "<div class='box-footer' id='linkedit'> ";
  echo $linkedit;
  echo "</div>";
}
else{
  echo "";
}
?>          </div>
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
<!--                  <th>ID</th> -->
                  <th>Cliente</th>
<!--                  <th>Descrição</th> -->
                  <th>Inicio</th>
                  <th>Fim</th>
                   <th><em class="fa fa-cog"></em></th>
<!--                  <th>Status</th> -->
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
//          $dtiniciomov = $rowcarro['dtinicio'];
//          $dtfimmov = $rowcarro['dtfim'];
          $statusmov = $rowcarro['status'];

          $dtiniciomov = new datetime(utf8_encode($rowcarro['dtinicio']));
          $dtfimmov = new datetime(utf8_encode($rowcarro['dtfim']));
          $dtiniciomov = date_format($dtiniciomov, "d/m/y");
          $dtfimmov = date_format($dtfimmov, "d/m/y");

          $linkhist = "<a target='_blank' href='imprime-anuncio.php?view=$idmov'> <button class='btn btn-sm btn-info'>Imprimir</button></a>";

          $rescli=$conn->query("SELECT `nome` FROM `clientes` WHERE `id` = '".$idclientemov."' ");
            while ($rowcli=$rescli->fetch_array()) {
              $nomecli = $rowcli['nome'];
  }
?>
        <tr>
<!--            <td><?php //echo $idmov; ?></td> -->
            <td><?php echo $nomecli;  ?></td>
<!--            <td><?php //echo $descriaomov; ?></td> -->
            <td><?php echo $dtiniciomov;  ?></td>
            <td><?php echo $dtfimmov; ?></td>
            <td><?php echo $linkhist; ?></td>
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

<!-- box edit anuncio -->
          <div class="box" id="meditanuncio" style="display:none;">
            <div class="box-header">
              <h3 class="box-title">Editar Anuncio:</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="" id="seditanuncio">
                 <input type="hidden" id="linhapai" name="linhapai" value="<?php echo $codlinha;?>">
                 <input type="hidden" id="idanuncioedit" name="idanuncioedit">
		             <input type="hidden" id="idclisel" name="idclisel">
                 <input type="hidden" name="comfotoa" id="comfotoa" value="0">
                 <input type="hidden" name="fotoold" id="fotoold">
              <div class="box-body">
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Cliente:</label>

                    <div class="col-sm-6" id="showcliativo">
      <input type="text" class="form-control" id="showcliativo2" disabled="disabled"> </div>
      <div class="col-sm-6" id="selectcli" style="display:none;">
                        <select class="form-control select2 upper" id="sel1" name="sel1" style="width: 100%" disabled="disabled">
  <?php
  $lista=$conn->query("SELECT * FROM `clientes` WHERE `ativo` = '1' ");
  $countcli = $lista->num_rows;
  if($countcli > 0)
  {
  while($rowcli=$lista->fetch_array())
  {

 $clientenome = $rowcli['nome'];
 $clienteid = $rowcli['id'];

 echo "<option value='$clienteid'>$clientenome</option>";

}
}
    ?>
   </select>
 </div>
 <div class="col-sm-3">
                  <button class="btn btn-warning" id="editcli">Editar Cliente</button>
 </div>
</div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label">descrição(breve)</label>

                    <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Descrição" id="descricao" name="descricao">
                  </div>
              </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Inicio:</label>

                    <div class="col-sm-9">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                      <input type="text" class="form-control" placeholder="Data Inicio" name="dtinicio" id="dtinicio" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>

                    </div>
                  </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Fim:</label>

                    <div class="col-sm-9">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                      <input type="text" class="form-control" placeholder="Data Fim" name="dtfim" id="dtfim" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>

                    </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-4 control-label">Imagem (250px)</label>

                    <div class="col-sm-5">
                      <input type="file" class="form-control" id="fotoa" name="fotoa" placeholder="imagem" disabled="disabled">
                  </div>
                  <div class="col-sm-3">
                    <button class="btn btn-warning" id="addfotoa">Adicionar foto</button>
                      </div>
                </div>
              </div>
            <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-danger" id="canceditanuncio">Cancelar</button>
                <button class="btn btn-success pull-right" id="salvareditanuncio">Adicionar</button>
              </div>
              <!-- /.box-footer -->
          </form>
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
      <script src="funcoes/viewcarros.js"></script>