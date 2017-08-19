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
          INGRESA UN NUEVO HOTEL
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
            <form id="formNuevoHotel">
              <div class="form-group">
                <label for="nombre">Nombre del hotel</label>
                <input type="text" name="nombre" class="form-control" id="nombre">
              </div>
              <div class="form-group">
                <label for="direccion">Dirección del hotel</label>
                <input type="text" name="direccion" class="form-control" id="direccion">
              </div>
              <div class="form-group">
                <label for="telefono">Teléfono del hotel</label>
                <input type="text" name="telefono" class="form-control" id="telefono">
              </div>
              <div class="form-group">
                <label for="email">Correo del titular del hotel</label>
                <input type="email" name="email" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="nombreContacto">Nombre del titular del hotel</label>
                <input type="text" name="nombreContacto" class="form-control" id="nombreContacto">
              </div>
              <div class="form-group">
                <label for="apellidosContacto">Apellidos del titular del hotel</label>
                <input type="text" name="apellidosContacto" class="form-control" id="apellidosContacto">
              </div>
              <div class="form-group">
                <label for="img">Logo del hotel</label>
                <input type="file" class="form-control" id="campoFichero" />
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
        alert("Empieza");
        var paqueteDeDatos = new FormData();
        //var dataString = new FormData($('#formNuevoHotel')[0]);
        paqueteDeDatos.append('nom', $('#nombre').prop('value'));
        paqueteDeDatos.append('dir', $('#direccion').prop('value'));
        paqueteDeDatos.append('tel', $('#telefono').prop('value'));
        paqueteDeDatos.append('ema', $('#email').prop('value'));
        paqueteDeDatos.append('nomcon', $('#nombreContacto').prop('value'));
        paqueteDeDatos.append('apecon', $('#apellidosContacto').prop('value'));
        paqueteDeDatos.append('archivo', $('#campoFichero')[0].files[0]);
        $.ajax({
          url: "<?php echo URL; ?>controlador/hotelGuardar",
          type: "POST",
          contentType: false,
          data: paqueteDeDatos,
          processData: false,
          cache: false,
          /*beforeSend: function() {
            alert('Datos serializados: '+paqueteDeDatos);
            console.log(paqueteDeDatos);
          },*/
          success: function(data) {
            alert(data);
            console.log(data);
          },
          error: function() {
            alert("algo ha pasado");
          }
        });
      });
      $('#example tbody').on( 'click', 'button', function () {
        var data = tabla.row( $(this).parents('tr') ).data();
        alert("ID: "+data[0]);
    } );
    });
  </script>
</body>
</html>
