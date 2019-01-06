<?php if($usuarioNivelAcesso > 1) {

?>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Principal</li>
        <!-- Optionally, you can add icons to the links -->

 <!--        <li><a href="linhas.php"><i class="fa fa-link"></i> <span>Linhas</span></a></li>
        <li><a href="clientes.php"><i class="fa fa-link"></i> <span>Clientes</span></a></li> -->

        <li><a href="inbox.php"><i class="fa fa-envelope"></i> <span>Suporte</span></a></li>
        <li><a href="../calendario.php"><i class="fa fa-calendar"></i> <span>Agenda</span></a></li>

        <li class="treeview">
          <a href="#"><i class="fa fa-bus"></i> <span>Linhas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../linhas.php"><i class="fa fa-check-circle-o"></i>Linhas Ativas</a></li>
            <li><a href="../linhasi.php"><i class="fa fa-times"></i>Linhas Inativas</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-car"></i> <span>Carros</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../carros.php"><i class="fa fa-check-circle-o"></i>Carros Ativos</a></li>
            <li><a href="../carrosi.php"><i class="fa fa-times"></i>Carros Inativos</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="ion ion-person-add"></i> <span>Clientes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../clientes.php"><i class="fa fa-check-circle-o"></i>Clientes Ativos</a></li>
            <li><a href="../clientesi.php"><i class="fa fa-times"></i>Clientes Inativos</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-file"></i> <span>Relatorios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a target="_blank" href="../relatorios/relanuncios.php"><i class="fa fa-circle-o"></i>Anuncios</a></li>
            <li><a target="_blank" href="../relatorios/relclientes.php"><i class="fa fa-circle-o"></i>Clientes</a></li>
            <li><a target="_blank" href="../relatorios/relcarros.php"><i class="fa fa-circle-o"></i>Carros</a></li>
            <li><a target="_blank" href="../relatorios/relagenda.php"><i class="fa fa-circle-o"></i>Agenda</a></li>
          </ul>
        </li>
        <li><a href="../sair.php"><i class="fa fa-sign-out"></i> <span>Sair</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
<?php
}
elseif($usuarioNivelAcesso == 1)
{
  ?>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Principal</li>
        <!-- Optionally, you can add icons to the links -->

 <!--        <li><a href="linhas.php"><i class="fa fa-link"></i> <span>Linhas</span></a></li>
        <li><a href="clientes.php"><i class="fa fa-link"></i> <span>Clientes</span></a></li> -->

        <li><a href="inbox.php"><i class="fa fa-envelope"></i> <span>Suporte</span></a></li>
        <li><a href="../sair.php"><i class="fa fa-sign-out"></i> <span>Sair</span></a></li>
      </ul>

<?php
}
?>