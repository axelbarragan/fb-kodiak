<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo URL; ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['nombre_usuario']; ?></p>
        <small><?php echo $_SESSION['nombre_empresa']; ?></small>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li class="header">MENÚ PRINCIPAL</li>
      <li>
        <a href="<?php echo URL.URLADMIN; ?>index">
          <i class="fa fa-dashboard"></i> <span>Inicio</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-hotel"></i>
          <span>Habitaciones</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo URL.URLCLIEN; ?>habitaciones/agregar"><i class="fa fa-plus"></i> Agregar</a></li>
          <li><a href="<?php echo URL.URLCLIEN; ?>habitaciones/enlistar"><i class="fa fa-list-alt"></i> Ver lista</a></li>
        </ul>
      </li>
      <li class="header">OTRA SECCIÓN</li>
      <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Otro link</span></a></li>    
    </ul>
  </section>
</aside>