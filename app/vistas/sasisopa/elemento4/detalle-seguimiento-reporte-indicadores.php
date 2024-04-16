<?php 
require('../../../../app/help.php');

$sql = "SELECT fecha,
capacitacion,
exp_cliente,
ventas,
medidas_correctivas,
fecha_aplicacion FROM tb_seguimiento_reporte_indicador WHERE id = '".$_GET['idSeguimiento']."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$fecha = $row['fecha'];
$capacitacion = $row['capacitacion'];
$expcliente = $row['exp_cliente'];
$ventas = $row['ventas'];
$medidascorrectivas = $row['medidas_correctivas'];
$fechaaplicacion = $row['fecha_aplicacion'];

}
?>
        <div class="modal-header">
          <h4 class="modal-title">Detalle seguimiento y reporte de indicadores</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <div class="border p-2">
          	<h5>Fecha:</h5>
          	<?=FormatoFecha($fecha);?>
          </div>

          <div class="border p-2 mt-2">
          	<h5>Capacitacion:</h5>
          	<?=$capacitacion;?>
          </div>

          <div class="border p-2 mt-2">
          	<h5>Experiencia del cliente:</h5>
          	<?=$expcliente;?>
          </div>

          <div class="border p-2 mt-2">
          	<h5>Ventas:</h5>
          	<?=$ventas;?>
          </div>

          <div class="border p-2 mt-2">
          	<h5>Medidas correctivas:</h5>
          	<?=$medidascorrectivas;?>
          </div>

          <div class="border p-2 mt-2">
          	<h5>Fecha de aplicación:</h5>
          	<?=FormatoFecha($fechaaplicacion);?>
          </div>

        </div>