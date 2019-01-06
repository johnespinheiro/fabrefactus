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
 $LinhaPai = $row['codlinha'];
 $bairro = $row['bairro'];
}
}
  else
  {
  echo "<script>alert('LINHA INVALIDA')</script>";
  echo "<script>window.history.back();</script>";
  exit();
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LINHAS
        <small>Visualização de linha ativa e carros vinculados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="linhas.php">Linhas</a></li>
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
<!--      <td><?php //echo $row['id'];?></td> -->
      <td><?php echo $LinhaPai?></td>
      <td><?php echo $bairro;?></td>
      <td>
      <a class="desativarlinha" id="<?php echo $id ?>" data-tabela="linhas" data-codlinha="<?php echo $LinhaPai;?>" data-usuarionome="<?php echo $usuarioNome; ?>" data-bairro="<?php echo $bairro;?>"><button class="btn btn-sm btn-danger">Desativar</button></a>
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
        $sqlcarro=$conn->query("SELECT * FROM `carros` WHERE `idlinha` = '".$id."' AND `ativo` = '1' ");
//        $resultcarro = $conn->query($sqlcarro);
        while ($rowcarro = $sqlcarro->fetch_array()) {
            $idcarro = $rowcarro['id'];
            $codlinha2 = $rowcarro['codlinha'];
            $numerocarro = $rowcarro['numerocarro'];
            $status = $rowcarro['status'];
            $linhauso = $rowcarro['linhauso'];
            $id2 = md5($idcarro);

            switch ($status) {
    case 1:
        $status2 = "<span class='label label-danger'>Em uso - linha $linhauso</span>";
        $link2 = "<button class='btn btn-sm btn-danger disabled' disabled/>Desativar</button>";
        break;
    case 0:
        $status2 = "<span class='label label-success'>Livre</span>";
        $link2 = "<a class='desativarcarro' id='$idcarro' data-id='$idcarro' data-tabela='carros' data-codlinha='$codlinha2' data-carro='$numerocarro' data-usuarionome='user'><button class='btn btn-sm btn-danger'>Desativar</button></a>";
        break;
        }

        $link = "<a href='viewcarros.php?auth=$id2&view=$idcarro'> <button class='btn btn-sm btn-info'>Visualizar</button></a>";                   
?>

        <tr>
<!--            <td><?php //echo $idcarro; ?></td> -->
            <td><?php echo $numerocarro;  ?></td>
            <td><?php echo $status2;  ?></td>
            <td><?php echo $link;echo '&nbsp;'; echo $link2; ?></td>
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

<!-- box cadastro carro -->
          <div class="box" id="mostracarro" style="display:none;">
            <div class="box-header">
              <h3 class="box-title">Adicionar Carro:</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="" id="cadcarro">
              <div class="box-body">
                  <div class="form-group">
                  <label class="col-sm-4 control-label">Numero Carro:</label>

                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Numero Carro" id="numerocarro" name="numerocarro">
                       <input type="hidden" id="linhapai2" name="linhapai2" value="<?php echo $LinhaPai;?>">
                       <input type="hidden" id="idlinha" name="idlinha" value="<?php echo $id;?>">
                  </div>
                    <div class="form-group"> <div class="col-sm-12 text-center"><span id="resultadonumerocarro" style="color:red;"></span> </div></div>
              </div>
              </div>
            <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-danger" id="cancelarcarro">Cancelar</button>
                <button class="btn btn-success pull-right" id="salvarcarro">Adicionar</button>
              </div>
              <!-- /.box-footer -->
          </form>
        </div>
         <!-- /.box -->

<!-- box cadastro anuncio -->
          <div class="box" id="mostraanuncio" style="display:none;">
            <div class="box-header">
              <h3 class="box-title">Adicionar Anuncio:</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="" id="cadanuncio" enctype="multipart/form-data">
                 <input type="hidden" id="linhapai" name="linhapai" value="<?php echo $LinhaPai;?>">
                 <input type="hidden" name="comfotoa" id="comfotoa" value="0">
                 <input type="hidden" id="anidlinha" name="anidlinha" value="<?php echo $id;?>">
              <div class="box-body">
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Carro:</label>

                    <div class="col-sm-9">
                    <select class="form-control select2 upper" id="sel2" name="sel2" style="width: 100%;">
                         <option value="">Selecione Carro</option>
  <?php
  $selectcarro=$conn->query("SELECT * FROM `carros` WHERE `idlinha` = '".$id."' AND `status` = '0' AND `ativo` = '1' ");
  $countcarro = $selectcarro->num_rows;
  if($countcarro > 0)
  {
  while($rowcarro=$selectcarro->fetch_array())
  {

 $carroid = $rowcarro['numerocarro'];
 $carroid2 = $rowcarro['id'];

 echo "<option value='$carroid2'>$carroid</option>";

}
}
    ?>
   </select>
                  </div>
              </div>
                                <div class="form-group">
                  <label class="col-sm-3 control-label">Cliente:</label>

                    <div class="col-sm-9">
                        <select class="form-control select2 upper" id="sel1" name="sel1" style="width: 100%;">
   <option value="">Selecione Cliente</option>
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
                <button class="btn btn-danger" id="cancelaranuncio">Cancelar</button>
                <button class="btn btn-success pull-right" id="salvaranuncio">Adicionar</button>
              </div>
              <!-- /.box-footer -->
          </form>
        </div>
         <!-- /.box -->
<!-- box cadastro cliente -->
          <div class="box" id="mostracliente" style="display:none;">
            <div class="box-header">
              <h3 class="box-title">Adicionar Cliente:</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="" id="cadcliente" enctype="multipart/form-data">
              <input type="hidden" name="comfotoc" id="comfotoc" value="0">
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
                  <label class="col-sm-4 control-label">Senha</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                  </div>
                </div>
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
                <button class="btn btn-danger" id="cancelarcliente">Cancelar</button>
                <button class="btn btn-success pull-right" id="salvarcliente">Adicionar</button>
              </div>
              <!-- /.box-footer -->
          </form>
        </div>
         <!-- /.box -->

<div class="box" id="menuviewlinhas">
              <div class="box-header">
              <h3 class="box-title">Gerenciamento:</h3>
            </div>
              <div class="box-body">


<button type="button" class="btn btn-lg btn-warning" id="addcarros" data-id="<?php echo $LinhaPai;?>">Adicionar carro</button>


<button type="button" class="btn btn-lg btn-success" id="addanuncio">Adicionar Anuncio</button>


<button type="button" class="btn btn-lg btn-info" id="addcliente">Adicionar Cliente</button>
</div>
</div>


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
//   include(MODAL_DELETE);
   include(MODAL_DESATIVAR);
   ?>
   <script src="funcoes/viewlinhas.js"></script>