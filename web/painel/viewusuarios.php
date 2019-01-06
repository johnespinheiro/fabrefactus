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

  $res=$conn->query("SELECT * FROM `usuarios` WHERE `ID` = '".$id."' ");
  $counts = $res->num_rows;
  if($counts > 0)
  {
  while($row=$res->fetch_assoc())
  {

 $nome = $row['nome'];
// $telefone = $row['telefone'];
 $email = $row['email'];
// $endereco = $row['endereco'];
 $foto = $row['foto'];

  }
}
  else {
    echo "<script>alert('CLIENTE NAO ENCONTRADO')</script>";
    echo "<script>window.history.back(-1)</script>";
    exit;
  }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        USUARIOS
        <small>Visualização de Usuarios ativos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
        <li class="active"><a href="#">Visualizar Usuario</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box" id="tabelacarro">
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
<!--    <th>telefone</th> -->
    <th>email</th>
    <th><em class="fa fa-cog"></em></th>
  </tr>
  </thead>
  <tbody>
    <tr>
<!--      <td><?php //echo $id;?></td> -->
      <td><?php echo $nome;?></td>
<!--      <td><?php //echo $telefone;?></td> -->
      <td><?php echo $email;?></td>
      <td>
      <a class="desativarusuario" id="<?php echo $id ?>" data-tabela="usuarios" data-codusuario="<?php echo $id;?>" data-usuarionome="<?php echo $usuarioNome; ?>"><button class="btn btn-sm btn-danger">Desativar</button></a>
    </td>
    </tr>
  </tbody>
              </table>
            </div>
            <!-- /.box-body -->
<div class="box-footer">
<?php echo "<button class='btn btn-sm btn-warning' id='editcliente' data-id='$id' data-nome='$nome' data-telefone='$telefone' data-email='$email' data-endereco='$endereco' data-foto='$foto'> Editar</button>";?>
</div>
          </div>
          <!-- /.box -->
<!-- box anuncio ativo -->
            <div class="box" id="anuncioativo">
            <div class="box-header">
              <h3 class="box-title">Anuncios Ativos:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dtableanuncioativo" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
  <thead>
    <tr>
<!--                  <th>ID</th> 
                  <th>Descrição</th> -->
                  <th>Inicio</th>
                  <th>Fim</th>
                  <th><em class="fa fa-cog"></em></th>

  </tr>
  </thead>
  <tbody>
    <?php
    $resativo=$conn->query("SELECT * FROM `movimentos` WHERE `idcliente` = '".$id."' AND `ativo` = '1' AND `status` = '1' ");
  $countativo = $resativo->num_rows;
  if($countativo > 0)
  {
  while($rowativo=$resativo->fetch_array())
  {
    $idativo = $rowativo['id'];
    $descricaoativo = $rowativo['descricao'];
//    $inicioativo = $rowativo['dtinicio'];
//    $fimativo = $rowativo['dtfim'];
//    $idclienteativo = $rowativo['idcliente'];

    $inicioativo = new datetime(utf8_encode($rowativo['dtinicio']));
    $fimativo = new datetime(utf8_encode($rowativo['dtfim']));
    $inicioativo = date_format($inicioativo, "d/m/y");
    $fimativo = date_format($fimativo, "d/m/y");
  //}

    $linkimprime = "<a target='_blank' href='imprime-anuncio.php?view=$idativo'> <button class='btn btn-sm btn-info'>Imprimir</button></a>";

 //$linkedit = "<button class='btn btn-sm btn-warning' id='editanuncio' data-id='$idativo' data-idcliente='$idclienteativo' data-descricao='$descricaoativo' data-dtinicio='$inicioativo' data-dtfim='$fimativo' data-nomecliente='$nomecliativo'>Editar</button> <button class='btn btn-sm btn-danger' id='finalizaranuncio' data-id='$idativo' data-dtfim='$data' data-codlinha='$codlinha' data-numerocarro='$numerocarro'>Finalizar</button>";
?>

    <tr>
<!--      <td><?php //echo $idativo;?></td>
      <td><?php //echo $descricaoativo; ?></td> -->
      <td><?php echo $inicioativo;?></td>
      <td><?php echo $fimativo;?></td>
      <td><?php echo $linkimprime;?></td>

    </tr>
<?php
}
} else {
  
 echo "<tbody><tr><td colspan='5'>Nao existe anuncio ativo</td></tr></tbody>";
  
  }
?>
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
$rescarro=$conn->query("SELECT * FROM `movimentos` WHERE `idcliente` = '".$id."' and `ativo` = '0' ");
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

 // }
?>
        <tr>
<!--            <td><?php //echo $idmov; ?></td>
            <td><?php //echo $descriaomov; ?></td> -->
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
<!-- box cadastro cliente -->
          <div class="box" id="meditcliente" style="display:none;">
            <div class="box-header">
              <h3 class="box-title">Editar Cliente:</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="" id="seditcliente" enctype="multipart/form-data">
              <input type="hidden" name="comfotoc" id="comfotoc" value="0">
              <input type="hidden" name="fotoold" id="fotoold">
              <input type="hidden" name="idcliente" id="idcliente">
              <div class="box-body">
                  <div class="form-group">
                  <label class="col-sm-4 control-label">Nome</label>

                    <div class="col-sm-8">
                    <input type="text" class="form-control upper" placeholder="Nome" id="nome" name="nome">
                  </div>
              </div>
                  <div class="form-group">
                  <label class="col-sm-4 control-label">Endereco</label>

                    <div class="col-sm-8">
                    <input type="text" class="form-control upper" placeholder="Endereço" id="endereco" name="endereco">
                  </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Whatsapp:</label>

                    <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" placeholder="Celular" name="celular" id="celular" data-inputmask="'mask': '(99) 99999-9999'" data-mask>
                </div>
                <!-- /.input group -->
              </div>
              </div>
                  <div class="form-group">
                  <label class="col-sm-4 control-label">E-mail</label>

                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                  </div>
                </div>
                    <div class="form-group"> <div class="col-sm-12 text-center"><span id="resultadoemailcliente" style="color:red;"></span> </div></div>
                  <div class="form-group">
                  <label class="col-sm-4 control-label">Foto (200x200px)</label>

                    <div class="col-sm-5">
                      <input type="file" class="form-control" id="fotoc" name="fotoc" placeholder="foto" disabled="disabled">
                  </div>
                  <div class="col-sm-3">
                    <button class="btn btn-warning" id="addfotoc">Adicionar foto</button>
                      </div>
                </div>
              </div>
            <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-danger" id="cancelareditcliente">Cancelar</button>
                <button class="btn btn-success pull-right" id="salvareditcliente">Salvar</button>
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
   include(MODAL_DESATIVAR);
   ?>
      <script src="funcoes/viewclientes.js"></script>