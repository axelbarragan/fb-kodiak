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
          Edición de servicios
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
          <div class="col-lg-12">
            <div id="array">
            </div>
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>NOMBRE</th>
                  <th>PRECIO</th>
                  <th>ACCION</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
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
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script>
    $(document).ready(function() {
      //alert("F");
      $('#toggle-two').bootstrapToggle({
        on: 'Activado',
        off: 'Desactivado'
      });

      

      $.ajax({
        type: "POST",
        url: "<?php echo URL; ?>controlador/habitacionEditar",
        beforeSend: function() {
            //alert("Enviando");
          },
          success: function(data) {
            console.log(data);
            $.each(data, function(i, item) {
              $('tbody').append(
                "<tr>"+
                "<td>"+item['nombre_servicio']+"</td>"+
                "<td>"+item['precio_serv']+"</td>"+
                "<td><button id='borrarServicio' idSer='"+item['id_servicio_hab']+"' class='btn btn-danger'><i class='fa fa-minus-circle' aria-hidden='true'></i> Borrar</button</td>"+
                "</tr>"
              );
            });
            $('#example').DataTable();
          }
        });

      $('#guardarStatusHotel').click(function() {
        var status = $('#toggle-two').prop('checked');
        if(status == true) {
          var nuevoStatus = 1;
        } else {
          var nuevoStatus = 0;
        }
        var dataString = 'hotelStatus='+nuevoStatus;
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/hotelEditarStatus",
          data: dataString,
          beforeSend: function() {
            //alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            //alert(data);
            window.location.reload(true);
          }
        });
      });

      $('#guardarGeneralHotel').click(function(e) {
        e.preventDefault();
        var dataString = $('#formModificarGeneral').serialize();
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/hotelEditarGeneral",
          data: dataString,
          beforeSend: function() {
            //alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            //alert(data);
            window.location.href = "enlistar";
          },
          error: function(dataError) {
            alert(dataError);
          }
        });
      });

      $('#example tbody').on( 'click', '#borrarServicio', function () {
        var id = $(this).attr('idSer');
        var dataString = 'id='+id;
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/habitacionBorrarServicio",
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

    });
  </script>
</body>
</html>
