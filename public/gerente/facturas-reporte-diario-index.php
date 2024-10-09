<?php
require('app/help.php');


$rep_mes = date("m");
$rep_year = $idYear;

$sql_reportecre = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '" . $Session_IDEstacion . "' and year = '" . $rep_year . "' ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);

while ($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)) {
  $idReporteCre = $row_reportecre['id'];
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

  </style>
  <script type="text/javascript">
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();

    });

    function regresarP() {
      window.location.href = '../reporte-diario/<?= $idYear; ?>';
    }

    function editarModal(idp, type) {
      $('#ModalEditar').modal('show');

      $('#Idresult').val(idp);
      $('#IdType').val(type);

      if (type == 1) {
        $('#ModalLongTitle').text('Agregar factura de inicio de mes');
      } else if (type == 2) {
        $('#ModalLongTitle').text('Agregar factura de mediados de mes');
      } else if (type == 3) {
        $('#ModalLongTitle').text('Agregar factura de final de mes');
      }

    }

    function BtnGuardar() {

      var Idresult = $('#Idresult').val()
      var IdType = $('#IdType').val();
      var IdProd = $('#IdProd').val();
      var data = new FormData();
      var url = "../public/gerente/agregar/agregar-facturas-cre.php";

      if (IdProd == 2) {

        var producto1 = document.getElementById("producto1");
        var file1 = producto1.files[0];
        var filePath1 = producto1.value;
        var velpdf1 = filePath1.split('.').pop();

        var producto2 = document.getElementById("producto2");
        var file2 = producto2.files[0];
        var filePath2 = producto2.value;
        var velpdf2 = filePath2.split('.').pop();

        if (velpdf1 == "pdf") {
          $('#producto1').css('border', '');
          if (velpdf2 == "pdf") {
            $('#producto2').css('border', '');

            data.append('Idresult', Idresult);
            data.append('IdType', IdType);
            data.append('IdProd', IdProd);
            data.append('file1', file1);
            data.append('file2', file2);

            $.ajax({
              url: url,
              type: 'POST',
              contentType: false,
              data: data,
              processData: false,
              cache: false
            }).done(function(data) {

              window.location.href = '';
            });

          } else {
            $('#producto2').css('border', '1px solid #A52525');
            alertify.error('El formato debe ser en PDF');
          }
        } else {
          $('#producto1').css('border', '1px solid #A52525');
          alertify.error('El formato debe ser en PDF');
        }



      } else if (IdProd == 3) {

        var producto1 = document.getElementById("producto1");
        var file1 = producto1.files[0];
        var filePath1 = producto1.value;
        var velpdf1 = filePath1.split('.').pop();

        var producto2 = document.getElementById("producto2");
        var file2 = producto2.files[0];
        var filePath2 = producto2.value;
        var velpdf2 = filePath2.split('.').pop();

        var producto3 = document.getElementById("producto3");
        var file3 = producto3.files[0];
        var filePath3 = producto3.value;
        var velpdf3 = filePath3.split('.').pop();

        if (velpdf1 == "pdf") {
          $('#producto1').css('border', '');
          if (velpdf2 == "pdf") {
            $('#producto2').css('border', '');
            if (velpdf3 == "pdf") {
              $('#producto3').css('border', '');

              data.append('Idresult', Idresult);
              data.append('IdType', IdType);
              data.append('IdProd', IdProd);
              data.append('file1', file1);
              data.append('file2', file2);
              data.append('file3', file3);

              $.ajax({
                url: url,
                type: 'POST',
                contentType: false,
                data: data,
                processData: false,
                cache: false
              }).done(function(data) {

                window.location.href = '';
              });

            } else {
              $('#producto3').css('border', '1px solid #A52525');
              alertify.error('El formato debe ser en PDF');
            }
          } else {
            $('#producto2').css('border', '1px solid #A52525');
            alertify.error('El formato debe ser en PDF');
          }
        } else {
          $('#producto1').css('border', '1px solid #A52525');
          alertify.error('El formato debe ser en PDF');
        }

      }


    }
  </script>
</head>

<body>
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
        <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-chevron-left"></i> REPORTE ESTADÍSTICO DE LA CRE</li>
        <li aria-current="page" class="breadcrumb-item active text-SECONDARY c-pointer">FACTURAS DE PRODUCTOS</li>
      </ol>
    </div>
    <!-- Fin -->

    <h3>FACTURAS DE PRODUCTOS <?= $idYear ?></h3>


    <div class="card-body">

      <?php

      if ($Session_ProductoUno != "") {
        $p1 = 1;
      } else {
        $p1 = 0;
      }
      if ($Session_ProductoDos != "") {
        $p2 = 1;
      } else {
        $p2 = 0;
      }
      if ($Session_ProductoTres != "") {
        $p3 = 1;
      } else {
        $p3 = 0;
      }

      $countProductos = $p1 + $p2 + $p3;


      $sql_reporte = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '" . $Session_IDEstacion . "' and year = '" . $rep_year . "' ORDER BY mes ASC";
      $result_reporte = mysqli_query($con, $sql_reporte);
      $numero_reporte = mysqli_num_rows($result_reporte);
      while ($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)) {
        $idP = $row_reporte['id'];

        echo "<div class='card p-3 mb-3 rounded-0'>";
        echo "<div class='font-weight-bold ' style='font-size: 1.1em;'>" . nombremes($row_reporte['mes']) . " del " . $row_reporte['year'] . "
              <hr>
              </div>";



        echo "<div class='row'>";

        echo "<div class='col-xl-4 col-lg-4 col-md-12 col-12 mb-2'>";

        echo "<div style='overflow-y: hidden;'>";
        echo "<table class='table table-sm table-bordered table-striped'>";
        echo "<tr>";
        echo "<td class='text-center font-weight-bold' style='font-size: 1em;' colspan='" . $countProductos . "'>Inicio de mes</td>";
        echo "</tr>";
        echo "<tr>";
        if ($Session_ProductoUno != "") {
          echo "<td class='text-center'>$Session_ProductoUno</td>";
        }
        if ($Session_ProductoDos != "") {
          echo "<td class='text-center'>$Session_ProductoDos</td>";
        }
        if ($Session_ProductoTres != "") {
          echo "<td class='text-center'>$Session_ProductoTres</td>";
        }
        echo "<td class='align-middle text-center' width='20px' data-toggle='tooltip' data-placement='left' title='Agregar' onclick='editarModal(" . $idP . ",1)'><img src='" . RUTA_IMG_ICONOS . "mas-verde-16.png' style='cursor: pointer;'></td>";
        echo "</tr>";

        echo "<tr>";

        if ($Session_ProductoUno != "") {
          if ($row_reporte['f_producto_uno'] == "") {
      ?>
            <td class="align-middle text-center">
              <img src="<?php echo RUTA_IMG_ICONOS . "eliminar-red-16.png"; ?>">
            </td>
          <?php
          } else {
          ?>
            <td class="align-middle text-center">
              <a target="_blank" href="../<?= $row_reporte['f_producto_uno']; ?>"><img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>"></a>
            </td>
          <?php
          }
        }

        if ($Session_ProductoDos != "") {
          if ($row_reporte['f_producto_dos'] == "") {
          ?>
            <td class="align-middle text-center">
              <img src="<?php echo RUTA_IMG_ICONOS . "eliminar-red-16.png"; ?>">
            </td>
          <?php
          } else {
          ?>
            <td class="align-middle text-center">
              <a target="_blank" href="../<?= $row_reporte['f_producto_dos']; ?>"><img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>"></a>
            </td>
          <?php
          }
        }

        if ($Session_ProductoTres != "") {
          if ($row_reporte['f_producto_tres'] == "") {
          ?>
            <td class="align-middle text-center">
              <img src="<?php echo RUTA_IMG_ICONOS . "eliminar-red-16.png"; ?>">
            </td>
          <?php
          } else {
          ?>
            <td class="align-middle text-center">
              <a target="_blank" href="../<?= $row_reporte['f_producto_tres']; ?>"><img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>"></a>
            </td>
          <?php
          }
        }

        echo "</table>";
        echo "</div>";
        echo "</div>";

        //---------------------------------------------------------------------------------------------

        echo "<div class='col-xl-4 col-lg-4 col-md-12 col-12 mb-2'>";

        echo "<div style='overflow-y: hidden;'>";
        echo "<table class='table table-sm table-bordered table-striped'>";
        echo "<tr>";
        echo "<td class='text-center font-weight-bold' style='font-size: 1em;' colspan='" . $countProductos . "'>Mediados de mes</td>";
        echo "</tr>";
        echo "<tr>";
        if ($Session_ProductoUno != "") {
          echo "<td class='text-center'>$Session_ProductoUno</td>";
        }
        if ($Session_ProductoDos != "") {
          echo "<td class='text-center'>$Session_ProductoDos</td>";
        }
        if ($Session_ProductoTres != "") {
          echo "<td class='text-center'>$Session_ProductoTres</td>";
        }
        echo "<td class='align-middle text-center' width='20px' onclick='editarModal(" . $idP . ",2)'><img src='" . RUTA_IMG_ICONOS . "mas-verde-16.png' style='cursor: pointer;'></td>";
        echo "</tr>";

        echo "<tr>";
        if ($Session_ProductoUno != "") {
          if ($row_reporte['fi_producto_uno'] == "") {
          ?>
            <td class="align-middle text-center">
              <img src="<?php echo RUTA_IMG_ICONOS . "eliminar-red-16.png"; ?>">
            </td>
          <?php
          } else {
          ?>
            <td class="align-middle text-center">
              <a target="_blank" href="../<?= $row_reporte['fi_producto_uno']; ?>"><img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>"></a>
            </td>
          <?php
          }
        }

        if ($Session_ProductoDos != "") {
          if ($row_reporte['fi_producto_dos'] == "") {
          ?>
            <td class="align-middle text-center">
              <img src="<?php echo RUTA_IMG_ICONOS . "eliminar-red-16.png"; ?>">
            </td>
          <?php
          } else {
          ?>
            <td class="align-middle text-center">
              <a target="_blank" href="../<?= $row_reporte['fi_producto_dos']; ?>"><img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>"></a>
            </td>
          <?php
          }
        }

        if ($Session_ProductoTres != "") {
          if ($row_reporte['fi_producto_tres'] == "") {
          ?>
            <td class="align-middle text-center">
              <img src="<?php echo RUTA_IMG_ICONOS . "eliminar-red-16.png"; ?>">
            </td>
          <?php
          } else {
          ?>
            <td class="align-middle text-center">
              <a target="_blank" href="../<?= $row_reporte['fi_producto_tres']; ?>"><img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>"></a>
            </td>
          <?php
          }
        }
        echo "</tr>";

        echo "</table>";
        echo "</div>";
        echo "</div>";
        //-----------------------------------------------------------------------------------------------

        echo "<div class='col-xl-4 col-lg-4 col-md-12 col-12 mb-2'>";
        echo "<div style='overflow-y: hidden;'>";
        echo "<table class='table table-sm table-bordered table-striped'>";
        echo "<tr>";
        echo "<td class='text-center font-weight-bold' style='font-size: 1em;' colspan='" . $countProductos . "'>Final de mes</td>";
        echo "</tr>";
        echo "<tr>";
        if ($Session_ProductoUno != "") {
          echo "<td class='text-center'>$Session_ProductoUno</td>";
        }
        if ($Session_ProductoDos != "") {
          echo "<td class='text-center'>$Session_ProductoDos</td>";
        }
        if ($Session_ProductoTres != "") {
          echo "<td class='text-center'>$Session_ProductoTres</td>";
        }
        echo "<td class='align-middle text-center' width='20px' onclick='editarModal(" . $idP . ",3)'><img src='" . RUTA_IMG_ICONOS . "mas-verde-16.png' style='cursor: pointer;'></td>";
        echo "</tr>";
        echo "<tr>";
        if ($Session_ProductoUno != "") {
          if ($row_reporte['ff_producto_uno'] == "") {
          ?>
            <td class="align-middle text-center">
              <img src="<?php echo RUTA_IMG_ICONOS . "eliminar-red-16.png"; ?>">
            </td>
          <?php
          } else {
          ?>
            <td class="align-middle text-center">
              <a target="_blank" href="../<?= $row_reporte['ff_producto_uno']; ?>"><img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>"></a>
            </td>
          <?php
          }
        }

        if ($Session_ProductoDos != "") {
          if ($row_reporte['ff_producto_dos'] == "") {
          ?>
            <td class="align-middle text-center">
              <img src="<?php echo RUTA_IMG_ICONOS . "eliminar-red-16.png"; ?>">
            </td>
          <?php
          } else {
          ?>
            <td class="align-middle text-center">
              <a target="_blank" href="../<?= $row_reporte['ff_producto_dos']; ?>"><img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>"></a>
            </td>
          <?php
          }
        }

        if ($Session_ProductoTres != "") {
          if ($row_reporte['ff_producto_tres'] == "") {
          ?>
            <td class="align-middle text-center">
              <img src="<?php echo RUTA_IMG_ICONOS . "eliminar-red-16.png"; ?>">
            </td>
          <?php
          } else {
          ?>
            <td class="align-middle text-center">
              <a target="_blank" href="../<?= $row_reporte['ff_producto_tres']; ?>"><img src="<?php echo RUTA_IMG_ICONOS . "pdf.png"; ?>"></a>
            </td>
      <?php
          }
        }
        echo "</tr>";
        echo "</table>";
        echo "</div>";

        echo "</div>";
        echo "</div>";


        echo "</div>";
      }
      ?>

      <table>
        <tr></tr>
      </table>



    </div>

  </div>

  <div class="modal fade" id="ModalEditar">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white" id="ModalLongTitle"></h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="DivFacturasPDF"></div>

        <div class="modal-body">

          <input type="hidden" id="Idresult">
          <input type="hidden" id="IdType">
          <input type="hidden" id="IdProd" value="<?= $countProductos; ?>">


          <div class="row">
            <div class="col-12">

              <?php
              if ($Session_ProductoUno != "") {

                echo "
               <div class='border mb-3'>
               <div class='p-3'>
               <div class='row'> ";

                echo "<div class='col-12 fw-bold  mb-2'>
                 $Session_ProductoUno 
                <hr></div>";
              ?>

                <div class="col-12">
                  <input type="file" id="producto1" value="" required>
                </div>

              <?php
                echo "</div>";
                echo "</div>";
                echo "</div>";
              }

              if ($Session_ProductoDos != "") {

                echo "
               <div class='border mb-3'>
               <div class='p-3'>
               <div class='row'> ";

                echo "<div class='col-12 fw-bold  mb-2'> $Session_ProductoDos                
               <hr></div>";
              ?>

                <div class="col-12">
                  <input type="file" id="producto2" value="" required>
                </div>

              <?php
                echo "</div>";
                echo "</div>";
                echo "</div>";
              }

              if ($Session_ProductoTres != "") {

                echo "
               <div class='border mb-3'>
               <div class='p-3'>
               <div class='row'> ";

                echo "<div class='col-12 fw-bold  mb-2'> $Session_ProductoTres              
                <hr></div>";
              ?>

                <div class="col-12">
                  <input type="file" id="producto3" value="" required>
                </div>

              <?php
                echo "</div>";
                echo "</div>";
                echo "</div>";
              }
              ?>



            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" onclick="BtnGuardar()" style="border-radius: 0px;border: 0px;">Guardar</button>
        </div>

      </div>
    </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>

</html>