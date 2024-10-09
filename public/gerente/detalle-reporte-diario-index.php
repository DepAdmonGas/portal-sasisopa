<?php
require('app/help.php');
$idReporteCre = $idReporte;
$fechaFormato = date("Y-m-d", $idFecha);
$tovolcompra1 = 0;
$tovolcompra2 = 0;
$tovolcompra3 = 0;
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

  <script type="text/javascript">
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
      $(".LoaderPage").fadeOut("slow");

    });

    function regresarP() {
      window.history.back();
    }

    function ListaReporteEstadistico() {
      $('#DivReporteEstadistico').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;margin-top: 20px;' />");
      $('#DivReporteEstadistico').load('public/gerente/vistas/lista-reporte-estadistico.php');
    }
  </script>

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
        <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-CHEVRON-LEFT"></i> REPORTE DIARIO</li>
        <li aria-current="page" class="breadcrumb-item active">DETALLE REPORTE DIARIO <?= strtoupper(FormatoFecha($fechaFormato)); ?></li>
      </ol>
    </div>
    <!-- Fin -->
    <h3>DETALLE REPORTE DIARIO <?= strtoupper(FormatoFecha($fechaFormato)); ?></h3>

    
    <div class="card-body bg-white">

      <?php
      if ($Session_ProductoUno != "") {
      ?>

        <!-- PRODUCTO G-SUPER -->
        <div class="border mb-3">
          <div class="p-3">

            <div class="mb-2" style="font-size: 1.2em;">
              <label style="border-bottom: 2px solid #59c784;">Producto: <b><?= $Session_ProductoUno; ?></b></label>
            </div>


            <div class="row">

              <!-- TABLA - AGREGAR VOLUMEN INICIAL, FINAL Y VENTAS-->
              <div class="col-xl-5 col-lg-5 col-md-12 col-12">

                <div class="mb-2" style="overflow-y: hidden;">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th class="text-center text-secondary">Volumen (Lt) Inicial</th>
                        <th class="text-center text-secondary">Volumen (Lt) de venta</th>
                        <th colspan="2" class="text-center text-secondary">Volumen (Lt) Final</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
                        $sql_reportepro1 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '" . $idReporteCre . "' and fecha = '" . $fechaFormato . "' and producto = '" . $Session_ProductoUno . "' ";
                        $result_reportepro1 = mysqli_query($con, $sql_reportepro1);
                        $numero_reportepro1 = mysqli_num_rows($result_reportepro1);
                        while ($row_reportepro1 = mysqli_fetch_array($result_reportepro1, MYSQLI_ASSOC)) {
                          $idProducto = $row_reportepro1['id'];
                          $volInicial1 = $row_reportepro1['volumen_inicial'];
                          $volVenta1 = $row_reportepro1['volumen_venta'];
                          $volFinal1 = $row_reportepro1['volumen_final'];
                          echo "<td class='text-center'>" . $row_reportepro1['volumen_inicial'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepro1['volumen_venta'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepro1['volumen_final'] . "</td>";
                        }
                        ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>


              <!-- TABLA - AGREGAR VOLUMEN COMPRAS DE PIPAS-->
              <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                <div class="mb-2" style="overflow-y: hidden;">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th class="text-center text-secondary font-weight-bold align-middle">Pipa</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Volumen (Lt) de Compra</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Precio ($) por litro de producto</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Costo ($) del flete mas IVA</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">No. De factura</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Nombre o Razón Social del Transportista</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Importe</th>
                      </tr>
                    <tbody>
                      <?php
                      $sql_reportepipas1 = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '" . $idProducto . "' ";
                      $result_reportepipas1 = mysqli_query($con, $sql_reportepipas1);
                      $numero_reportepipas1 = mysqli_num_rows($result_reportepipas1);
                      if ($numero_reportepipas1 > 0) {
                        while ($row_reportepipas1 = mysqli_fetch_array($result_reportepipas1, MYSQLI_ASSOC)) {
                          echo "<tr>";
                          echo "<td class='text-center'>" . $row_reportepipas1['pipa_numero'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas1['volumen'] . "</td>";
                          echo "<td class='text-center'>" . number_format($row_reportepipas1['precio_litro'], 2) . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas1['costo_flete'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas1['no_factura'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas1['nombre_razonsocial'] . "</td>";
                          echo "<td class='text-center'>$" . number_format($row_reportepipas1['importe_total'], 2) . "</td>";
                          echo "</tr>";

                          $tovolcompra1 = $tovolcompra1 + $row_reportepipas1['volumen'];
                        }
                      } else {
                        echo "<tr><td colspan='5' class='text-center text-secondary' style='font-size: .9em;'>No se encontró información</td></tr>";
                      }

                      ?>
                    </tbody>
                    </thead>
                  </table>
                </div>
              </div>


              <?php
              $mermapr1 = $volInicial1 + $tovolcompra1 - $volVenta1 - $volFinal1;
              echo "<div class='col-12'>
      <hr>
    <label class='font-weight-bold' style='font-size: 1.2em;'>Total Merma:</label> <label class='font-weight-bold text-danger' style='font-size: 1.2em;'>" . $mermapr1 . "</label> </div>";

              ?>
            </div>
          </div>
        </div>

      <?php } ?>

      <?php
      if ($Session_ProductoDos != "") {
      ?>

        <div class="border mb-3">
          <div class="p-3">

            <div class="mb-2" style="font-size: 1.2em;">
              <label style="border-bottom: 2px solid #c75959;">Producto: <b><?= $Session_ProductoDos; ?></b></label>
            </div>

            <div class="row">

              <!-- TABLA - AGREGAR VOLUMEN INICIAL, FINAL Y VENTAS-->
              <div class="col-xl-5 col-lg-5 col-md-12 col-12">

                <div class="mb-2" style="overflow-y: hidden;">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th class="text-center text-secondary">Volumen (Lt) Inicial</th>
                        <th class="text-center text-secondary">Volumen (Lt) de venta</th>
                        <th colspan="2" class="text-center text-secondary">Volumen (Lt) Final</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
                        $sql_reportepro2 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '" . $idReporteCre . "' and fecha = '" . $fechaFormato . "' and producto = '" . $Session_ProductoDos . "' ";
                        $result_reportepro2 = mysqli_query($con, $sql_reportepro2);
                        $numero_reportepro2 = mysqli_num_rows($result_reportepro2);
                        while ($row_reportepro2 = mysqli_fetch_array($result_reportepro2, MYSQLI_ASSOC)) {
                          $idProducto = $row_reportepro2['id'];
                          $volInicial2 = $row_reportepro2['volumen_inicial'];
                          $volVenta2 = $row_reportepro2['volumen_venta'];
                          $volFinal2 = $row_reportepro2['volumen_final'];
                          echo "<td class='text-center'>" . $row_reportepro2['volumen_inicial'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepro2['volumen_venta'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepro2['volumen_final'] . "</td>";
                        }
                        ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>


              <!-- TABLA - AGREGAR VOLUMEN INICIAL, FINAL Y VENTAS-->
              <div class="col-xl-7 col-lg-7 col-md-12 col-12">

                <div class="mb-2" style="overflow-y: hidden;">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th class="text-center text-secondary font-weight-bold align-middle">Pipa</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Volumen (Lt) de Compra</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Precio ($) por litro de producto</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Costo ($) del flete mas IVA</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">No. De factura</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Nombre o Razón Social del Transportista</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Importe</th>
                      </tr>
                    <tbody>
                      <?php
                      $sql_reportepipas2 = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '" . $idProducto . "' ";
                      $result_reportepipas2 = mysqli_query($con, $sql_reportepipas2);
                      $numero_reportepipas2 = mysqli_num_rows($result_reportepipas2);
                      if ($numero_reportepipas2 > 0) {
                        while ($row_reportepipas2 = mysqli_fetch_array($result_reportepipas2, MYSQLI_ASSOC)) {
                          echo "<tr>";
                          echo "<td class='text-center'>" . $row_reportepipas2['pipa_numero'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas2['volumen'] . "</td>";
                          echo "<td class='text-center'>" . number_format($row_reportepipas2['precio_litro'], 2) . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas2['costo_flete'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas2['no_factura'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas2['nombre_razonsocial'] . "</td>";
                          echo "<td class='text-center'>$" . number_format($row_reportepipas2['importe_total'], 2) . "</td>";
                          echo "</tr>";
                          $tovolcompra2 = $tovolcompra2 + $row_reportepipas2['volumen'];
                        }
                      } else {
                        echo "<tr><td colspan='5' class='text-center text-secondary' style='font-size: .9em;'>No se encontró información</td></tr>";
                      }
                      ?>
                    </tbody>
                    </thead>
                  </table>
                </div>
              </div>
              <?php
              $mermapr2 = $volInicial2 + $tovolcompra2 - $volVenta2 - $volFinal2;
              echo "<div class='col-12'>
      <hr>
    <label class='font-weight-bold' style='font-size: 1.2em;'>Total Merma:</label> <label class='font-weight-bold text-danger' style='font-size: 1.2em;'>" . $mermapr2 . "</label> </div>";
              ?>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php
      if ($Session_ProductoTres != "") {
      ?>

        <div class="border mb-3">
          <div class="p-3">

            <div class="mb-2" style="font-size: 1.2em;">

              <label style="border-bottom: 2px solid #4f4f4f;">Producto: <b><?= $Session_ProductoTres; ?></b></label>
            </div>

            <div class="row">

              <!-- TABLA - AGREGAR VOLUMEN INICIAL, FINAL Y VENTAS-->
              <div class="col-xl-5 col-lg-5 col-md-12 col-12">

                <div class="mb-2" style="overflow-y: hidden;">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th class="text-center text-secondary">Volumen (Lt) Inicial</th>
                        <th class="text-center text-secondary">Volumen (Lt) de venta</th>
                        <th colspan="2" class="text-center text-secondary">Volumen (Lt) Final</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
                        $sql_reportepro3 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '" . $idReporteCre . "' and fecha = '" . $fechaFormato . "' and producto = '" . $Session_ProductoTres . "' ";
                        $result_reportepro3 = mysqli_query($con, $sql_reportepro3);
                        $numero_reportepro3 = mysqli_num_rows($result_reportepro3);
                        while ($row_reportepro3 = mysqli_fetch_array($result_reportepro3, MYSQLI_ASSOC)) {
                          $idProducto = $row_reportepro3['id'];
                          $volInicial3 = $row_reportepro3['volumen_inicial'];
                          $volVenta3 = $row_reportepro3['volumen_venta'];
                          $volFinal3 = $row_reportepro3['volumen_final'];
                          echo "<td class='text-center'>" . $row_reportepro3['volumen_inicial'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepro3['volumen_venta'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepro3['volumen_final'] . "</td>";
                        }
                        ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>


              <!-- TABLA - AGREGAR VOLUMEN INICIAL, FINAL Y VENTAS-->
              <div class="col-xl-7 col-lg-7 col-md-12 col-12">

                <div class="mb-2" style="overflow-y: hidden;">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th class="text-center text-secondary font-weight-bold align-middle">Pipa</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Volumen (Lt) de Compra</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Precio ($) por litro de producto</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Costo ($) del flete mas IVA</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">No. De factura</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Nombre o Razón Social del Transportista</th>
                        <th class="text-center text-secondary font-weight-bold align-middle">Importe</th>
                      </tr>
                    <tbody>
                      <?php
                      $sql_reportepipas3 = "SELECT * FROM re_reporte_cre_pipas WHERE id_re_producto = '" . $idProducto . "' ";
                      $result_reportepipas3 = mysqli_query($con, $sql_reportepipas3);
                      $numero_reportepipas3 = mysqli_num_rows($result_reportepipas3);
                      if ($numero_reportepipas3 > 0) {
                        while ($row_reportepipas3 = mysqli_fetch_array($result_reportepipas3, MYSQLI_ASSOC)) {
                          echo "<tr>";
                          echo "<td class='text-center'>" . $row_reportepipas3['pipa_numero'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas3['volumen'] . "</td>";
                          echo "<td class='text-center'>" . number_format($row_reportepipas3['precio_litro'], 2) . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas3['costo_flete'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas3['no_factura'] . "</td>";
                          echo "<td class='text-center'>" . $row_reportepipas3['nombre_razonsocial'] . "</td>";
                          echo "<td class='text-center'>$" . number_format($row_reportepipas3['importe_total'], 2) . "</td>";
                          echo "</tr>";
                          $tovolcompra3 = $tovolcompra3 + $row_reportepipas3['volumen'];
                        }
                      } else {
                        echo "<tr><td colspan='5' class='text-center text-secondary' style='font-size: .9em;'>No se encontró información</td></tr>";
                      }
                      ?>
                    </tbody>
                    </thead>
                  </table>
                </div>
              </div>
              <?php
              $mermapr3 = $volInicial3 + $tovolcompra3 - $volVenta3 - $volFinal3;
              echo "<div class='col-12'>
      <hr>
    <label class='font-weight-bold' style='font-size: 1.2em;'>Total Merma:</label> <label class='font-weight-bold text-danger' style='font-size: 1.2em;'>" . $mermapr3 . "</label> </div>";
              ?>
            </div>
          </div>
        </div>

      <?php } ?>


    </div>

  </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>

</html>