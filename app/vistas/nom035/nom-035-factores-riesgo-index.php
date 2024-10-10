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
  <style media="screen">
    .LoaderPage {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: white;
      background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255, 255, 255);
    }

    .hovercolor:hover {
      background: rgba(0, 120, 238, .8) !important;
    }

    .cont-puntos {
      border-bottom: 3px solid #3399cc;
      box-shadow: 1px 1px 5px #EDEDED;
    }

    .titulo-punto {
      font-size: 1.25em;
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
      $(".LoaderPage").fadeOut("slow");

    });

    function regresarP(id) {
      window.history.back();
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
        <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-chevron-left"></i>NOM-035</li>
        <li aria-current="page" class="breadcrumb-item active">NOM-035 (FACTORES DE RIESGO PSICOSOCIAL)</li>
      </ol>
    </div>
    <!-- Fin -->

    <h3>NOM-035 (FACTORES DE RIESGO PSICOSOCIAL)</h3>




    <div class="card">
      <div class="card-body">

        <div class="row">


          <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mb-3 ">

            <div class="border p-3" style="font-size: 1.2em">

              <b>¿Qué son los factores de riesgo psicosocial?</b></br>

              Aquellos que pueden provocar trastornos de ansiedad, no orgánicos del ciclo sueño-vigilia y de estrés grave y de adaptación, derivado de la naturaleza de las funciones del puesto de trabajo, el tipo de jornada de trabajo y la exposición a acontecimientos traumáticos severos o a actos de violencia laboral al trabajador, por el trabajo desarrollado.
              <div class="border-top mt-2 mb-2"></div>

              <ul>
                <li>Condiciones peligrosas e inseguras en el ambiente de trabajo</li>
                <li>Cargas de trabajo cuando exceden la capacidad del trabajador</li>
                <li>Falta de control sobre el trabajo (posibilidad de influir en la organización y desarrollo del trabajo cuando el proceso lo permite)</li>
                <li>Jornadas de trabajo superiores a las previstas en la Ley Federal del Trabajo</li>
                <li>Rotación de turnos sin períodos de recuperación y descanso</li>
                <li>Interferencia en la relación trabajo-familia</li>
                <li>Liderazgo negativo</li>
                <li>Relaciones negativas en el trabajo</li>
              </ul>

              <b>IMPORTANTE</b></br>

              Recuerda que el cuestionario debe ser respondido por cada uno de los empleados del centro de trabajo.</br>

              <u>Se deben responder todas las preguntas del cuestionario, sin dejar alguna sin contestar.</u></br></br>

              <p class="font-weight-light">De la pregunta 1 a la 43 responde todo el personal, preguntas 44, 45 y 46 únicamente responden los encargados, gerentes o jefes de turno.*</p>

            </div>
            <?php
            $sql_a_c = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Factores-riesgo-psicosocial' AND nom_archivo = 'guia-ii' ORDER BY id desc LIMIT 1";
            $result_a_c = mysqli_query($con, $sql_a_c);
            $numero_a_c = mysqli_num_rows($result_a_c);
            if ($numero_a_c > 0) {
              while ($row_a_c = mysqli_fetch_array($result_a_c, MYSQLI_ASSOC)) {
                $acontecimiento_c = $row_a_c['archivo'];
                $imgcuestionario = '<a target="_BLANK" href="' . $acontecimiento_c . '"><img src="' . RUTA_IMG_ICONOS . 'pdf.png"></a>';
              }
            } else {
              $imgcuestionario = '<img src="' . RUTA_IMG_ICONOS . 'sin-archivo.png">';
            }

            $sql_a_ts = "SELECT * FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Factores-riesgo-psicosocial' AND nom_archivo = 'formato-a-c' ORDER BY id desc LIMIT 1";
            $result_a_ts = mysqli_query($con, $sql_a_ts);
            $numero_a_ts = mysqli_num_rows($result_a_ts);
            if ($numero_a_ts > 0) {
              while ($row_a_ts = mysqli_fetch_array($result_a_ts, MYSQLI_ASSOC)) {
                $acontecimiento_ts = $row_a_ts['archivo'];
                $imgtriptico = '<a target="_BLANK" href="' . $acontecimiento_ts . '"><img src="' . RUTA_IMG_ICONOS . 'pdf.png"></a>';
              }
            } else {
              $imgtriptico = '<img src="' . RUTA_IMG_ICONOS . 'sin-archivo.png">';
            }
            ?>
          </div>


          <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 ">

            <table class="table table-bordered table-striped table-sm">
              <tr>
                <td class="align-middle"><b>Guía II</b></td>
                <td class="align-middle text-center" width="24" id="td31"><?= $imgcuestionario; ?></td>
              </tr>
              <tr>
                <td class="align-middle"><b>Formato Acuerdo de conformidad</b></td>
                <td class="align-middle text-center" width="24" id="td32"><?= $imgtriptico; ?></td>
              </tr>
            </table>



          </div>
        </div>


      </div>
    </div>

  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>

</html>