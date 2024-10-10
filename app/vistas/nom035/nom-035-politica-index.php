<?php
require('app/help.php');

$sql_estaciones = "SELECT politica FROM tb_nom_035_politica WHERE id_estacion = '" . $Session_IDEstacion . "' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
$row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC);
$politica = $row_estaciones['politica'];

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
        <li aria-current="page" class="breadcrumb-item active">NOM-035 (POLÍTICA)</li>
      </ol>
    </div>
    <!-- Fin -->

    <h3>NOM-035 (POLÍTICA)</h3>

    <div class="card rounded-0 card-body">


      <?php

      $sql_pac = "SELECT archivo FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Politica' AND nom_archivo = 'politica-cuerpo' ORDER BY id desc LIMIT 1";
      $result_pac = mysqli_query($con, $sql_pac);
      $numero_pac = mysqli_num_rows($result_pac);
      if ($numero_pac > 0) {
        while ($row_pac = mysqli_fetch_array($result_pac, MYSQLI_ASSOC)) {
          $pac = $row_pac['archivo'];
          $imgcuerpo = '<a target="_BLANK" href="' . $pac . '"><img src="' . RUTA_IMG_ICONOS . 'pdf.png"></a>';
        }
      } else {
        $imgcuerpo = '<img src="' . RUTA_IMG_ICONOS . 'sin-archivo.png">';
      }

      $sql_pa = "SELECT archivo FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Politica' AND nom_archivo = 'politica-archivo' ORDER BY id desc LIMIT 1";
      $result_pa = mysqli_query($con, $sql_pa);
      $numero_pa = mysqli_num_rows($result_pa);
      if ($numero_pa > 0) {
        while ($row_pa = mysqli_fetch_array($result_pa, MYSQLI_ASSOC)) {
          $pa = $row_pa['archivo'];
          $imgpolitica = '<a target="_BLANK" href="' . $pa . '"><img src="' . RUTA_IMG_ICONOS . 'pdf.png"></a>';
        }
      } else {
        $imgpolitica = '<img src="' . RUTA_IMG_ICONOS . 'sin-archivo.png">';
      }

      $sql_pat = "SELECT archivo FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Politica' AND nom_archivo = 'politica-triptico' ORDER BY id desc LIMIT 1";
      $result_pat = mysqli_query($con, $sql_pat);
      $numero_pat = mysqli_num_rows($result_pat);
      if ($numero_pat > 0) {
        while ($row_pat = mysqli_fetch_array($result_pat, MYSQLI_ASSOC)) {
          $pat = $row_pat['archivo'];
          $imgtriptico = '<a target="_BLANK" href="' . $pat . '"><img src="' . RUTA_IMG_ICONOS . 'pdf.png"></a>';
        }
      } else {
        $imgtriptico = '<img src="' . RUTA_IMG_ICONOS . 'sin-archivo.png">';
      }

      $sql_pacta = "SELECT archivo FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Politica' AND nom_archivo = 'politica-acta' ORDER BY id desc LIMIT 1";
      $result_pacta = mysqli_query($con, $sql_pacta);
      $numero_pacta = mysqli_num_rows($result_pacta);
      if ($numero_pacta > 0) {
        while ($row_pacta = mysqli_fetch_array($result_pacta, MYSQLI_ASSOC)) {
          $pacta = $row_pacta['archivo'];
          $imgacta = '<a target="_BLANK" href="' . $pacta . '"><img src="' . RUTA_IMG_ICONOS . 'pdf.png"></a>';
        }
      } else {
        $imgacta = '<img src="' . RUTA_IMG_ICONOS . 'sin-archivo.png">';
      }


      ?>


      <div class="row">

        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mb-3 ">
          <div class="border p-3" style="font-size: 1.2em">

            <?= $politica; ?>

          </div>
        </div>


        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

          <table class="table table-bordered table-striped table-sm">
            <tr>
              <td class="align-middle"><b>Nom-035</b></td>
              <td class="align-middle text-center" width="24" id="td31"><?= $imgcuerpo; ?></td>
            </tr>
            <tr>
              <td class="align-middle"><b>Política</b></td>
              <td class="align-middle text-center" width="24" id="td32"><?= $imgpolitica; ?></td>
            </tr>
            <tr>
              <td class="align-middle"><b>Triptico</b></td>
              <td class="align-middle text-center" width="24" id="td33"><?= $imgtriptico; ?></td>
            </tr>
            <tr>
              <td class="align-middle"><b>Acta</b></td>
              <td class="align-middle text-center" width="24" id="td34"><?= $imgacta; ?></td>
            </tr>
          </table>

        </div>
      </div>

    </div>

  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>

</html>