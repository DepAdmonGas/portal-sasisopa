<?php
require('../../../app/help.php');

$sql_reportecre = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '" . $Session_IDEstacion . "' and mes = '" . $_GET['idMes'] . "' and year = '" . $_GET['idYear'] . "' ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);

$row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC);
$idReporteCre = $row_reportecre['id'];

$TP1VI = 0;
$TP1VV = 0;
$TP1VF = 0;
$TP1VC = 0;
$TP2VI = 0;
$TP2VV = 0;
$TP2VF = 0;
$TP2VC = 0;
$TP3VI = 0;
$TP3VV = 0;
$TP3VF = 0;
$TP3VC = 0;

?>
<script type="text/javascript">
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });

  function verdetalle(idFecha, idrep) {
    window.location.href = '<?= RUTA_DETALLE_REPORTE_DIARIO; ?>/' + idrep + "/" + idFecha;
  }

  function editar(idFecha, idrep) {
    window.location.href = '<?= RUTA_EDITAR_REPORTE_DIARIO; ?>/' + idrep + "/" + idFecha;
  }

  function mensaje(idFecha, idrep, nummensajes) {

    $('#idMensajes').val(idFecha);
    $('#nummensajes').val(nummensajes);
    $('#myModalMensajes').modal('show');
    $('#mensajes').load('../../public/gerente/vistas/lista-mensajes-cre.php?idFecha=' + idFecha + "&idReporte=<?= $idReporteCre; ?>");
  }

  function btnEnviar() {

    var idMensajes = $('#idMensajes').val();
    var nummensajes = $('#nummensajes').val();
    var NewMensaje = $('#NewMensaje').val();
    var section = document.getElementById('mensajes').innerHTML;
    var contenido = "";
    var totalMensaje = parseInt(nummensajes) + parseInt(1);


    if (NewMensaje != "") {
      $('#NewMensaje').css('border', '');

      var parametros = {
        "idUsuario": <?= $Session_IDUsuarioBD; ?>,
        "idReporte": <?= $idReporteCre; ?>,
        "idMensajes": idMensajes,
        "NewMensaje": NewMensaje
      };

      $.ajax({
        data: parametros,
        url: '../../public/gerente/agregar/agregar-mensaje-cre.php',
        type: 'post',
        beforeSend: function() {},
        complete: function() {},
        success: function(response) {

          if (nummensajes == 0) {
            contenido = response;
          } else {
            contenido = response += section;
          }

          $('#mensajes').html(contenido);
          $('#totalMensajes').text(totalMensaje);
          $('#nummensajes').val(totalMensaje);

          $('#NewMensaje').css('border', '');
          $('#NewMensaje').val('');

        }
      });

    } else {
      $('#NewMensaje').css('border', '2px solid #A52525');
    }

  }
</script>
<?php
$sql_reportenum = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '" . $idReporteCre . "' ";
$result_reportenum = mysqli_query($con, $sql_reportenum);
$numero_reportenum = mysqli_num_rows($result_reportenum);

if ($numero_reportenum > 0) {
?>

  <div style="overflow-y: hidden;">
    <table class="table table-bordered table-striped table-sm">
      <thead>
        <tr>
          <th class="text-center align-middle" rowspan="2">Fecha</th>
          <?php if ($Session_ProductoUno != "") {
            echo "<th class='text-center align-middle bg-success text-white' colspan='5'>$Session_ProductoUno</th>";
          } ?>
          <?php if ($Session_ProductoDos != "") {
            echo "<th class='text-center align-middle bg-danger text-white' colspan='5'>$Session_ProductoDos</th>";
          } ?>
          <?php if ($Session_ProductoTres != "") {
            echo "<th class='text-center align-middle bg-dark text-white' colspan='5'>$Session_ProductoTres</th>";
          } ?>
          <td colspan="2">
          </td>
        </tr>
        <tr style="font-size: .9em;">
          <?php if ($Session_ProductoUno != "") {
            echo "
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Inicial'>Vo. (Lt) inicial</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Venta'>Vo. (Lt) venta</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Final'>Vo. (Lt) final</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Compra'>Vo. (Lt) compra</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Merma'>Merma</th>";
          } ?>
          <?php if ($Session_ProductoDos != "") {
            echo "
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Inicial'>Vo. (Lt) inicial</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Venta'>Vo. (Lt) venta</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Final'>Vo. (Lt) final</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Compra'>Vo. (Lt) compra</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Merma'>Merma</th>";
          } ?>
          <?php if ($Session_ProductoTres != "") {
            echo "
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Inicial'>Vo. (Lt) inicial</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Venta'>Vo. (Lt) venta</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Final'>Vo. (Lt) final</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Volumen (Lt) Compra'>Vo. (Lt) compra</th>
                  <th class='text-center align-middle' data-toggle='tooltip' data-placement='top' title='Merma'>Merma</th>";
          } ?>
          <td width="20px" class="text-center align-middle">
            <a>
              <img src="<?php echo RUTA_IMG_ICONOS . "mensaje-black-16.png"; ?>">
            </a>
          </td>
          <th class="align-middle text-center" width="20"><i class="fas fa-ellipsis-v"></i></th>
        </tr>
      </thead>
      <tbody style="font-size: .9em;">
        <?php
        $sql_reportedia = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '" . $idReporteCre . "' GROUP BY fecha ORDER BY fecha desc";
        $result_reportedia = mysqli_query($con, $sql_reportedia);
        $numero_reportedia = mysqli_num_rows($result_reportedia);
        while ($row_reportedia = mysqli_fetch_array($result_reportedia, MYSQLI_ASSOC)) {
          $IDfecha = strtotime($row_reportedia['fecha']);
          $fechaFormato = $row_reportedia['fecha'];
          $formato_fecha = explode("-", $fechaFormato);
        ?>
          <tr>
            <td class="font-weight-bold"><?php echo $formato_fecha[2] . "</b> de " . nombremes($formato_fecha[1]); ?></td>
            <?php
            if ($Session_ProductoUno != "") {
              $sql_reportepro1 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '" . $idReporteCre . "' and fecha = '" . $fechaFormato . "' and producto = '" . $Session_ProductoUno . "' ";
              $result_reportepro1 = mysqli_query($con, $sql_reportepro1);
              $numero_reportepro1 = mysqli_num_rows($result_reportepro1);
              while ($row_reportepro1 = mysqli_fetch_array($result_reportepro1, MYSQLI_ASSOC)) {
                $idPro1 = $row_reportepro1['id'];
                echo "<td class='text-center align-middle'>" . $row_reportepro1['volumen_inicial'] . "</td>";
                echo "<td class='text-center align-middle'>" . $row_reportepro1['volumen_venta'] . "</td>";
                echo "<td class='text-center align-middle'>" . $row_reportepro1['volumen_final'] . "</td>";

                $sql_pipas1 = "SELECT sum(volumen) AS volpro1 FROM re_reporte_cre_pipas WHERE id_re_producto = '" . $idPro1 . "'  ";
                $result_pipas1 = mysqli_query($con, $sql_pipas1);
                while ($row_pipas1 = mysqli_fetch_array($result_pipas1, MYSQLI_ASSOC)) {
                  $tovolpro1 = $row_pipas1['volpro1'];
                }
                echo "<td class='text-center align-middle'><b>" . $tovolpro1 . "</b></td>";

                $mermapr1 = ($row_reportepro1['volumen_final'] + $row_reportepro1['volumen_venta']) - ($row_reportepro1['volumen_inicial'] + $tovolpro1);

                echo "<td class='text-center align-middle text-danger'><b>" . round($mermapr1, 2) . "</b></td>";

                $TP1VI = $TP1VI + $row_reportepro1['volumen_inicial'];
                $TP1VV = $TP1VV + $row_reportepro1['volumen_venta'];
                $TP1VF = $TP1VF + $row_reportepro1['volumen_final'];
                $TP1VC = $TP1VC + $tovolpro1;
              }
            }

            if ($Session_ProductoDos != "") {
              $sql_reportepro2 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '" . $idReporteCre . "' and fecha = '" . $fechaFormato . "' and producto = '" . $Session_ProductoDos . "' ";
              $result_reportepro2 = mysqli_query($con, $sql_reportepro2);
              $numero_reportepro2 = mysqli_num_rows($result_reportepro2);
              while ($row_reportepro2 = mysqli_fetch_array($result_reportepro2, MYSQLI_ASSOC)) {
                echo "<td class='text-center align-middle'>" . $row_reportepro2['volumen_inicial'] . "</td>";
                echo "<td class='text-center align-middle'>" . $row_reportepro2['volumen_venta'] . "</td>";
                echo "<td class='text-center align-middle'>" . $row_reportepro2['volumen_final'] . "</td>";

                $idPro2 = $row_reportepro2['id'];
                $sql_pipas2 = "SELECT sum(volumen) AS volpro2 FROM re_reporte_cre_pipas WHERE id_re_producto = '" . $idPro2 . "'  ";
                $result_pipas2 = mysqli_query($con, $sql_pipas2);
                while ($row_pipas2 = mysqli_fetch_array($result_pipas2, MYSQLI_ASSOC)) {
                  $tovolpro2 = $row_pipas2['volpro2'];
                }
                echo "<td class='text-center  align-middle'><b>" . $tovolpro2 . "</b></td>";

                $mermapr2 = ($row_reportepro2['volumen_final'] + $row_reportepro2['volumen_venta']) - ($row_reportepro2['volumen_inicial'] + $tovolpro2);
                echo "<td class='text-center  align-middle text-danger'><b>" . round($mermapr2, 2) . "</b></td>";

                $TP2VI = $TP2VI + $row_reportepro2['volumen_inicial'];
                $TP2VV = $TP2VV + $row_reportepro2['volumen_venta'];
                $TP2VF = $TP2VF + $row_reportepro2['volumen_final'];
                $TP2VC = $TP2VC + $tovolpro2;
              }
            }

            if ($Session_ProductoTres != "") {
              $sql_reportepro3 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '" . $idReporteCre . "' and fecha = '" . $fechaFormato . "' and producto = '" . $Session_ProductoTres . "' ";
              $result_reportepro3 = mysqli_query($con, $sql_reportepro3);
              $numero_reportepro3 = mysqli_num_rows($result_reportepro3);
              while ($row_reportepro3 = mysqli_fetch_array($result_reportepro3, MYSQLI_ASSOC)) {
                echo "<td class='text-center align-middle'>" . $row_reportepro3['volumen_inicial'] . "</td>";
                echo "<td class='text-center align-middle'>" . $row_reportepro3['volumen_venta'] . "</td>";
                echo "<td class='text-center align-middle'>" . $row_reportepro3['volumen_final'] . "</td>";

                $idPro3 = $row_reportepro3['id'];
                $sql_pipas3 = "SELECT sum(volumen) AS volpro3 FROM re_reporte_cre_pipas WHERE id_re_producto = '" . $idPro3 . "'  ";
                $result_pipas3 = mysqli_query($con, $sql_pipas3);
                while ($row_pipas3 = mysqli_fetch_array($result_pipas3, MYSQLI_ASSOC)) {
                  $tovolpro3 = $row_pipas3['volpro3'];
                }
                echo "<td class='text-center align-middle'><b>" . $tovolpro3 . "</b></td>";

                $mermapr3 = ($row_reportepro3['volumen_final'] + $row_reportepro3['volumen_venta']) - ($row_reportepro3['volumen_inicial'] + $tovolpro3);
                echo "<td class='text-center align-middle text-danger'><b>" . round($mermapr3, 2) . "</b></td>";

                $TP3VI = $TP3VI + $row_reportepro3['volumen_inicial'];
                $TP3VV = $TP3VV + $row_reportepro3['volumen_venta'];
                $TP3VF = $TP3VF + $row_reportepro3['volumen_final'];
                $TP3VC = $TP3VC + $tovolpro3;
              }
            }
            ?>

            <?php
            $sql_mensaje = "SELECT * FROM re_reporte_cre_mensajes WHERE id_reporte = '" . $idReporteCre . "' AND id_fecha = '" . $IDfecha . "' ";
            $result_mensaje = mysqli_query($con, $sql_mensaje);
            $numero_mensaje = mysqli_num_rows($result_mensaje);

            if ($numero_mensaje == 0) {
              $Nuevo = "";
            } else {
              $toMensajes = $numero_mensaje;
              $Nuevo = '<div class="position-absolute" style="up: 1px;"><span class="badge bg-danger text-white rounded-circle"><span class="fw-bold" style="font-size: 7px;">'.$toMensajes.' </span></span></div>';
            }

            ?>
            <td class="text-center align-middle">
              <a onclick="mensaje(<?= $IDfecha; ?>,<?= $idReporteCre; ?>,<?= $numero_mensaje; ?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Mensaje">
                <div><span class="badge badge-pill badge-primary" id="totalMensajes" style="font-size: .5em;margin-right: 5px; color: red;"><?= $Nuevo; ?></span>
                <img src="<?php echo RUTA_IMG_ICONOS . "mensaje-black-16.png"; ?>"></div>
              </a>
            </td>
            <td class="text-center align-middle" width="20px" style="cursor: pointer;">
              <div class="dropdown dropstart">
                <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <a class="dropdown-item" onclick="verdetalle(<?= $IDfecha; ?>,<?= $idReporteCre; ?>)"><i class="fa-regular fa-eye"></i> Detalle</a>
                  <a class="dropdown-item" onclick="editar(<?= $IDfecha; ?>,<?= $idReporteCre; ?>)"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                </div>
              </div>
            </td>
          </tr>
        <?php
        }
        echo '<tr>';
        if ($Session_ProductoUno != "") {
          echo '<td><b>TOTAL:</b></td>
                  <td class="text-center"><b>' . $TP1VI . '</b></td>
                  <td class="text-center"><b>' . $TP1VV . '</b></td>
                  <td class="text-center"><b>' . $TP1VF . '</b></td>
                  <td class="text-center"><b>' . $TP1VC . '</b></td>';
        }

        if ($Session_ProductoDos != "") {
          echo '<td></td>
                <td class="text-center"><b>' . $TP2VI . '</b></td>
                <td class="text-center"><b>' . $TP2VV . '</b></td>
                <td class="text-center"><b>' . $TP2VF . '</b></td>
                <td class="text-center"><b>' . $TP2VC . '</b></td>';
        }

        if ($Session_ProductoTres != "") {
          echo '<td></td>
                <td class="text-center"><b>' . $TP3VI . '</b></td>
                <td class="text-center"><b>' . $TP3VV . '</b></td>
                <td class="text-center"><b>' . $TP3VF . '</b></td>
                <td class="text-center"><b>' . $TP3VC . '</b></td>';
        }

        echo '</tr>';
        ?>
      </tbody>
    </table>
  </div>
<?php
} else {
  echo "<div class='text-secondary text-center'style='font-size: .9em'>No se encontraron reportes</div>";
}
?>


<div class="modal fade" id="myModalMensajes" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div class="modal-header rounded-0 head-modal">
        <h4 class="modal-title text-white">Mensaje</h4>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <div id="mensajes" style="height: 300px;overflow: auto;border: 1px solid #EBEBEB;padding: 5px;">
        </div>

        <div>
          <input type="hidden" id="idMensajes">
          <input type="hidden" id="nummensajes">
          <textarea class="form-control" id="NewMensaje" style="border-radius: 0px;width: 100%;margin-bottom: 2px;" rows="3" placeholder="Mensaje..."></textarea>
          <button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;width: 100%;" onclick="btnEnviar()">Enviar</button>
        </div>

      </div>

    </div>
  </div>
</div>