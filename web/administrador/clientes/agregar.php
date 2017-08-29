<?php
require_once('../../../config/config.php');
require_once('../verificador.php');
index();
?>
<!DOCTYPE html>
<html>
<head>
  <?php require_once('../head.php'); ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <?php require_once('../header.php'); ?>
    <?php require_once('../menu.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          INGRESA UN NUEVO CLIENTE
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <form id="formNuevoCliente">
              <div class="form-group">
                <label for="nombre">Nombre del cliente</label>
                <input type="text" name="nombre" class="form-control" id="nombre">
              </div>
              <div class="form-group">
                <label for="direccion">Apellidos del cliente</label>
                <input type="text" name="apellidos" class="form-control" id="direccion">
              </div>
              <div class="form-group">
                <label for="telefono">Dirección del cliente</label>
                <input type="text" name="direccion" class="form-control" id="telefono">
              </div>
              <div class="form-group">
                <label for="email">Email del cliente</label>
                <input type="email" name="email" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="nombreContacto">Número de teléfono del cliente</label>
                <input type="text" name="numcel" class="form-control" id="nombreContacto">
              </div>
              <div class="form-group">
                <label for="apellidosContacto">Fecha de nacimiento del cliente</label>
                <input type="text" name="fecnac" class="form-control" id="apellidosContacto">
              </div>
              <button class="btn btn-primary enviarDatos">Guardar</button>
            </form>
          </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require_once('../footer.php'); ?>
    <div class="control-sidebar-bg"></div>
  </div>
  <script src="<?php echo URL; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo URL; ?>bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo URL; ?>plugins/fastclick/fastclick.js"></script>
  <script src="<?php echo URL; ?>dist/js/app.min.js"></script>
  <script src="<?php echo URL; ?>plugins/sparkline/jquery.sparkline.min.js"></script>
  <script src="<?php echo URL; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo URL; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="<?php echo URL; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo URL; ?>plugins/chartjs/Chart.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo URL; ?>dist/js/demo.js"></script>
  <script>
    $(document).ready(function() {

      $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
      });

      $('.enviarDatos').click(function(e) {
        e.preventDefault();
        var dataString = $('#formNuevoCliente').serialize();
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/clienteGuardar",
          data: dataString,
          beforeSend: function() {
            //alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            console.log(data);
            //alert("Recibiendo: "+data);
            switch (data) {
              case "oka":
              window.location.href = "redireccion"
              break;
              case "noka":
              swal({
                title: '¡CUENTA SUSPENDIDA!',
                text: 'Ponte en contacto con Flubox para obtener mas información.',
                type: 'error',
                confirmButtonText: 'Cool'
              })
              break;
            }
          }
        });
      });

    });
  </script>
</body>
</html>
