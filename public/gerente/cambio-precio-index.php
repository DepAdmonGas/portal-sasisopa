<?php
require('app/help.php');
?>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?= RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?= RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?= RUTA_CSS ?>alertify.css">
  <link rel="stylesheet" href="<?= RUTA_CSS ?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?= RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?= RUTA_CSS ?>componentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?= RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <style media="screen">
    .LoaderPage {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249, 249, 249);
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
      $(".LoaderPage").fadeOut("slow");

      CambioPrecio();
    });

    function regresarP() {
      window.history.back();
    }

    function BTNActualizar(IDEstacion) {

      var GSUPER = $('#GSUPER').val();
      var GPREMIUM = $('#GPREMIUM').val();
      var GDIESEL = $('#GDIESEL').val();
      var Fecha = $('#Fecha').val();
      var Hora = $('#Hora').val();

      if (Fecha != "") {
        $('#Fecha').css('border', '');
        if (Hora != "") {
          $('#Hora').css('border', '');


          ServerActual(IDEstacion);

        } else {
          $('#Hora').css('border', '2px solid #A52525');
        }
      } else {
        $('#Fecha').css('border', '2px solid #A52525');
      }
    }

    function ServerActual(IDEstacion) {

      var GSUPER = $('#GSUPER').val();
      var GPREMIUM = $('#GPREMIUM').val();
      var GDIESEL = $('#GDIESEL').val();
      var Fecha = $('#Fecha').val();
      var Hora = $('#Hora').val();

      var parametros = {
        "idEstacion": IDEstacion,
        "GSUPER": GSUPER,
        "GPREMIUM": GPREMIUM,
        "GDIESEL": GDIESEL,
        "Fecha": Fecha,
        "Hora": Hora

      };

      $.ajax({
        data: parametros,
        url: 'public/gerente/agregar/agregar-cambio-precio.php',
        type: 'post',
        beforeSend: function() {},
        complete: function() {},
        success: function(response) {

          if (response > 0) {
            CambioPrecio();
            PaginaWeb(IDEstacion, response);
          } else {
            alertify.error('No se actualizo la información');
          }
        }
      });
    }

    function PaginaWeb(IDEstacion, id) {
      var GSUPER = $('#GSUPER').val();
      var GPREMIUM = $('#GPREMIUM').val();
      var GDIESEL = $('#GDIESEL').val();
      var Fecha = $('#Fecha').val();
      var Hora = $('#Hora').val();


      var parametros = {
        "idEstacion": IDEstacion,
        "idReporte": id,
        "GSUPER": GSUPER,
        "GPREMIUM": GPREMIUM,
        "GDIESEL": GDIESEL,
        "Fecha": Fecha,
        "Hora": Hora,
        "TOKEN": "28102020"
      };

      $.ajax({
        data: parametros,
        url: 'https://admongas.com.mx/app/api/postCambioPrecio.php',
        type: 'GET',
        beforeSend: function() {},
        complete: function() {

        },
        success: function(response) {

          if (response == 1) {
            $('#GSUPER').val('');
            $('#GPREMIUM').val('');
            $('#GDIESEL').val('');
            $('#Fecha').val('');
            $('#Hora').val('');
            CambioPrecio();
            alertify.message('Se actualizo correctamente el precio');
          }
        }
      });

    }

    function CambioPrecio() {
      let targets = [2,3, 4, 5, 6, 7];
      $('#DivPrecios').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
      $('#DivPrecios').load('public/gerente/vistas/lista-cambio-precios.php', function() {
        $('#table_precios').DataTable({
          "language": {
            "url": "<?= RUTA_JS ?>es-ES.json"
          },
          "stateSave": true,
          "lengthMenu": [20, 40, 60],
          "columnDefs": [{
              "orderable": false,
              "targets": targets
            },
            {
              "searchable": false,
              "targets": targets
            }
          ]
        });
      });
    }

    function BtnEliminar(id, idEstacion) {

      alertify.confirm('',
        function() {

          var parametros = {
            "idReporte": id
          };

          $.ajax({
            data: parametros,
            url: 'public/gerente/eliminar/eliminar-cambio-precio.php',
            type: 'post',
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {

              CambioPrecio();
              EliminarWeb(id, idEstacion);

            }
          });

        },
        function() {}).setHeader('Eliminar cambio de precio').set({
        transition: 'zoom',
        message: 'Desea eliminar el cambio de precio',
        labels: {
          ok: 'Aceptar',
          cancel: 'Cancelar'
        }
      }).show();

    }

    function EliminarWeb(id, idEstacion) {

      var parametros = {
        "idReporte": id
      };

      $.ajax({
        data: parametros,
        url: 'https://admongas.com.mx/app/api/postEliminarCambioPrecio.php',
        type: 'GET',
        beforeSend: function() {},
        complete: function() {},
        success: function(response) {

          alertify.message('El cambio de precio fue eliminado');
          CambioPrecio();
        }
      });

    }
  </script>
</head>

<body>
  <div class="LoaderPage"></div>
  <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
  </div>

  <div class="magir-top-principal p-3">


    <!-- Inicio -->
    <div class="float-end">
      <div class="dropdown dropdown-sm d-inline ms-2">
      </div>
    </div>
    <!-- Fin -->

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
        <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SASISOPA</li>
        <li aria-current="page" class="breadcrumb-item active">CAMBIO PRECIO</li>
      </ol>
    </div>
    <!-- Fin -->

    <h3>CAMBIO PRECIO</h3>

    <div class="mt-3">
      <?php

      $sql_estacion = "SELECT producto_uno, producto_dos, producto_tres FROM tb_estaciones WHERE id = '" . $Session_IDEstacion . "' ";
      $result_estacion = mysqli_query($con, $sql_estacion);
      $numero_estacion = mysqli_num_rows($result_estacion);
      while ($row_estacion = mysqli_fetch_array($result_estacion, MYSQLI_ASSOC)) {
        $gsuper = $row_estacion['producto_uno'];
        $gpremium = $row_estacion['producto_dos'];
        $gdiesel = $row_estacion['producto_tres'];
      }

      if ($gdiesel == "") {
        $disabled = "disabled";
      } else {
        $disabled = '';
      }

      ?>

      <div class="row">

        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
          <div class="bg-white border-0 p-3 rounded-0">
            <div class="fw-bold text-success">G SUPER</div>
            <input type="number" name="" class="form-control rounded-0" step='0.01' min="1" id="GSUPER">
            <hr>
            <div class="fw-bold text-danger">G PREMIUM</div>
            <input type="number" name="" class="form-control rounded-0" step='0.01' min="1" id="GPREMIUM">
            <hr>
            <div class="fw-bold">G DIESEL</div>
            <input type="number" name="" class="form-control rounded-0" step='0.01' min="1" id="GDIESEL" <?= $disabled; ?>>
            <hr>
            <div class="fw-bold text-secondary">Fecha programada</div>
            <input type="date" name="" class="form-control rounded-0" id="Fecha">
            <hr>
            <div class="fw-bold text-secondary">Hora programada</div>
            <input type="time" name="" class="form-control rounded-0" id="Hora">
            <hr>
            <button type="button" class="btn btn-primary rounded-0" onclick="BTNActualizar(<?= $Session_IDEstacion; ?>)">ACTUALIZAR PRECIO</button>

          </div>

        </div>

        <div class="col-xl-8 col-lg-8 col-md-12 col-12 mb-3">
          <div class="bg-white p-3">
            <div id="DivPrecios"></div>
          </div>
        </div>
      </div>

    </div>
  </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>

  <!---------- LIBRERIAS DEL DATATABLE ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
</body>

</html>