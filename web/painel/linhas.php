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
        LINHAS
        <small>Visualização de linhas ativas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="linhas.php">Linhas</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!--| Your Page Content Here | -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box" id="tabelalinhas">
            <div class="box-header">
              <h3 class="box-title">Linhas:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dtablelinhas" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
<!--                  <th>ID</th> -->
                  <th>Linha</th>
                  <th>Bairro</th>
                  <th><em class="fa fa-cog"></em></th>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                <tr>
 <!--                 <th>ID</th> -->
                  <th>Linha</th>
                  <th>Bairro</th>
                  <th><em class="fa fa-cog"></em></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box" id="mostralinha" style="display:none;">
            <div class="box-header">
              <h3 class="box-title">Adicionar Linhas:</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="" id="cadlinha">
              <div class="box-body">
                  <div class="form-group">
                  <label class="col-sm-2 control-label">Linha:</label>

                    <div class="col-sm-10">
                    <input type="text" class="form-control upper" placeholder="ID Linha" id="codlinha" name="codlinha">
                  </div>
              </div> <div class="form-group"> <div class="col-sm-12 text-center"><span id="resultado" style="color:red;"></span> </div></div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label">Bairro:</label>

                    <div class="col-sm-10">
                    <input type="text" class="form-control upper" placeholder="Bairro" name="bairro" id="bairro">
                  </div>
              </div>
            <!-- /.form group -->
          </div>
          <!-- /.box body -->
              <div class="box-footer">
                <button class="btn btn-danger" id="cancelarlinha">Cancelar</button>
                <button class="btn btn-success pull-right" id="salvarlinha">Adicionar</button>
              </div>
              <!-- /.box-footer -->
          </form>
        </div>
         <!-- /.box -->
 <div class="box" id="menulinhas">
<div class="box" id="menuviewlinhas">
              <div class="box-header">
              <h3 class="box-title">Gerenciamento:</h3>
            </div>
              <div class="box-body">
   <button type="button" class="btn btn-lg btn-warning" id="addlinhas">Adicionar nova linha</button> </div>
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
   <script src="funcoes/linhas.js"></script>