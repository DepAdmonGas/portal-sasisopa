<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD, 'programa-anual-mantenimiento');
$id_ayuda = $array_ayuda['id'];
$estado = $array_ayuda['estado'];

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
      <?php if ($id_ayuda != 0) {
        echo "btnAyuda();";
      } ?>
      ListaProgramaAnual();
    });

    function regresarP() {
      window.history.back();
    }

    function btnAyuda() {
      $('#myModalProgramaAnual').modal('show');
    }

    function btnFinAyuda(idayuda, estado) {

      var parametros = {
        "accion": "actualizar-ayuda",
        "idayuda": idayuda
      };

      if (idayuda != 0 && estado == 0) {
        $.ajax({
          data: parametros,
          url: 'app/controlador/AyudaControlador.php',
          type: 'post',
          beforeSend: function() {},
          complete: function() {},
          success: function(response) {
            $('#myModalProgramaAnual').modal('hide');
            ProgramaNew(<?= $fecha_year; ?>)
          }
        });

      } else {
        $('#myModalProgramaAnual').modal('hide');
        ProgramaNew(<?= $fecha_year; ?>)
      }

    }

    function ListaProgramaAnual() {
      $('#DivListaPrograma').load('app/vistas/sasisopa/elemento10/lista-year-programa-anual-mantenimiento.php?idEstacion=<?= $Session_IDEstacion; ?>');
    }

    function ProgramaNew(id) {

      var parametros = {
        "accion": "agregar-programa-anual",
        "idestacion": <?= $Session_IDEstacion; ?>,
        "fecha": id
      };

      $.ajax({
        data: parametros,
        url: 'app/controlador/ControlActividadProcesoControlador.php',
        type: 'post',
        beforeSend: function() {},
        complete: function() {},
        success: function(response) {
          window.location.href = "programa-anual-mantenimiento/" + response;
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
        <button type="button" class="btn dropdown-toggle btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-screwdriver-wrench"></i></span>
        </button>
        <ul class="dropdown-menu">
          <li onclick="btnAyuda()"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-circle-info"></i> Ayuda</a></li>
          <li onclick="ProgramaNew(<?= $fecha_year; ?>)"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-plus"></i> Agregar</a></li>
        </ul>
      </div>
    </div>
    <!-- Fin -->

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
        <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-chevron-left"></i> SASISOPA</li>
        <li aria-current="page" class="breadcrumb-item active text-secondary">PROGRAMA ANUAL DE MANTENIMIENTO</li>
      </ol>
    </div>
    <!-- Fin -->

    <h3>PROGRAMA ANUAL DE MANTENIMIENTO </h3>
    <div class="mt-3">
      <div id="DivListaPrograma"></div>
    </div>

  </div>

  <div class="modal fade bd-example-modal-lg" id="myModalProgramaAnual" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Configuración inicial del Programa anual de mantenimiento</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Al dar clic en Aceptar para acceder a tu programa anual de mantenimiento, da clic en el icono de <img width="16px" src="<?php echo RUTA_IMG_ICONOS . "agregar.png"; ?>"> y selecciona de la lista desplegable el equipo o instalación (Periodicidad se dará por default). Selecciona la última fecha en la cual diste mantenimiento al equipo o instalación, da clic en aceptar.</br>
            En caso de cometer error ubica el equipo o instalación y da clic en el botón editar o en su defecto eliminar.
          </p>
          <p class="text-secondary" style="font-size: .8em;">
            Nota: De la lista desplegable selecciona solo aquellas actividades que correspondan a tu estación.
          </p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?= $id_ayuda; ?>,<?= $estado; ?>)">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>

</html>