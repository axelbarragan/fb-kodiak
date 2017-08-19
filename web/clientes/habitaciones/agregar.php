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
          INGRESA UNA NUEVA HABITACIÓN
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
            <form id="formNuevaHab" action="#" method="post">
              <div class="form-group">
                <label for="habTitulo">Titulo de la habitación</label>
                <input type="text" name="habTitulo" class="form-control" id="habTitulo">
              </div>
              <div class="form-group">
                <label for="habDesc">Descripción de la habitación</label>
                <input type="text" name="habDesc" class="form-control" id="habDesc">
              </div>
              <div class="form-group">
                <label for="habCantidad">Cantidad de habitaciones</label>
                <input type="text" name="habCantidad" class="form-control" id="habCantidad">
              </div>
              <div class="form-group">
                <label for="habPrecio">Precio por habitación</label>
                <input type="text" name="habPrecio" class="form-control" id="habPrecio">
              </div>
              <hr>
              <button class="btn btn-primary enviarDatos">Enviar</button>
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
        var dataString = $('#formNuevaHab').serialize();
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/habitacionRegistrar",
          data: dataString,
          beforeSend: function() {
            alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            alert(data);
          },
          error: function(dataError) {
            alert(dataError);
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
