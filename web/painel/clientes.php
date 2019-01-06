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
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CLIENTES
        <small>Visualização de clientes ativos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="clientes.php">Clientes</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box" id="tabelaclientes">
            <div class="box-header">
              <h3 class="box-title">Clientes:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dtableclientes" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
<!--                  <th>ID</th> -->
                  <th>Nome</th>
<!--                  <th>Endereco</th> -->
                  <th>Telefone</th>
                  <th>Email</th>
                  <th><em class="fa fa-cog"></em></th>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                <tr>
<!--                  <th>ID</th> -->
                  <th>Nome</th>
 <!--                 <th>Endereco</th> -->
                  <th>Telefone</th>
                  <th>Email</th>
                  <th><em class="fa fa-cog"></em></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
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
                      <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required="required">
                  </div>
                </div>
                    <div class="form-group"> <div class="col-sm-12 text-center"><span id="resultadoemailcliente" style="color:red;"></span> </div></div>
                  <div class="form-group">
                  <label class="col-sm-4 control-label">Senha</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required="required">
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
<button type="button" class="btn btn-lg btn-info" id="addcliente">Adicionar Cliente</button>
</div>
</div>

</div> 
        <!-- /.col -->
      </div>
      <!-- /.row -->                       
     
     <!-- | fim conteudo | !-->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
   include(FOOTER_TEMPLATE);
   include(MODAL_DELETE);
   ?>
   <script src="funcoes/clientes.js"></script>