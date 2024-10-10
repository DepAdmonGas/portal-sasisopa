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

    function BTNarchivo(numarchivo) {

      var ArchivoPdf;
      var ArchivoPdf_file;
      var ArchivoPdf_filePath;
      var ext;
      var idfile;

      var data = new FormData();
      var url = 'app/vistas/nom035/agregar-archivo-nom035-cuestionario.php';

      if (numarchivo == 8) {

        ArchivoPdf = document.getElementById("RCuestionario");
        ArchivoPdf_file = ArchivoPdf.files[0];
        ArchivoPdf_filePath = ArchivoPdf.value;
        ext = $("#RCuestionario").val().split('.').pop();
        idfile = "RCuestionario";

      }

      if (ArchivoPdf_filePath != "") {
        $('#' + idfile).css('border', '');
        if (ext == "PDF" || ext == "pdf") {

          data.append('idEstacion', <?= $Session_IDEstacion; ?>);
          data.append('numarchivo', numarchivo);
          data.append('ArchivoPdf_file', ArchivoPdf_file);

          $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false
          }).done(function(data) {

            $('#td3' + numarchivo).html('<a target="_BLANK" href="' + data + '"><img src="<?= RUTA_IMG_ICONOS; ?>pdf.png"></a>');
            $("#" + idfile).val(null);

          });

        } else {
          $('#' + idfile).css('border', '2px solid #A52525');
        }
      } else {
        $('#' + idfile).css('border', '2px solid #A52525');
      }

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
        <li aria-current="page" class="breadcrumb-item active">NOM-035 (ACONTECIMIENTOS TRAUMÁTICOS SEVEROS)</li>
      </ol>
    </div>
    <!-- Fin -->

    <h3>NOM-035 (ACONTECIMIENTOS TRAUMÁTICOS SEVEROS)</h3>

    <div class="card ">

      <div class="card-body">

        <?php
        $sql_a_c = "SELECT archivo FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Acontecimientos-t-s' AND nom_archivo = 'acontecimientos-cuestionario' ORDER BY id desc LIMIT 1";
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

        $sql_a_ts = "SELECT archivo FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Acontecimientos-t-s' AND nom_archivo = 'acontecimientos-triptico' ORDER BY id desc LIMIT 1";
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

        $sql_aa = "SELECT archivo FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Acontecimientos-t-s' AND nom_archivo = 'acontecimientos-acuerdo' ORDER BY id desc LIMIT 1";
        $result_aa = mysqli_query($con, $sql_aa);
        $numero_aa = mysqli_num_rows($result_aa);
        if ($numero_aa > 0) {
          while ($row_aa = mysqli_fetch_array($result_aa, MYSQLI_ASSOC)) {
            $acontecimientoa = $row_aa['archivo'];
            $imgacuerdo = '<a target="_BLANK" href="' . $acontecimientoa . '"><img src="' . RUTA_IMG_ICONOS . 'pdf.png"></a>';
          }
        } else {
          $imgacuerdo = '<img src="' . RUTA_IMG_ICONOS . 'sin-archivo.png">';
        }

        $sql_rc = "SELECT archivo FROM tb_nom_035_archivos WHERE id_estacion = '" . $Session_IDEstacion . "' AND categoria = 'Acontecimientos-t-s' AND nom_archivo = 'acontecimientos-resultado-cuestionario' ORDER BY id desc LIMIT 1";
        $result_rc = mysqli_query($con, $sql_rc);
        $numero_rc = mysqli_num_rows($result_rc);
        if ($numero_rc > 0) {
          while ($row_rc = mysqli_fetch_array($result_rc, MYSQLI_ASSOC)) {
            $acontecimientorc = $row_rc['archivo'];
            $imgresultadocuestionario = '<a target="_BLANK" href="' . $acontecimientorc . '"><img src="' . RUTA_IMG_ICONOS . 'pdf.png"></a>';
          }
        } else {
          $imgresultadocuestionario = '<img src="' . RUTA_IMG_ICONOS . 'sin-archivo.png">';
        }


        ?>

        <div class="row">

          <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mb-3">

            <div class="border p-3" style="font-size: 1.2em">
              <b>¿Qué son los acontecimientos traumáticos severos?</b></br>
              Son aquellos sucesos que se presentan de manera repentina y que, por su gravedad pueden ocasionar daños a las instalaciones o al personal.
              <div class="border-top mt-2 mb-2"></div>

              <b>¿Cuándo se debe aplicar la Guía I?</b></br>

              Al menos un mes después de que ocurra un acontecimiento traumático severo
              <div class="border-top mt-2 mb-2"></div>
              <b>¿A quién se aplica la Guía I?</b></br>

              Se aplica a los trabajadores involucrados en el acontecimiento
              <div class="border-top mt-2 mb-2"></div>
              </br>
              <b>IMPORTANTE</b>
              </br>
              Ten en cuenta que cada pregunta habla de los efectos de los eventos traumáticos severos ocurridos en tus actividades laborales.
            </div>
          </div>


          <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">

            <div style="overflow-y: hidden;">

              <table class="table table-bordered table-striped table-sm">
                <tr>
                  <td class="align-middle"><b>Guía I. Cuestionario para identificar a los trabajadores que fueron sujetos a acontecimientos traumáticos severos (II.1)</b></td>
                  <td class="align-middle text-center" width="24" id="td31"><?= $imgcuestionario; ?></td>
                </tr>
                <tr>
                  <td class="align-middle"><b>Tríptico Acontecimientos traumáticos severos</b></td>
                  <td class="align-middle text-center" width="24" id="td32"><?= $imgtriptico; ?></td>
                </tr>
                <tr>
                  <td class="align-middle"><b>Formato Acuerdo de conformidad</b></td>
                  <td class="align-middle text-center" width="24" id="td33"><?= $imgacuerdo; ?></td>
                </tr>
              </table>
            </div>





            <div class="text-center mb-3">
              <hr>
              <small>¡Nota! Escanea los resultados de los cuestionarios y guárdalo para su descarga.</small>
            </div>

            <div style="overflow-y: hidden;">
              <table class="table table-bordered table-striped table-sm">
                <tr>
                  <td class="align-middle text-center"><b>Resultado de los cuestionarios</b></td>
                  <td>
                    <div class="form-inline">

                      <div class="form-group">

                        <div class="row">

                          <div class="col-12 mt-3 mb-3" align="center">
                            <input type="file" style="font-size: .8em;" id="RCuestionario">
                          </div>
                        </div>

                        <div class="col-12" align="center">
                          <button type="submit" class="btn btn-secondary btn-sm rounded-0" onclick="BTNarchivo(8)">Agregar PDF</button>
                        </div>

                      </div>


                    </div>
                  </td>
                  <td class="align-middle text-center" width="24" id="td38"><?= $imgresultadocuestionario; ?></td>
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