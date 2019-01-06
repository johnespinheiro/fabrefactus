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

  $resmovimentos=$conn->query("SELECT * FROM `movimentos`");
  $countmovimentos = $resmovimentos->num_rows;

  $resmovimentosat=$conn->query("SELECT * FROM `movimentos` WHERE `status` = '1' AND `ativo` = '1' ");
  $countmovimentosat = $resmovimentosat->num_rows;

  $resmovimentosfin=$conn->query("SELECT * FROM `movimentos` WHERE `status` = '0' AND `ativo` = '0' ");
  $countmovimentosfin = $resmovimentosfin->num_rows;
  
  $dadoscliente=$conn->query("SELECT * FROM `usuarios` WHERE `id` = '".$usuarioID."' ");
  while ($rowcli=$dadoscliente->fetch_assoc()) {
      $idcli = $rowcli['id'];
      $nomecli = $rowcli['nome'];
      $emailcli = $rowcli['email'];
  }
echo "<script>console.log('id $idcli - nome $nomecli - email $emailcli')</script>";

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        HOME 
        <small>Bem vindo, <?php echo $usuarioNome;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="indexc.php"><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Home</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-md-3">

          <!-- Perfil Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $usuarioFoto;?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $usuarioNome;?></h3>

              <p class="text-muted text-center">Cadastrado em <?php echo $created;?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Anuncios Cadastrados</b> <a class="pull-right"><?php echo $countmovimentos;?></a>
                </li>
                <li class="list-group-item">
                  <b>Ativos</b> <a class="pull-right"><?php echo $countmovimentosat;?></a>
                </li>
                <li class="list-group-item">
                  <b>Finalizados</b> <a class="pull-right"><?php echo $countmovimentosfin;?></a>
                </li>
              </ul>

<!--              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Anuncios Ativos</a></li>
              <li><a href="#myregister" data-toggle="tab">Minha conta</a></li> 
              <li><a href="#users" data-toggle="tab">Usuarios</a></li>
              <li><a href="#clients" data-toggle="tab">Clientes</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                  <table id="dtablehistoricocli" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
                      <thead>
                          <tr>
<!--                              <th>id</th> -->
                              <th>Cliente</th>
                              <th>Inicio</th>
                              <th>Fim</th>
                          </tr>
                      </thead>
                      <tbody>
  <?php
  while ($rowhistorico=$resmovimentosat->fetch_array()) {
      $idhistorico = $rowhistorico['id'];
      $deschistorico = $rowhistorico['descricao'];
      $idclientehistorico = $rowhistorico['idcliente'];
      $iniciohistorico = $rowhistorico['dtinicio'];
      $fimhistorico = $rowhistorico['dtfim'];
      
      $nomeclientehistorico=$conn->query("SELECT nome FROM clientes WHERE `id` = '".$idclientehistorico."' ");
      while ($rownomehistorico=$nomeclientehistorico->fetch_array()) {
       $hnomecli = $rownomehistorico['nome']; 
      }

  ?>
                          <tr>
 <!--                             <td><?php //echo $idhistorico;?></td> -->
                              <td><?php echo $hnomecli;?></td>
                              <td><?php echo $iniciohistorico;?></td>
                              <td><?php echo $fimhistorico;?></td>
                          </tr>
  <?php } ?>
                      </tbody>
                      <tfoot>
                          <tr>
 <!--                             <th>id</th> -->
                              <th>Cliente</th>
                              <th>Inicio</th>
                              <th>Fim</th>
                          </tr>
                      </tfoot>
                  </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="myregister">
                  <b>Nome:</b> <?php echo $nomecli;?> <br/>
                  <b>E-mail:</b> <?php echo $emailcli;?>
             <!-- div alterar senha -->
                  <div class="box">
                      <p>&nbsp;</p>
                  <form class="form-horizontal" id="frmalterarsenhauser" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="idaltsenhauser" id="idaltsenhauser" value="<?php echo $usuarioID;?>">
                    <div class="form-group">
                    <label for="inputAtualUser" class="col-sm-4 control-label">Senha atual</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="inputAtualUser" placeholder="Senha Atual">
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="inputNovaUser" class="col-sm-4 control-label">Nova Senha</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="inputNovaUser" placeholder="Nova Senha">
                    </div>
                  </div>
                      <div class="box-footer">
                        <button class="btn btn-success pull-right" id="alterarsenhauser">Alterar</button>
                      </div>
                </form>
              </div>
             <!-- /.div alterar senha -->    
              </div>
              <div class="tab-pane" id="users">
                <div class="box">
                  <div class="box-body text-center">
                    <h4>Adicionar Usuarios</h4>
                  </div>
                  <form class="form-horizontal" id="frmadduser" method="post" action="" enctype="multipart/form-data">
                  <input type="hidden" name="comfotou" id="comfotou" value="0">                  
                    <div class="form-group">
                      <label for="nome" class="col-sm-3 control-label">Nome</label>         
                        <div class="col-sm-9">
                          <input type="text" name="nomeusuario" id="nomeusuario" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" name="emailusuario" id="emailusuario" class="form-control">
                      </div>
                    </div>
<div class="form-group"> <div class="col-sm-12 text-center"><span id="resultadoemailusuario" style="color:red;"></span> </div></div>
                    <div class="form-group">
                      <label for="senha" class="col-sm-3 control-label">Senha</label>
                        <div class="col-sm-9">
                          <input type="password" name="senhausuario" id="senhausuario" class="form-control">
                        </div>
                      </div>
                  <div class="form-group">
                  <label class="col-sm-4 control-label">Foto (200x200px)</label>

                    <div class="col-sm-5">
                      <input type="file" class="form-control" id="fotou" name="fotou" placeholder="foto" disabled="disabled">
                  </div>
                  <div class="col-sm-3">
                    <button class="btn btn-warning" id="addfotou">Adicionar foto</button>
                      </div>
                </div>
                      <div class="box-footer">
                        <button class="btn btn-success pull-right" id="frmadicionaruser">Adicionar</button>
                      </div>                      
                  </form>
                </div>
                <!-- /.box -->
              </div>
              <!-- /.tab-pane -->
               <div class="tab-pane" id="clients">
               </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.navs-tab-custom -->
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
   include(FOOTER_TEMPLATE);
?>
   <script src="funcoes/profile.js"></script>