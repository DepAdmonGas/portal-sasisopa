<?php
require('../../../../app/help.php');

$idMantenimiento = $_GET['idMantenimiento'];

$sql_mantenimiento = "SELECT * FROM po_mantenimiento_verificar WHERE id = '".$idMantenimiento."' ";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);
while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){
$idequipo = $row_mantenimiento['id_equipo'];
$NombreEquipo = NombreEquipo($idequipo, $con);
}


function NombreEquipo($idequipo, $con){
  $sql_equipo = "SELECT * FROM po_mantenimiento_lista WHERE id = '".$idequipo."' ";
  $result_equipo = mysqli_query($con, $sql_equipo);
  $numero_equipo = mysqli_num_rows($result_equipo);
  while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
  $detalle = $row_equipo['detalle'];
  } 
  return $detalle;
  }
?>

  <div class="modal-header">
  <h4 class="modal-title"><?=$NombreEquipo;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

  <div class="text-secondary mb-2"><small>Agregar evidencia Mantenimiento Preventivo y Correctivo</small></div>
   
   <hr>
   
<div class="row">

<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3"> 
  <input type="file" class="" id="FileEvidencia">
</div>

<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2 "> 
  <button type="button" class="btn btn-sm btn-success rounded-0 float-right" onclick="AgregarE(<?=$idMantenimiento;?>)">Agregar evidencia</button>
</div>

</div>
 
<div id="result"></div>

<div class="border-bottom mt-2 mb-2"></div>

<div class="border">
<div class="p-2">
<div class="row">
<?php
$sql_mantenimiento = "SELECT * FROM po_mantenimiento_verificar_evidencias WHERE id_mantenimiento = '".$idMantenimiento."'";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);
while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){
$id = $row_mantenimiento['id'];
$url = $row_mantenimiento['url'];
echo "

<div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-2'> 
<div class='row'>

<div class='col-12'>
<a target='_BLANK' href='".$url."'>
<img src='".$url."' style='width: 100%;'></a>
</div>

<div class='col-12 mb-3'>
<button type='button' class='btn btn-sm btn-danger rounded-0 float-right mt-2' onclick='EliminarE(".$id.",".$idMantenimiento.")'><small>Eliminar evidencias</small></button>
</div>

</div>
</div>";
}
?>
</div>
</div>
</div>


<div class="border-bottom mt-2 mb-2"></div>
<div class="text-right">
<button type="button" class="btn btn-secondary rounded-0" onclick="DetalleMantenimiento(<?=$idMantenimiento;?>)">Regresar</button>
</div>

</div>