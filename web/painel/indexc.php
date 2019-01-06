  <?php
 include 'conexao.php';
 include(HEADER_TEMPLATE);

   $nivel = "1";
echo "<script>console.log('nv $nivel')</script>";
  if ($usuarioNivelAcesso < $nivel)
   {
     echo "<script>alert('USUARIO NAO PERMITIDO NESTA PAGINA')</script>";
    session_destroy();
    header('location:../index.php');
    exit;
  }

  $reslinhas=$conn->query("SELECT * FROM `linhas` WHERE `ativo` = '1' ");
  $countlinhas = $reslinhas->num_rows;

  $reslinhasi=$conn->query("SELECT * FROM `linhas` WHERE `ativo` = '0' ");
  $countlinhasi = $reslinhasi->num_rows;

  $rescarros=$conn->query("SELECT * FROM `carros` WHERE `ativo` = '1' ");
  $countcarros = $rescarros->num_rows;

  $resclientes=$conn->query("SELECT * FROM `clientes` WHERE `ativo` = '1' ");
  $countclientes = $resclientes->num_rows;  

  $resmovimentos=$conn->query("SELECT * FROM `movimentos` WHERE `ativo` = '1' and `status` = '1' ");
  $countmovimentos = $resmovimentos->num_rows;

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Bem vindo, <?php echo $usuarioNome;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Home</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--| Your Page Content Here | -->

<div class="row">
<!--  <div class="col-xs-12">
    <div class="box">
      <div class="box-header"> -->
 <!--           </div>
              <div class="box-body"> -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3><?php echo $countlinhas;?></h3>

                      <p>Linhas Ativas</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-car"></i>
                    </div>
                    <a href="linhas.php" class="small-box-footer">
                      Ver mais <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
<!--              </div>
            </div>
          </div> -->
                <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $countlinhasi;?></h3>

              <p>Linhas Inativas</p>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
            <a href="linhasi.php" class="small-box-footer">
              Ver mais <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $countclientes;?></h3>

              <p>Clientes Ativos</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="clientes.php" class="small-box-footer">
              Ver mais <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $countmovimentos;?></h3>

              <p>Anuncios Ativos</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="linhas.php" class="small-box-footer">
              Ver mais <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
</div>
     
     <!-------------------------- !-->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
   include(FOOTER_TEMPLATE);
   ?>