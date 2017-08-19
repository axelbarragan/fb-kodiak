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
          Reservaciones
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-lg-12">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>NOMBRE DEL CLIENTE</th>
                  <th>DIRECCIÓN</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="vamoaver"></div>
          </div>
        </div>
      </section>
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
    <div class="modal fade" id="modalVer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Ver detalles del hotel <span id="nombreHotelBorrar"></span></h4>
          </div>
          <div class="modal-body">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Nombre del hotel</label>
                <input type="text" id="verNombre" class="form-control" disabled>
              </div>
              <div class="form-group">
                <label>Dirección del hotel</label>
                <input type="text" id="verDireccion" class="form-control" disabled>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href="editar" class="btn btn-danger">Editar</a>
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
          url: "<?php echo URL; ?>controlador/reservacionEnlistar",
          beforeSend: function() {
            //alert("Enviando");
          },
          success: function(data) {
            console.log(data);
            $.each(data, function(i, item) {
              $('tbody').append(
                "<tr>"+
                "<td>"+item['nombreCliente']+"</td>"+
                "<td>"+item['fechaEntrada']+"</td>"+
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

      $('#example tbody').on( 'click', '#ver', function () {
        console.log('click');
        var id = $(this).attr('idHotel');
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
            $('#modalVer').modal('show');
            $('#verNombre').val(data[0]['nombre_hotel']);
            $('#verDireccion').val(data[0]['direccion_hotel']);
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
