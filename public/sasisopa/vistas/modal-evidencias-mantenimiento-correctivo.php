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

  <div class="text-secondary mb-2"><small>Agregar evidencia Mantenimiento Preventivo y Correctivo</small></div>
  
  <hr>

<div class="row">
<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">   
<input type="file" class="" id="FileEvidencia"></div>


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
$sql_mantenimiento = "SELECT * FROM po_mantenimiento_correctivo_evidencia WHERE id_mantenimiento = '".$idMantenimiento."'";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);
while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){
$id = $row_mantenimiento['id'];
$url = $row_mantenimiento['url'];
echo "
<div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-2'> 
<div class='row'>

<div class='col-12'>
<a target='_BLANK' href='".$url."'><img src='".$url."' style='width: 100%;'></a>
</div>

<div class='col-12 mb-3'>
<button type='button' class='btn btn-sm btn-danger rounded-0 mt-2 float-right' onclick='EliminarE(".$id.",".$idMantenimiento.")'><small>Eliminar evidencias</small></button>
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