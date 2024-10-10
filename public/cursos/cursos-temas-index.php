<?php
require('app/help.php');

$sql_modulos_cursos = "SELECT titulo FROM tb_cursos_modulos WHERE id = '" . $GET_idModulo . "' ";
$result_modulos_cursos = mysqli_query($con, $sql_modulos_cursos);
$numero_modulos_cursos  = mysqli_num_rows($result_modulos_cursos);
while ($row_modulos_cursos = mysqli_fetch_array($result_modulos_cursos, MYSQLI_ASSOC)) {
  $titulo = $row_modulos_cursos['titulo'];
}


$sql = "SELECT * FROM tb_cursos_temas WHERE id_modulo = '" . $GET_idModulo . "' ORDER BY num_tema ASC";
$result = mysqli_query($con, $sql);
$numero  = mysqli_num_rows($result);


function DetalleTemas($idUsuario, $id, $con)
{

  $Pendientes = 0;

  $sql = "SELECT * FROM tb_cursos_calendario WHERE id_personal = '" . $idUsuario . "' AND id_tema = '" . $id . "' ";
  $result = mysqli_query($con, $sql);
  $numero  = mysqli_num_rows($result);
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    if ($row['estado'] == 0) {
      $Pendientes = $Pendientes + 1;
    }
  }

  if ($Pendientes == 1) {
    $Titulo = 'pendiente';
  } else {
    $Titulo = 'pendientes';
  }

  if ($Pendientes > 0) {
    $Color = 'text-danger';
  } else {
    $Color = 'text-secondary';
  }

  return '<small class="' . $Color . '">' . $numero . ' cursos / ' . $Pendientes . ' ' . $Titulo . '</small>';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS?>bootstrap.min.css" rel="stylesheet" />
  <link href="<?=RUTA_CSS?>navbar-general.min.css" rel="stylesheet" />
  <link href="<?=RUTA_CSS?>cards-utilities.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
 

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<script type="text/javascript">
  $(document).ready(function($) {
    $(".LoaderPage").fadeOut("slow");

  });

  function Regresar() {
    window.history.back();
  }

  function detalleTema(id) {
    $('#ModalDetalle').modal('show');
    $('#DivDetalle').load('../public/cursos/vistas/modal-detalle-temas.php?id=' + id);
  }
</script>

<body>
  <div class="LoaderPage"></div>

  <!---------- CONTENIDO DE PAGINA WEB ---------->
  <div id="content">

    <!---------- NAV BAR (TOP) ---------->
    <?php require('public/navbar/navbar-perfil.php'); ?>

    <div class="contendAG">


      <!-- Inicio -->
      <div class="float-end">
        <div class="dropdown dropdown-sm d-inline ms-2">
        </div>
      </div>
      <!-- Fin -->

      <!-- Inicio -->
      <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
        <ol class="breadcrumb breadcrumb-caret">
          <li class="breadcrumb-item text-primary pointer" onclick="history.back()"><i class="fa-solid fa-chevron-left"></i> CURSOS</li>
          <li aria-current="page" class="breadcrumb-item active">MODULO <?= $GET_idModulo ?> - <?= $titulo ?></li>
        </ol>
      </div>
      <!-- Fin -->

      <h3>MODULO <?= $GET_idModulo ?> - <?= $titulo ?></h3>


      <div class="row">

        <div class="col-12 mb-2">
          <div class="cardAG border-0 p-3">

            <?php
            echo '<div class="row">';
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

              $DetalleTemas = DetalleTemas($Session_IDUsuarioBD, $row['id'], $con);

              echo '<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-1 mb-2">
          <div class="card card-menuB rounded shadow-sm p-3 mb-2">

          <div class="icon bg-icon"> 
          <a class="color-disabled" style="font-weight: bold;">' . $row['num_tema'] . '</a> 
          </div>

          <div class="text-center mt-2"><h5>' . $row['titulo'] . '</h5></div>
          <div class="text-center"><img class="img-logo mt-2" src="' . RUTA_IMG_ICONOS . 'prueba.png" style="width: 20%;"></div>
          <div class="text-center mt-2">' . $DetalleTemas . '</div>
          <div class="text-end mt-3"><button class="btn btn-sm btn-primary" type="button" onclick="detalleTema(' . $row['id'] . ')">Ver detalle</button></div>

          </div>
          </div>';
            }
            echo '</div>';
            ?>


          </div>
        </div>

      </div>
    </div>

  </div>

  <div class="modal fade bd-example-modal-lg" id="ModalDetalle" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div id="DivDetalle"></div>
      </div>
    </div>
  </div>

  <!---------- FUNCIONES - NAVBAR ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>


  <script src="<?= RUTA_JS ?>bootstrap.min.js"></script>


</body>

</html>