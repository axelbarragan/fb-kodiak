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
                      Status del hotel
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <input type="checkbox" id="toggle-two" data-onstyle="success" data-offstyle="danger">
                    <button class="btn btn-primary" id="guardarStatusHotel">Guardar</button>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Datos generales del hotel
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    <form class="" method="POST" id="formModificarGeneral">
                      <div class="form-group">
                        <label for="hotelNombre">Nombre del hotel</label>
                        <input type="text" name="hotelNombre" id="hotelNombre" class="form-control inputEditable">
                      </div>
                      <div class="form-group">
                        <label for="hotelDireccion">Dirección del hotel</label>
                        <input type="text" name="hotelDireccion" id="hotelDireccion" class="form-control inputEditable">
                      </div>
                      <div class="form-group">
                        <label for="hotelTelefono">Teléfono del hotel</label>
                        <input type="text" name="hotelTelefono" id="hotelTelefono" class="form-control inputEditable">
                      </div>
                      <button class="btn btn-primary inputEditable" id="guardarGeneralHotel">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                      Datos de usuario
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    <form class="" method="POST" id="formModificarUsuario">
                      <div class="form-group">
                        <label for="usuarioNombre">Nombre del usuario</label>
                        <input type="text" name="usuarioNombre" id="usuarioNombre" class="form-control inputEditable">
                      </div>
                      <div class="form-group">
                        <label for="usuarioApellidos">Apellidos del usuario</label>
                        <input type="text" name="usuarioApellidos" id="usuarioApellidos" class="form-control inputEditable">
                      </div>
                      <button class="btn btn-primary inputEditable" id="guardarUsuarioHotel">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFour">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                      Datos de sesión
                    </a>
                  </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                  <div class="panel-body">
                    <form class="" method="POST" id="formModificarSesion">
                      <div class="form-group">
                        <label for="correoUsuario">Correo de usuario</label>
                        <input type="text" name="correoUsuario" id="correoUsuario" class="form-control inputEditable">
                      </div>
                      <!-- <div class="form-group">
                        <label for="usuarioApellidos">Apellidos del usuario</label>
                        <input type="text" name="usuarioApellidos" id="usuarioApellidos" class="form-control inputEditable">
                      </div>-->
                      <button class="btn btn-primary inputEditable" id="guardarSesionHotel">Guardar</button>
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
        url: "<?php echo URL; ?>controlador/hotelEditar",
        beforeSend: function() {
            //alert("Enviando");
          },
          success: function(data) {
            console.log(data);
            //alert("Recibiendo: "+data);
            var status = data[0]["status_hotel"];
            if(status == 1) {
              $('#toggle-two').bootstrapToggle('on');
            } else {
              $('#toggle-two').bootstrapToggle('off');
              $('.inputEditable').attr('disabled','disabled');
            }            
            $('#tituloHotel').html(data[0]["nombre_hotel"]);
            $('#hotelNombre').val(data[0]["nombre_hotel"]);
            $('#hotelDireccion').val(data[0]["direccion_hotel"]);
            $('#hotelTelefono').val(data[0]["telefono_hotel"]);
            $('#usuarioNombre').val(data[0]["nombre_usuario"]);
            $('#usuarioApellidos').val(data[0]["apellidos_usuario"]);
            $('#correoUsuario').val(data[0]["correo_usuario"]);
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

      $('#guardarUsuarioHotel').click(function(e) {
        e.preventDefault();
        var dataString = $('#formModificarUsuario').serialize();
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/hotelEditarUsuario",
          data: dataString,
          beforeSend: function() {
            alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            alert(data);
            window.location.href = "enlistar";
          },
          error: function(dataError) {
            alert(dataError);
          }
        });
      }); guardarSesionHotel

      $('#guardarSesionHotel').click(function(e) {
        e.preventDefault();
        var dataString = $('#formModificarSesion').serialize();
        $.ajax({
          type: "POST",
          url: "<?php echo URL; ?>controlador/hotelEditarSesion",
          data: dataString,
          beforeSend: function() {
            alert('Datos serializados: '+dataString);
          },
          success: function(data) {
            alert(data);
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
