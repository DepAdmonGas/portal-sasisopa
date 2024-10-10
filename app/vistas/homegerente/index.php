<?php
require('app/help.php');

if ($Session_IDUsuarioBD == "") {
  header("Location:" . PORTAL . "");
}

$Diastrto = strtotime($fecha_del_dia);

if ($Session_IDUsuarioBD == 84 || $Session_IDUsuarioBD == 85 || $Session_IDUsuarioBD == 87) {
  $ocultarP = "d-none";
} else {
  $ocultarP =  "";
}

function Actividades($idEstacion, $CalenDate, $con)
{

  $Pendientes = 0;
  $Finalizadas = 0;

  $sql = "SELECT * FROM tb_calendario_actividades WHERE id_estacion = '" . $idEstacion . "' AND fecha_inicio < '" . $CalenDate . "' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    if ($row['estado']  == 0) {
      $Pendientes = $Pendientes + 1;
    } else if ($row['estado']  == 1) {
      $Finalizadas = $Finalizadas + 1;
    }
  }
  $array = array(
    'Total' => $numero,
    'Pendientes' => $Pendientes,
    'Finalizadas' => $Finalizadas
  );

  return $array;
}

function Cursos($idEstacion, $CalenDate, $con)
{
  $Resultado = 0;
  $Pendientes = 0;
  $Finalizadas = 0;

  $sql = "SELECT * FROM tb_cursos_calendario WHERE id_estacion = '" . $idEstacion . "' AND fecha_programada < '" . $CalenDate . "' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    if ($row['estado']  == 0) {
      $Pendientes = $Pendientes + 1;
    } else if ($row['estado']  == 1) {
      $Finalizadas = $Finalizadas + 1;
    }

    if ($row['resultado'] <= 59) {
      $Resultado = $Resultado + 1;
    }
  }

  $array = array(
    'Total' => $numero,
    'Pendientes' => $Pendientes,
    'Finalizadas' => $Finalizadas,
    'Resultado' => $Resultado
  );

  return $array;
}

$Actividades = Actividades($Session_IDEstacion, $fecha_del_dia, $con);
$Cursos = Cursos($Session_IDEstacion, $fecha_del_dia, $con);

$TotalPendientes = $Actividades['Pendientes'] + $Cursos['Pendientes'];

if ($TotalPendientes > 0) {
  $TotalCalendario = '<div class="float-end"><span class="badge bg-danger text-white"><small>' . $TotalPendientes . '</small></span></div>';
} else {
  $TotalCalendario = '';
}
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
  <link rel="stylesheet" href="<?= RUTA_CSS ?>bootstrap.min.css" />
  <link rel="stylesheet" href="<?= RUTA_CSS ?>navbar-utilities.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="<?= RUTA_JS ?>size-window.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?= RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <script type="text/javascript" src="<?= RUTA_JS ?>push.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function($) {
      $(".LoaderPage").fadeOut("slow");
      localStorage.clear();
      PuntosSasisopa()
    });

    function PuntosSasisopa() {
      document.getElementById("DivCalendario").style.display = "none";
      document.getElementById("DivPuntosSasisopa").style.display = "block";
      sizeWindow();
      $('#DivPuntosSasisopa').load('app/vistas/homegerente/puntos-sasisopa.php');
    }

    function BtnSasisopa(id, nombre) {

      if (id == 1) {
        window.location.href = "1-politica";
      } else if (id == 2) {
        window.location.href = "2-analisis-riesgo-evaluacion-impactos-ambientales";
      } else if (id == 3) {
        window.location.href = "3-requisitos-legales";
      } else if (id == 4) {
        window.location.href = "4-objetivos-metas-indicadores";
      } else if (id == 5) {
        window.location.href = "5-funciones-responsabilidades-autoridad";
      } else if (id == 6) {
        window.location.href = "6-competencia-personal-capacitacion-entrenamiento";
      } else if (id == 7) {
        window.location.href = "7-comunicacion-participacion-consulta";
      } else if (id == 8) {
        window.location.href = "8-control-documentos-registros";
      } else if (id == 9) {
        window.location.href = "9-mejores-practicas-estandares";
      } else if (id == 10) {
        window.location.href = "10-control-actividades-procesos";
      } else if (id == 11) {
        window.location.href = "11-integridad-mecanica-aseguramiento";
      } else if (id == 12) {
        window.location.href = "12-seguridad-contratistas";
      } else if (id == 13) {
        window.location.href = "13-preparacion-emergencias";
      } else if (id == 14) {
        window.location.href = "14-monitoreo-verificacion-evaluacion";
      } else if (id == 15) {
        window.location.href = "15-auditorias";
      } else if (id == 16) {
        window.location.href = "16-investigacion-incidentes-accidentes";
      } else if (id == 17) {
        window.location.href = "17-revision-resultados";
      } else if (id == 18) {
        window.location.href = "18-informes-desempeno";
      }

    }

    //--------------------------------------------------------------------

    function HomeCalendario(Fecha, mes, year) {
      sizeWindow();
      document.getElementById("DivPuntosSasisopa").style.display = "none";
      document.getElementById("DivCalendario").style.display = "block";
      Actividades(Fecha, 0);
      Calendario(Fecha, mes, year);
    }

    function Actividades(Fecha, opcion) {
      $('#Actividades').load('public/home/contenido-actividades.php?fecha=' + Fecha + '&opcion=' + opcion);
    }

    function Calendario(Fecha, mes, year) {
      $('#Calendario').load('public/home/contenido-calendario.php?fecha=' + Fecha + '&Mes=' + mes + '&Year=' + year);
    }

    function Comunicados() {
      window.location.href = "comunicados";
    }

    function ConsultaSasisopa() {
      sizeWindow();
      $('#ModalSasisopa').modal('show');
    }

    function ProgramaImplementacion() {
      window.location.href = "programa-implementacion";
    }

    function ReporteCRE() {
      window.location.href = "reporte-diario";
    }

    function ProgramaAnualM() {
      window.location.href = "programa-anual-mantenimiento";
    }

    function btnMisCursos() {
      window.location.href = "cursos";
    }

    function Personal() {
      window.location.href = "personal";
    }

    function CambioPrecio() {
      window.location.href = "cambio-precio";
    }

    function Nom035() {
      window.location.href = "nom-035-etapas";
    }

    function SGM() {
      window.location.href = 'sgm';
    }

    function EditarCalendario(idEstacion) {
      window.location.href = 'editar-calendario/' + idEstacion;
    }

    function modalBuscar() {
      $('#ModalBuscar').modal('show');
    }

    function BuscarRegistros(id) {

      let FechaInicio = $('#FechaInicio').val();
      let FechaTermino = $('#FechaTermino').val();

      if (FechaInicio != "") {
        $('#FechaInicio').css('border', '');
        if (FechaTermino != "") {
          $('#FechaTermino').css('border', '');

          window.location.href = "reporte-sasisopa/" + FechaInicio + '/' + FechaTermino;

        } else {
          $('#FechaTermino').css('border', '2px solid #A52525');
        }
      } else {
        $('#FechaInicio').css('border', '2px solid #A52525');
      }

    }

    function ModalCursos(idCalendario) {
      $('#ModalDetalle').modal('show');
      $('#DivDetalle').load('public/home/modal-editar-curso.php?idCalendario=' + idCalendario);
    }

    function Programar(idTema, idUsuario) {
      var FechaCurso = $('#FechaCurso').val();

      if (FechaCurso != "") {
        $('#FechaCurso').css('border', '');

        var parametros = {
          "idTema": idTema,
          "idUsuario": idUsuario,
          "FechaCurso": FechaCurso
        };

        $.ajax({
          data: parametros,
          url: 'public/sasisopa/agregar/agregar-capacitacion-interna.php',
          type: 'post',
          beforeSend: function() {},
          complete: function() {},
          success: function(response) {

            $('#ModalDetalle').modal('hide');
            alertify.success('Se programo el curso correctamente');
            Actividades(response, 1);
          }
        });

      } else {
        $('#FechaCurso').css('border', '2px solid #A52525');
      }
    }

    //--------------------------------------------------------

    function DetalleActividad(id) {

      var parametros = {
        "idCalendario": id
      };

      $.ajax({
        data: parametros,
        url: 'public/home/agregar/crear-actividad-sasisopa.php',
        type: 'post',
        beforeSend: function() {},
        complete: function() {},
        success: function(response) {
          window.location.href = response;
        }
      });

    }
  </script>
</head>

<body>

  <div class="LoaderPage"></div>

  <div class="wrapper">
    <!---------- SIDE BAR (LEFT) ---------->
    <nav id="sidebar">
      <div class="sidebar-header text-center">
        <img class="" src="<?= RUTA_IMG_LOGOS . "Logo.png"; ?>" style="width: 100%;">
      </div>

      <ul class="list-unstyled components">

        <li class="<?= $ocultarP ?>">
          <a class="pointer" href="<?= PORTAL_HOME ?>">
            <i class="fa-solid fa-house" aria-hidden="true" style="padding-right: 10px;"></i>Portal
          </a>
        </li>

        <li>
          <a class="pointer" onclick="HomeCalendario(<?= $Diastrto; ?>,<?= $fecha_mes; ?>,<?= $fecha_year; ?>)">
            <i class="fa-solid fa-calendar" aria-hidden="true" style="padding-right: 10px;"></i>Calendario
            <?= $TotalCalendario; ?>
          </a>
        </li>

        <li>
          <a class="pointer" onclick="PuntosSasisopa()">
            <i class="fa-solid fa-calendar" aria-hidden="true" style="padding-right: 10px;"></i>Elementos SASISOPA
          </a>
        </li>


        <li>
          <a class="pointer" onclick="Comunicados()">
            <i class="fa-solid fa-bell" aria-hidden="true" style="padding-right: 10px;"></i>Comunicados
          </a>
        </li>

        <li>
          <a class="pointer" onclick="ConsultaSasisopa()">
            <i class="fa-solid fa-eye" aria-hidden="true" style="padding-right: 10px;"></i>Consulta tu SASISOPA
          </a>
        </li>


        <li>
          <a class="pointer" onclick="ProgramaImplementacion()">
            <i class="fa-solid fa-file-pen" aria-hidden="true" style="padding-right: 10px;"></i>Programa de Implementación
          </a>
        </li>

        <li>
          <a class="pointer" onclick="ReporteCRE()">
            <i class="fa-solid fa-file-pen" aria-hidden="true" style="padding-right: 10px;"></i>Reporte Estadístico de la CRE
          </a>
        </li>

        <li>
          <a class="pointer" onclick="ProgramaAnualM()">
            <i class="fa-solid fa-file-pen" aria-hidden="true" style="padding-right: 10px;"></i>
            Programa Anual de Mantenimiento
          </a>
        </li>

        <li>
          <a class="pointer" onclick="btnMisCursos()">
            <i class="fa-solid fa-chalkboard-user" aria-hidden="true" style="padding-right: 10px;"></i>
            Mis Cursos
          </a>
        </li>

        <li>
          <a class="pointer" onclick="Personal()">
            <i class="fa-solid fa-people-group" aria-hidden="true" style="padding-right: 10px;"></i>
            Personal
          </a>
        </li>

        <li>
          <a class="pointer" onclick="CambioPrecio()">
            <i class="fa-solid fa-dollar-sign" aria-hidden="true" style="padding-right: 10px;"></i>
            Cambio de Precio
          </a>
        </li>
        <li>
          <a class="pointer" onclick="Nom035()">
            <i class="fa-regular fa-file-lines" aria-hidden="true" style="padding-right: 10px;"></i>
            NOM-035
          </a>
        </li>

        <li>
          <a class="pointer" onclick="SGM()">
            <i class="fa-regular fa-file-lines" aria-hidden="true" style="padding-right: 10px;"></i>
            SGM
          </a>
        </li>

      </ul>
    </nav>

    <!---------- DIV - CONTENIDO ---------->
    <div id="content">
      <!---------- NAV BAR - PRINCIPAL (TOP) ---------->
      <?php include_once "public/navbar/navbar-principal.php"; ?>

      <!---------- CONTENIDO PAGINA WEB---------->
      <div class="contendAG">
        <div class="row">

          <div class="col-12">
            <div id="DivPuntosSasisopa" class=""></div>
          </div>

          <div class="col-12">

            <div id="DivCalendario">
              <div class="row">

                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                  <div id="Actividades"></div>
                </div>

                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                  <div class="cardAG" id="Calendario"></div>
                </div>

              </div>
            </div>


          </div>
        </div>



      </div>
    </div>

  </div>


  <div class="modal fade bd-example-modal-md" id="ModalSasisopa" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">CONSULTA TU SASISOPA</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <?php
          $sql_lista = "SELECT * FROM tb_sasisopa WHERE id_estacion = '" . $Session_IDEstacion . "' ORDER BY id DESC ";
          $result_lista = mysqli_query($con, $sql_lista);
          $numero_lista = mysqli_num_rows($result_lista);
          ?>

          <table class="table table-bordered table-striped table-sm">
            <thead>
              <tr class="bg-primary text-white">
                <th class="text-center align-middle">#</th>
                <th class="text-center align-middle">Versión</th>
                <th class="text-center align-middle" width="16px"><img src="<?= RUTA_IMG_ICONOS . "pdf.png"; ?>"></th>
              </tr>
            </thead>
            <tbody>
              <?php

              if ($numero_lista > 0) {
                while ($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)) {
                  $id = $row_lista['id'];
                  echo '<tr>';
                  echo '<td class="text-center fw-bold">' . $row_lista['id'] . '</td>';
                  echo '<td class="text-center">' . $row_lista['version'] . '</td>';
                  echo '<td class="text-center align-middle"><a href="' . $row_lista['documento'] . '" download><img src="' . RUTA_IMG_ICONOS . 'pdf.png"></a></td>';
                  echo '</tr>';
                }
              } else {
                echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
              }
              ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-md" id="ModalBuscar" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">BUSCAR</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <h6>Fecha inicio:</h6>
          <input type="date" class="form-control rounded-0" id="FechaInicio">

          <h6 class="mt-2">Fecha termino:</h6>
          <input type="date" class="form-control rounded-0" id="FechaTermino">

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BuscarRegistros(<?= $Session_IDEstacion; ?>)">Buscar</button>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-md" id="ModalDetalle" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div id="DivDetalle"></div>
      </div>
    </div>
  </div>

  <!---------- FUNCIONES - NAVBAR ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="<?= RUTA_JS ?>navbar-functions.js"></script>
  <script src="<?= RUTA_JS ?>bootstrap.min.js"></script>

</body>

</html>