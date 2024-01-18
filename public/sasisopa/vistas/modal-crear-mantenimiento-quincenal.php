<?php
require('../../../app/help.php');

   function Folio($idEstacion,$fecha_del_dia, $con){
   $sql_reporte = "SELECT folio, fechacreacion FROM bi_mantenimiento_quincenal WHERE id_estacion = '".$idEstacion."' ORDER BY folio desc LIMIT 1";
   $result_reporte = mysqli_query($con, $sql_reporte);
   $numero_reporte = mysqli_num_rows($result_reporte);

   if($numero_reporte != 0){
   while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
   $NoFolio = $row_reporte['folio'];
   $FechaConsulta = $row_reporte['fechacreacion'];
   }

   $ExplodeFA = explode("-", $fecha_del_dia);
   $ExplodeFC = explode("-", $FechaConsulta);

   $YearFA = $ExplodeFA[0];
   $YearFC = $ExplodeFC[0];

   if($YearFA == $YearFC){
   $Folio = $NoFolio + 1;
   }else{
   $Folio = 1;
   }

   }else{
    $Folio = 1;
   }

   
   return $Folio;
   }

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

$Folio = Folio($Session_IDEstacion,$fecha_del_dia, $con);


if ($Session_IDEstacion == 1) {
$carpeta = "interlomas";
}else if ($Session_IDEstacion == 2) {
$carpeta = "palosolo";
}else if ($Session_IDEstacion == 4) {
$carpeta = "gasomira";
}else if ($Session_IDEstacion == 5) {
$carpeta = "valleguadalupe";
}
?>
  <div class="modal-header">
  <h4 class="modal-title">Crear reporte</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">


<div class="pt-1 pb-1 text-secondary">
    Folio: 
    <label class="font-weight-bold">
        <?=FormatFolio($Folio);?>      
    </label>
</div>

<div class="border-top"></div>


<div class="pt-1 pb-1 mt-2 font-weight-bold">      Fecha: 
</div>
    <input type="date" class="form-control rounded-0 mb-2" id="Fecha">

<div class="border-top"></div>
<div class="pt-1 pb-1 mt-2 font-weight-bold">
<a target="_blank" href="archivos/mantenimiento-quincenal/<?=$carpeta;?>/Formato de Mantenimiento Preventivo.pdf" ><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>
Formato de Mantenimiento PREVENTIVO: </div>
<input type="file" class="form-control rounded-0 mt-2 mb-3" id="Formato1">

<div class="border-top"></div>
<div class="pt-1 pb-1 mt-2 font-weight-bold">
<a target="_blank" href="archivos/mantenimiento-quincenal/<?=$carpeta;?>/Pruebade sensores.pdf" ><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>
Pruebade sensores: </div>
<input type="file" class="form-control rounded-0 mt-2 mb-3" id="Formato2">

<div class="border-top"></div>
<div class="pt-1 pb-1 mt-2 font-weight-bold">
<a target="_blank" href="archivos/mantenimiento-quincenal/<?=$carpeta;?>/CUMPLIMIENTO A LOS APARTADOS 8.9.1 AL 8.11.1.pdf" ><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>
CUMPLIMIENTO A LOS APARTADOS 8.9.1 AL 8.11.1: </div>
<input type="file" class="form-control rounded-0 mt-2 mb-3" id="Formato3">

<div class="border-top"></div>
<div class="pt-1 pb-1 mt-2 font-weight-bold">
<a target="_blank" href="archivos/mantenimiento-quincenal/<?=$carpeta;?>/CUMPLIMIENTO A LOS APARTADOS 8.12 al 8.17.4.pdf" ><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>
CUMPLIMIENTO A LOS APARTADOS 8.12 al 8.17.4: </div>
<input type="file" class="form-control rounded-0 mt-2 mb-3" id="Formato4">

<div class="border-top"></div>
<div class="pt-1 pb-1 mt-2 font-weight-bold">
<a target="_blank" href="archivos/mantenimiento-quincenal/<?=$carpeta;?>/CUMPLIMIENTO A LOS APARTADOS 8.17.5 AL 8.19.5.pdf" ><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>
CUMPLIMIENTO A LOS APARTADOS 8.17.5 AL 8.19.5: </div>
<input type="file" class="form-control rounded-0 mt-2 mb-3" id="Formato5">

<div class="border-top"></div>
<div class="pt-1 pb-1 mt-2 font-weight-bold">
<a target="_blank" href="archivos/mantenimiento-quincenal/<?=$carpeta;?>/REVISIÓN Y MANTENIMIENTO PLANTA DE LUZ.pdf" ><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>
REVISIÓN Y MANTENIMIENTO PLANTA DE LUZ: </div>
<input type="file" class="form-control rounded-0 mt-2 mb-3" id="Formato6">
  
<div class="border-top"></div>
<div class="pt-1 pb-1 mt-2 font-weight-bold">
<a target="_blank" href="archivos/mantenimiento-quincenal/<?=$carpeta;?>/REVISIÓN AL COMPRESOR.pdf" ><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>
REVISIÓN AL COMPRESOR: </div>
<input type="file" class="form-control rounded-0 mt-2 mb-3" id="Formato7">
  
	

  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="CrearM()">Crear Mantenimiento</button>
  </div>