<header class="main-header">
    <a href="index2.html" class="logo">
      <span class="logo-lg">Proyecto Samba</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo URL; ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nombre_usuario'];  ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo URL; ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['nombre_usuario']." - ".$_SESSION['nivel_usuario'];  ?>
                  <small><?php echo $_SESSION['nombre_empresa']; ?></small>
                </p>
              </li>
              <li class="user-body">
                <div class="row">
                </div>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <button class="btn btn-default btn-flat botonSalir" token="<?php echo $_SESSION['token']; ?>">Cerrar sesión</button>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>