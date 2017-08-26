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
          Hoteles
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
                  <th>NOMBRE</th>
                  <th>RAZÓN</th>
                  <th>BORRADO POR</th>
                  <th>FECHA</th>
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
            <h4 class="modal-title" id="myModalLabel">Borrar <span id="nombreHotelBorrar"></span></h4>
          </div>
          <div class="modal-body">
            <div class="col-lg-12">
            <form id="formHotelBorrar" method="POST" action="">
                <div class="form-group">
                  <label for="hotelNombre">Razón por la que se borrará el hotel:</label>
                  <textarea class="form-control" name="desc" id=desc></textarea>
                  <input type="hidden" name="idHotelBorrar" id="idHotelBorrar">
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-danger" id="borrarDefinitivamente">Borrar</button>
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

      mostrarDatos();


      function mostrarDatos() {
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/hotelEnlistarBorrados",
          beforeSend: function() {
            //alert("Enviando");
          },
          success: function(data) {
            console.log(data);
            $.each(data, function(i, item) {
              $('tbody').append(
                "<tr>"+
                "<td>"+item['hotel_reg']+"</td>"+
                "<td>"+item['desc_reg']+"</td>"+
                "<td>"+item['usuario_reg']+"</td>"+
                "<td>"+item['fecha_reg']+" - "+item['hora_reg']+"</td>"+
                "</tr>"
                );
            });
            $('#example').DataTable();
          }
        });
      }

      $('#example tbody').on('click', '#borrarServicio', function () {
        var id = $(this).attr('idHotel');
        $('#idHotelBorrar').val(id);
        $('#myModal').modal('show');
      });

      $('#borrarDefinitivamente').click(function(e) {
        e.preventDefault();
        var dataString = $('#formHotelBorrar').serialize();
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/hotelEliminar",
          data: dataString,
          beforeSend: function() {
            alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            alert(data);
            $('tbody').empty();
            mostrarDatos();
          }
        });
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
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/hotelVerDatos",
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
            $('#hotelNombre').val(data[0]["nombre_hotel"]);
            $('#hotelStatus').val(data[0]["status_hotel"]);
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
