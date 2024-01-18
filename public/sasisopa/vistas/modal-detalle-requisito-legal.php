<?php 
require('../../../app/help.php');
$idre = $_GET['id'];

$sql_programa_m = "SELECT * FROM rl_requisitos_legales_calendario WHERE id = '".$idre."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);

while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
$idrequisitolegal = $row_programa_m['id_requisito_legal'];


if($idrequisitolegal == 0){
$requisoLegal = $row_programa_m['requisito_legal']; 
$detalle = '

<div class="row">

<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2"> 
<h5>Nivel de gobierno</h5>
<div class="text-secondary">'.$row_programa_m['nivel_gobierno'].'</div>
</div>

<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2"> 
<h5>Permiso</h5>
<div class="text-secondary">'.$requisoLegal.'</div>
</div>
</div>
<hr>

<div class="row">
<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 ">  
<h5>Vigencia</h5>
<div class="text-secondary">'.$row_programa_m['vigencia'].'</div>
</div>
</div>
<hr>
';

}else{
$DetalleRL = DetalleRL($idrequisitolegal,$con);
$detalle = '

<div class="row">

<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2"> 
<h5>Nivel de gobierno</h5>
<div class="text-secondary">'.$DetalleRL['nivelgobierno'].'</div>
</div>

<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2"> 
<h5>Municipio, Alcaldía y Estado</h5>
<div class="text-secondary">'.$DetalleRL['munalcest'].'</div>
</div>
</div>

<hr>

<div class="row">
<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2"> 

<h5>Dependencia</h5>
<div class="text-secondary">'.$DetalleRL['dependencia'].'</div>
</div>

<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2"> 
<h5>Permiso</h5>
<div class="text-secondary">'.$DetalleRL['permiso'].'</div>
</div>
</div>
<hr>

<div class="row">
<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
<h5>Vigencia</h5>
<div class="text-secondary">'.$row_programa_m['vigencia'].'</div>
</div>
</div>
<hr>

<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2"> 
<h5>Fundamento</h5>
<div class="text-secondary">'.$DetalleRL['fundamento'].'</div>
</div>
</div>
<hr>

';
}

}


function DetalleRL($idrequisitol,$con){

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE id = '".$idrequisitol."' LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$nivelgobierno = $row['nivel_gobierno'];
$munalcest = $row['mun_alc_est'];
$dependencia = $row['dependencia']; 
$permiso = $row['permiso']; 
$fundamento = $row['fundamento']; 
}

$result = array(
'nivelgobierno' => $nivelgobierno,
'munalcest' => $munalcest,
'dependencia' => $dependencia,
'permiso' => $permiso,
'fundamento' => $fundamento,);

return $result;
}



?>

 <div class="modal-header">
  <h4 class="modal-title">Detalle del requisito legal</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

  <?=$detalle;?>

<div style="overflow-y: hidden;">
<table class="table table-bordered table-sm">
  <tr style="font-weight: bold; ">
    <td class="text-center align-middle table-secondary" >Fecha emisión</td>   
    <td class="text-center align-middle table-secondary" >Fecha de vencimiento</td>    
    <td class="text-center align-middle table-secondary" >Acuse PDF</td>    
    <td class="text-center align-middle table-secondary" >Requisito Legal PDF</td>  
  </tr>
  
 
<?php
$sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' ORDER BY id desc ";
$result_matriz = mysqli_query($con, $sql_matriz);
$numero_matriz = mysqli_num_rows($result_matriz);
if($numero_matriz > 0){
while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){
$idmatriz = $row_matriz['id'];

if($row_matriz['fecha_emision'] == "0000-00-00"){
$fechaemision = "S/I";
}else{
$fechaemision = FormatoFecha($row_matriz['fecha_emision']);
}

if($row_matriz['fecha_vencimiento'] == "0000-00-00"){
$fechavencimiento = "S/I";
}else{
$fechavencimiento = FormatoFecha($row_matriz['fecha_vencimiento']);
}

$acusepdf = $row_matriz['acusepdf'];
$requisitolegalpdf = $row_matriz['requisitolegalpdf'];

  if ($acusepdf == "") {
  $imgPDFA = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{

  $ext_acuse = pathinfo($acusepdf, PATHINFO_EXTENSION);
  
  if($ext_acuse == 'pdf'){
   $imgPDFA = "<a target='_blank' href='../".$acusepdf."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>"; 
 }else{
  $imgPDFA = "<a target='_blank' href='../".$acusepdf."' ><img width='16px' src='".RUTA_IMG_ICONOS."descargar.png'></a>"; 
 }

}

  if ($requisitolegalpdf == "") {
  $imgPDFRL = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{

     $ext_requisito = pathinfo($requisitolegalpdf, PATHINFO_EXTENSION);
  if($ext_requisito == 'pdf'){
  $imgPDFRL = "<a target='_blank' href='../".$requisitolegalpdf."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
  }else{
  $imgPDFRL = "<a target='_blank' href='../".$requisitolegalpdf."' ><img width='16px' src='".RUTA_IMG_ICONOS."descargar.png'></a>";
  }

  }

echo "<tr>";

echo "<td class='text-center align-middle'>".$fechaemision."</td>";
echo "<td class='text-center align-middle'>".$fechavencimiento."</td>";
echo "<td class='text-center align-middle'>".$imgPDFA."</td>";
echo "<td class='text-center align-middle'>".$imgPDFRL."</td>";
echo "</tr>";
}
}else{
echo '<tr><td colspan="4" class="text-center"><small>No se encontró información</small></td></tr>';    
}
?>
</table>
</div>

</div>