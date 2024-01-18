<?php
require('../../../app/help.php');

$idMantenimiento = $_GET['idMantenimiento'];

 function FormatFolio($Folio){

        $NumString = strlen($Folio);

        if($NumString == 1){

            $resultado = "00".$Folio;

        }else if($NumString == 2){

            $resultado = "0".$Folio;

        }else if($NumString == 3){

            $resultado = $Folio;

        }

        return $resultado;

       }

       function NombreUsuario($idUsuario, $con){

        $sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$idUsuario."' ";
        $result_usuario = mysqli_query($con, $sql_usuario);
        while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
        $nomencargado = $row_usuario['nombre'];
        }

        return $nomencargado;

       }

$sql_mantenimiento = "SELECT * FROM po_mantenimiento_correctivo WHERE id = '".$idMantenimiento."'";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);

while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){
        $folio = FormatFolio($row_mantenimiento['folio']);
        $fecha_row = $row_mantenimiento['fechacreacion'];
        $fecha = FormatoFecha($fecha_row);

        $hora = date("g:i a",strtotime($row_mantenimiento['horacreacion']));
        $equipo = $row_mantenimiento['nombre_equipo'];
        $dhallazgo = $row_mantenimiento['descripcion_hallazgo'];
        $dactividad = $row_mantenimiento['descripcion_actividad'];
        $herramienta = $row_mantenimiento['herramienta'];
}


?>

  <div class="modal-header">
  <h4 class="modal-title">Folio: <?=$folio;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

  <div class="text-secondary mb-2 p-2 border-bottom"><small>Editar Mantenimiento Preventivo y Correctivo</small>
</div>

    <div class="col-12 border p-2">
<div class="font-weight-bold text-secondary border-bottom p-1">Nombre del equipo o área donde se detecta la no conformidad:</div>
<div class="mt-2"><textarea class="rounded-0 form-control" id="EquipoArea"><?=$equipo;?></textarea></div>
</div>

    <div class="col-12 border p-2">
<div class="font-weight-bold text-secondary border-bottom p-1">Descripción breve del hallazgo detectado que requiere mantenimiento:</div>
<div class="mt-2"><textarea class="rounded-0 form-control" id="DeHallazgo"><?=$dhallazgo;?></textarea></div>
</div>

    <div class="col-12 border p-2">
<div class="font-weight-bold text-secondary border-bottom p-1">Descripción de las actividades de mantenimiento: </div>
<div class="mt-2"><textarea class="rounded-0 form-control" id="DeMantenimiento"><?=$dactividad;?></textarea></div>
</div>


<div class="col-12 border p-2">
<div class="font-weight-bold text-secondary border-bottom p-1">Herramienta utilizada para el mantenimiento:</div>
<div class="mt-2"><textarea class="rounded-0 form-control" id="Herramienta"><?=$herramienta;?></textarea></div>
</div>

<div class="col-12 mt-3">
<div class="text-right text-secondary">
<small><?=$fecha;?>, <?=$hora;?></small>
 </div>        
</div>

<hr>

<div class="col-12 mt-2 mb-2">
<div class="text-right">
<button type="button" class="btn btn-secondary rounded-0" onclick="DetalleMantenimiento(<?=$idMantenimiento;?>)">Cancelar</button>
<button type="button" class="btn btn-primary rounded-0" onclick="ActualizarM(<?=$idMantenimiento;?>)">Actualizar</button>
</div>
</div>

</div>
