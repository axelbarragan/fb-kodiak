<?php
require_once('../../config/config.php');
require_once('verificador.php');
index();
?>
<!DOCTYPE html>
<html>
<head>
  <?php require_once('head.php'); ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <?php require_once('header.php'); ?>
    <?php require_once('menu.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Bienvenido.
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
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-hospital-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de hoteles</span>
                <span class="info-box-number cuantosHoteles"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-bed"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de habitaciones</span>
                <span class="info-box-number cuantasHabitaciones"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">RESERVACIONES</span>
                <span class="info-box-number">760</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require_once('footer.php'); ?>
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
  <script src="<?php echo URL; ?>dist/js/demo.js"></script>
  <script>
    $(document).ready(function() {

      cargarDatos();
      
      function cargarDatos() {
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/cuantosHoteles",
          beforeSend: function() {
            //alert('Datos serializados: ');
          },
          success: function(data) {
            //alert(data);
            var json=$.parseJSON(data);
            $('.cuantosHoteles').html(json.cuantosHoteles);
            $('.cuantasHabitaciones').html(json.cuantasHabitaciones);
          }
        });
      }
      

      $('.botonSalir').click(function() {
        var ttk = $(this).attr("token");
        var dataString = 'ttk='+ttk;
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/logout",
          data: dataString,
          beforeSend: function() {
            //alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            //alert(data);
            if(data == 'adios') {
              window.location.href = "<?php echo URL; ?>login";
            } else {
              alert(data);
            }
          }
        });
      });

      
    });
  </script>
</body>
</html>
