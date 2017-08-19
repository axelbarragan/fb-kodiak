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
          Edición de <span id="tituloHotel"></span>
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
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Status de la habitación
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <input type="checkbox" id="toggle-two" data-onstyle="success" data-offstyle="danger">
                    <button class="btn btn-primary" id="guardarStatusHab">Guardar</button>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Datos generales de la habitación
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    <form class="" method="POST" id="formModificarHab">
                      <div class="form-group">
                        <label for="habitacionNombre">Nombre de la habitación</label>
                        <input type="text" name="habitacionNombre" id="habitacionNombre" class="form-control inputEditable">
                      </div>
                      <div class="form-group">
                        <label for="habitacionDescrip">Descripción</label>
                        <input type="text" name="habitacionDescrip" id="habitacionDescrip" class="form-control inputEditable">
                      </div>
                      <div class="form-group">
                        <label for="habitacionCantidad">Cantidad de habitaciones</label>
                        <input type="text" name="habitacionCantidad" id="habitacionCantidad" class="form-control inputEditable">
                      </div>
                      <div class="form-group">
                        <label for="habitacionPrecio">Precio</label>
                        <input type="text" name="habitacionPrecio" id="habitacionPrecio" class="form-control inputEditable">
                      </div>
                      <button class="btn btn-primary inputEditable" id="guardarModificarHab">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

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
        url: "<?php echo URL; ?>controlador/habitacionMostrarDatos",
        beforeSend: function() {
            //alert("Enviando");
          },
          success: function(data) {
            console.log(data);
            //alert("Recibiendo: "+data);
            var status = data[0]["status_hab"];
            if(status == 1) {
              $('#toggle-two').bootstrapToggle('on');
            } else {
              $('#toggle-two').bootstrapToggle('off');
              $('.inputEditable').attr('disabled','disabled');
            }            
            $('#habitacionNombre').val(data[0]["titulo_habitacion"]);
            $('#habitacionDescrip').val(data[0]["descripcion_habitacion"]);
            $('#habitacionCantidad').val(data[0]["cantidad_habitacion"]);
            $('#habitacionPrecio').val(data[0]["precio_hab"]);
          },
          error: function(dataError) {
            console.log(dataError.responseText);
          }
        });

      $('#guardarStatusHab').click(function() {
        var status = $('#toggle-two').prop('checked');
        if(status == true) {
          var nuevoStatus = 1;
        } else {
          var nuevoStatus = 0;
        }
        var dataString = 'habStatus='+nuevoStatus;
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/habitacionEditarStatus",
          data: dataString,
          beforeSend: function() {
            alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            alert(data);
            window.location.reload(true);
          }
        });
      });

      $('#guardarModificarHab').click(function(e) {
        e.preventDefault();
        var dataString = $('#formModificarHab').serialize();
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


    });
  </script>
</body>
</html>
