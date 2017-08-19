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
          Lista de habitaciones
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
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>NOMBRE</th>
                  <th>DESCRIPCIÓN</th>
                  <th>ACCION</th>
                </tr>

              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="vamoaver"></div>
          </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
            <div class="col-lg-12">
              <form>
                <div class="form-group">
                  <label for="hotelNombre">Nombre</label>
                  <input type="text" name="hotelNombre" disabled id="hotelNombre" class="form-control">
                </div>
                <div class="form-group">
                  <label for="hotelStatus">Status</label>
                  <input type="text" name="hotelStatus" disabled id="hotelStatus" class="form-control">
                </div>
              </form>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <a href="editarServicios" class="btn btn-primary">Editar servicios</a>
            <a href="editar" class="btn btn-primary">Editar habitacion</a>
          </div>
        </div>
      </div>
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
  <script>
    $(document).ready(function() {

      var tabla = $('#example').DataTable({
        "ajax":{
          "method":"POST",
          "url":"<?php echo URL; ?>controlador/habitacionEnlistar",
        },
        "columns":[
        {"data":"id_hab"},
        {"data":"titulo_habitacion"},
        {"data":"descripcion_habitacion"},
        {"defaultContent":"<button class='btn btn-primary ver'>Ver</button><button class='btn btn-danger borrar'>Borrar</button>"}
        ]
      });

      $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
      });
      $('.botonSalir').click(function() {
        var ttk = $(this).attr("token");
        var dataString = 'ttk='+ttk;
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/logout",
          data: dataString,
          beforeSend: function() {
            alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            alert(data);
            if(data == 'adios') {
              window.location.href = "index";
            } else {
              alert(data);
            }
          }
        });
      });
      $('#example tbody').on( 'click', '.ver', function () {
        console.log('click');
        var data = tabla.row( $(this).parents('tr') ).data();
        //alert("ID: "+data[0]);
        var id = data[0];
        var dataString = 'id='+id;
        alert(dataString);
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/habitacionVerDatos",
          data: dataString,
          dataType: "JSON",
          beforeSend: function() {
            //alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            console.log(data);
            $('#myModal').modal('show');
            //var data = JSON.parse(data);
            //var json=JSON.stringify(data);
            //alert(json[2]);
            $('#hotelNombre').val(data[0]["titulo_habitacion"]);
            if(data[0]["status_hab"] == 1) {
              $('#hotelStatus').val("ACTIVADA");
            } else {
              $('#hotelStatus').val("DESACTIVADA");
            }
          }
        });
      } );
      $('#example tbody').on( 'click', '.borrar', function () {

        var data = tabla.row( $(this).parents('tr') ).data();
        //alert("ID: "+data[0]);
        var id = data[0];
        var dataString = 'id='+id;
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/hotelEliminar",
          data: dataString,
          beforeSend: function() {
            //alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            alert("Eliminado: "+data);
            location.reload(true);
          }
        });
      } );
    });
  </script>
</body>
</html>
