<?php
require('app/help.php');

$sql_reportecre = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '" . $Session_IDEstacion . "' and mes = '" . $idMes . "' and year = '" . $idYear . "' ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);
$row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC);
$idReporteCre = $row_reportecre['id'];
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
      ListaReporteEstadistico();
    });

    function regresarP() {
      window.location.href = '<?= RUTA_REPORTE_DIARIO . "/" . $idYear ?>';
    }

    function ListaReporteEstadistico() {
      $('#DivReporteEstadistico').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
      $('#DivReporteEstadistico').load('../../public/gerente/vistas/lista-reporte-estadistico.php?idMes=<?= $idMes; ?>&idYear=<?= $idYear; ?>');
    }

    function Agregar() {
      window.location.href = '<?= RUTA_NEW_REPORTE_DIARIO; ?>/<?= $idReporteCre; ?>';
    }
  </script>
</head>

<body>

  <div class="LoaderPage"></div>
  <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
  </div>

  <div class="magir-top-principal p-3">

    <div class="float-end">
      <div class="dropdown dropdown-sm d-inline ms-2">
        <button type="button" class="btn dropdown-toggle btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-screwdriver-wrench"></i></span>
        </button>
        <ul class="dropdown-menu">
          <li onclick="Agregar()"><a class="dropdown-item c-pointer"> <i class="fa-regular fa-plus"></i> Agregar</a></li>
          <li><a href="../../public/gerente/vistas/descargar-reporte-estadistico-diario.php?idMes=<?= $idMes; ?>&idYear=<?= $idYear; ?>" class="dropdown-item c-pointer"> <i class="fa-solid fa-file-pdf"></i> Descargar</a></li>
        </ul>
      </div>
    </div>
    <!-- Fin -->

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
        <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-chevron-left"></i> REPORTE ESTADISTICO DE LA CRE <?= $idYear ?></li>
        <li aria-current="page" class="breadcrumb-item active">Reporte Diario <?php echo nombremes($idMes) . " " . $idYear; ?></li>
      </ol>
    </div>
    <!-- Fin -->
    <h3>Reporte Diario <?php echo nombremes($idMes) . " " . $idYear; ?></h3>

    <div class="mt-2 p-3 bg-white">
      <div id="DivReporteEstadistico"></div>
    </div>

  </div>

  <div class="modal fade bd-example-modal-lg" id="ModalPDF" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h5 class="modal-title">Agregar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <div class="row no-gutters">
              <div class="col-12">
                <input class="form-control input-style" type="text" id="Nombres" style="border-radius: 0px;" placeholder="Nombre Completo">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row no-gutters">
              <div class="col-6">
                <input class="form-control input-style" type="text" id="Telefono" style="border-radius: 0px;" placeholder="Telefono">
              </div>
              <div class="col-6">
                <input class="form-control input-style" type="email" id="Email" style="border-radius: 0px;" placeholder="Correo electronico">
              </div>
            </div>
          </div>

          <div class="form-group">
            <select class="form-control" id="Puesto" placeholder="Puesto" style="border-radius: 0px;">
              <option value="">Puesto</option>
              <?php
              $sql_puesto = "SELECT * FROM tb_puestos WHERE tipo_puesto <> 'Administrador' and tipo_puesto <> 'Gerente' and tipo_puesto <> 'Sistemas' and tipo_puesto <> 'Dirección' and tipo_puesto <> 'Comercializadora' and tipo_puesto <> 'Gestoria' and tipo_puesto <> 'Mantenimiento'";
              $result_puesto = mysqli_query($con, $sql_puesto);
              $numero_puesto = mysqli_num_rows($result_puesto);
              while ($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)) {
                echo "<option value='" . $row_puesto['id'] . "'>" . $row_puesto['tipo_puesto'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <div class="row no-gutters">
              <div class="col-11">
                <input class="form-control input-style" type="text" id="NomUsuario" placeholder="Usuario" style="border-radius: 0px;">
              </div>
              <div class="col-1">
                <div class="text-center" style="margin-top: 5px;">
                  <a onclick="UsuarioAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Usuario Aleatorio">
                    <img src="<?php echo RUTA_IMG_ICONOS . "aleatorio.png"; ?>">
                  </a>
                </div>
              </div>
            </div>
          </div>


          <div class="row no-gutters">
            <div class="col-5">
              <input class="form-control input-style" type="text" id="PasswordOriginal" style="border-radius: 0px;" placeholder="Contraseña">
            </div>
            <div class="col-2">
              <div class="text-center" style="margin-top: 15px;">
                <a onclick="PasswordAleatorio()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Contraseña Aleatoria">
                  <img src="<?php echo RUTA_IMG_ICONOS . "aleatorio.png"; ?>">
                </a>
              </div>
            </div>
            <div class="col-5">
              <input class="form-control input-style" type="password" id="PasswordCopia" style="border-radius: 0px;" placeholder="Repetir contraseña">
            </div>
          </div>
          <div class="" id="Result"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAgregarPersonal()">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>

</html>