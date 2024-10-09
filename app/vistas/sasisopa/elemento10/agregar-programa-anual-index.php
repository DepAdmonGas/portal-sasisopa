<?php
require('app/help.php');
include_once "app/modelo/ControlActividadProceso.php";

$class_control_actividad_proceso = new ControlActividadProceso();
$ProgramaYear = $class_control_actividad_proceso->yearProgramaAnual($idReporte);

?>
<html lang="es">

<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <!---------- LIBRERIAS DEL DATATABLE ---------->
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
  <script src="<?php echo RUTA_JS ?>printThis.js"></script>
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
      Programaanual(<?= $idReporte; ?>);
    });

    function regresarP() {
      window.history.back();
    }

    function Programaanual(idReporte) {
      let targets;
      targets = [1,2,3,4,5,6,7,8,9,10,11,12,13,14];
      $('#DivProgramanual').load('../app/vistas/sasisopa/elemento10/lista-programa-anual-mantenimiento.php?idReporte=' + idReporte, function() {
        $('#programa-mantenimiento').DataTable({
          "stateSave": true,
          "language": {
            "url": '<?= RUTA_JS ?>' + "/es-ES.json"
          },
          "order": [[0, "desc"]],
          "lengthMenu": [15, 30, 50, 100],
          "columnDefs": [
            { "orderable": false, "targets": targets },
            { "searchable": false, "targets": targets }
          ]
        });
      });
    }


    function BtnAgregar() {
      $('#ModalAgregar').modal('show');
      AgregarModal();
    }

    function AgregarModal() {
      $('#ModalContenido').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;' />");
      $('#ModalContenido').load('../app/vistas/sasisopa/elemento10/modal-agregar-mantenimiento.php?idReporte=<?= $idReporte; ?>&Year=<?= $ProgramaYear; ?>');
    }

    function SelectEquipo(id) {

      var idselect = id.value;

      if (idselect == 43) {

        $("#Periodicidad").prop('disabled', false);
        $("#UltimaFecha").prop('disabled', false);
      } else {

        $("#Periodicidad").prop('disabled', true);

        var parametros = {
          "accion": "buscar-periodicidad",
          "idselect": idselect
        };

        $.ajax({
          data: parametros,
          url: '../app/controlador/ControlActividadProcesoControlador.php',
          type: 'post',
          beforeSend: function() {},
          complete: function() {},
          success: function(response) {
            $("#Periodicidad").val(response);
          }
        });

        $("#UltimaFecha").prop('disabled', false);
      }
    }

    function BtnAgregarPrograma() {

      var Selectequipo = $('#Selectequipo').val();
      var Periodicidad = $('#Periodicidad').val();
      var UltimaFecha = $('#UltimaFecha').val();

      if (Selectequipo != "") {
        $('#Selectequipo').css('border', '');
        if (Periodicidad != "") {
          $('#Periodicidad').css('border', '')
          if (UltimaFecha != "") {
            $('#UltimaFecha').css('border', '');

            var parametros = {
              "accion": "agregar-equipo-instalacion",
              "idreporte": <?= $idReporte; ?>,
              "id": Selectequipo,
              "fecha": UltimaFecha,
              "select": Periodicidad

            };

            $.ajax({
              data: parametros,
              url: '../app/controlador/ControlActividadProcesoControlador.php',
              type: 'post',
              beforeSend: function() {},
              complete: function() {},
              success: function(response) {

                console.log(response)
                alertify.message('Se agrego correctamente el mantenimiento');
                Programaanual();
                $('#ModalAgregar').modal('hide');
              }
            });

          } else {
            $('#UltimaFecha').css('border', '2px solid #A52525');
          }
        } else {
          $('#Periodicidad').css('border', '2px solid #A52525');
        }
      } else {
        $('#Selectequipo').css('border', '2px solid #A52525');
      }

    }

    function EliminarM(id) {

      var parametros = {
        "accion": "eliminar-equipo-instalacion",
        "id": id
      };

      alertify.confirm('',
        function() {

          $.ajax({
            data: parametros,
            url: '../app/controlador/ControlActividadProcesoControlador.php',
            type: 'post',
            beforeSend: function() {

            },
            complete: function() {


            },
            success: function(response) {

              alertify.message('Se eliminó correctamente el mantenimiento');
              Programaanual();

            }
          });

        },
        function() {}).setHeader('Mensaje').set({
        transition: 'zoom',
        message: 'Desea editar el programa anual de mantenimiento',
        labels: {
          ok: 'Aceptar',
          cancel: 'Cancelar'
        }
      }).show();

    }

    function EditarM(id) {
      $('#ModalEditar').modal('show');
      EditarModal(id);
    }

    function EditarModal(id) {
      $('#ModalEditarContenido').load('../app/vistas/sasisopa/elemento10/modal-editar-mantenimiento.php?idReporte=' + id);
    }

    function BtnEditarPrograma(id) {

      var Enero = $('#Enero').val();
      var Febrero = $('#Febrero').val();
      var Marzo = $('#Marzo').val();
      var Abril = $('#Abril').val();
      var Mayo = $('#Mayo').val();
      var Junio = $('#Junio').val();
      var Julio = $('#Julio').val();
      var Agosto = $('#Agosto').val();
      var Septiembre = $('#Septiembre').val();
      var Octubre = $('#Octubre').val();
      var Noviembre = $('#Noviembre').val();
      var Diciembre = $('#Diciembre').val();

      var parametros = {
        "accion": "editar-equipo-instalacion",
        "id": id,
        "Enero": Enero,
        "Febrero": Febrero,
        "Marzo": Marzo,
        "Abril": Abril,
        "Mayo": Mayo,
        "Junio": Junio,
        "Julio": Julio,
        "Agosto": Agosto,
        "Septiembre": Septiembre,
        "Octubre": Octubre,
        "Noviembre": Noviembre,
        "Diciembre": Diciembre
      };

      alertify.confirm('',
        function() {

          $.ajax({
            data: parametros,
            url: '../app/controlador/ControlActividadProcesoControlador.php',
            type: 'post',
            beforeSend: function() {

            },
            complete: function() {

            },
            success: function(response) {

              alertify.message('Se edito correctamente el mantenimiento');
              Programaanual();
              $('#ModalEditar').modal('hide');

            }
          });

        },
        function() {}).setHeader('Mensaje').set({
        transition: 'zoom',
        message: 'Desea editar el programa anual de mantenimiento',
        labels: {
          ok: 'Aceptar',
          cancel: 'Cancelar'
        }
      }).show();

    }

    function Descargar(id) {
      window.location = "../descargar-programa-anual-mantenimiento/" + id;
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
          <li onclick="BtnAgregar()"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-plus"></i> Agregar</a></li>
          <li onclick="Descargar(<?= $idReporte; ?>)"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-file-pdf"></i></i> Descargar PDF</a></li>
        </ul>
      </div>
    </div>
    <!-- Fin -->

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
        <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-chevron-left"></i> PROGRAMA ANUAL DE MANTENIMIENTO</li>
        <li aria-current="page" class="breadcrumb-item active text-secondary">DETALLE ANUAL DE MANTENIMIENTO</li>
      </ol>
    </div>
    <!-- Fin -->

    <h3>DETALLE ANUAL DE MANTENIMIENTO </h3>

    <div class="bg-white mt-3 p-3">
      <div id="DivProgramanual"></div>
    </div>

  </div>

  <div class="modal fade bd-example-modal-lg" id="ModalAgregar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Agregar equipo o instalación</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div id="ModalContenido"></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnAgregarPrograma()">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="ModalEditar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div id="ModalEditarContenido"></div>
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