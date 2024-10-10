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
      window.location.href = '../reporte-diario';
    }

    function ListaReporteEstadistico() {
      $('#DivReporteEstadistico').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
      $('#DivReporteEstadistico').load('../public/gerente/vistas/lista-reporte-estadistico-mes.php?idYear=<?= $idYear; ?>');
    }

    function facturasPDF() {
      window.location.href = '../facturas-reporte-diario/<?= $idYear; ?>';
    }

    function ListaAnual(year) {
      window.location.href = "<?= RUTA_REPORTE_DIARIO ?>/" + year;
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
          <li onclick="facturasPDF()"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-file-invoice"></i> Facturas</a></li>
        </ul>
      </div>
    </div>
    <!-- Fin -->

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
        <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-2)"><i class="fa-solid fa-house"></i> SASISOPA</li>
        <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP()"><?= $idYear ?></li>
      </ol>
    </div>
    <!-- Fin -->

    <h3>REPORTE ESTADÍSTICO DE LA CRE <?= $idYear?></h3>

    <div class="mt-2 p-3 bg-white">
      <div id="DivReporteEstadistico"></div>
    </div>

  </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>

</html>