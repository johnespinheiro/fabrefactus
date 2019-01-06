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
        <small>Visualização de linhas Inativas</small>
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
              <table id="dtablelinhasi" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                <tr>
<!--                  <th>ID</th> -->
                  <th>Linha</th>
                  <th>Bairro</th>
                  <th><em class="fa fa-cog"></em></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
<!--                  <th>ID</th> -->
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