<?php 
require('../../../../app/help.php');
 
$idSeguimiento = $_GET['idSeguimiento'];

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
        <h4 class="modal-title">Seguimiento y reporte de indicadores</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        <div>Fecha:</div>
        <input type="date" class="form-control rounded-0 mt-2" id="EditFecha" value="<?=$fecha;?>">

        <div class="mt-2 mb-2">Capacitacion:</div>
        <textarea class="form-control rounded-0 mt-2" id="EditCapacitacion"><?=$capacitacion;?></textarea>

        <div class="mt-2 mb-2">Experiencia del cliente:</div>
        <textarea class="form-control rounded-0 mt-2" id="EditExperienciaC"><?=$expcliente;?></textarea>

        <div class="mt-2 mb-2">Ventas:</div>
        <textarea class="form-control rounded-0 mt-2" id="EditVentas"><?=$ventas;?></textarea>

        <div class="mt-2 mb-2">Medidas correctivas:</div>
        <textarea class="form-control rounded-0 mt-2" id="EditMedidasC"><?=$medidascorrectivas;?></textarea>

        <div class="mt-2 mb-2">Fecha de aplicación:</div>
        <input type="date" class="form-control rounded-0 mt-1" id="EditFechaAplicacion" value="<?=$fechaaplicacion;?>">

        </div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnEditSRI(<?=$idSeguimiento;?>)">Editar</button>
 </div>