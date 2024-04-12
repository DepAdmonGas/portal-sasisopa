<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/RequisitoLegal.php";
$class_requisito_legal = new RequisitoLegal();
$idre = $_GET['id'];

$sql_programa_m = "SELECT * FROM rl_requisitos_legales_calendario WHERE id = '".$idre."' ";
$result_programa_m = mysqli_query($con, $sql_programa_m);
$numero_programa_m = mysqli_num_rows($result_programa_m);

while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
$idrequisitolegal = $row_programa_m['id_requisito_legal'];


if($idrequisitolegal == 0){
$requisoLegal = $row_programa_m['requisito_legal']; 
}else{
    $array = $class_requisito_legal->DetalleRL($idrequisitolegal);
    $requisoLegal = $array['permiso'];
}

}

?>

  <div class="modal-header">
  <h4 class="modal-title"><?=$requisoLegal;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">
 
<div class="text-right">
<button type="button" class="btn btn-primary btn-sm rounded-0 mb-2" onclick="NuevoRequisito(<?=$idre;?>)">Nuevo</button>
</div> 

<div class="mt-2">

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-sm">
  <tr style="font-weight: bold; ">
    <td class="text-center align-middle table-secondary" >Fecha emisión</td> 
    <td class="text-center align-middle table-secondary" >Fecha vencimiento</td>   
    <td class="text-center align-middle table-secondary" >Acuse PDF</td>    
    <td class="text-center align-middle table-secondary" >Requisito Legal PDF</td>  
    <td class="text-center align-middle table-secondary" ></td>
    <td class="text-center align-middle table-secondary" ></td>
  </tr>
  
 
<?php
$sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' ORDER BY id desc ";
$result_matriz = mysqli_query($con, $sql_matriz);
$numero_matriz = mysqli_num_rows($result_matriz);
if ($numero_matriz > 0) {
while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){
$idmatriz = $row_matriz['id'];
$fechaemision = FormatoFecha($row_matriz['fecha_emision']);

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
echo "<td class='text-center align-middle'width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' onclick='editararchivo(".$idre.",".$idmatriz.")'></td>";

echo "<td class='text-center align-middle'width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."img-no.png' onclick='EliminarArchivo(".$idre.",".$idmatriz.")'></td>";
echo "</tr>";
}
}else{
echo '<tr><td colspan="6" class="text-center"><small>No se encontró información</small></td></tr>';  
}
?>
</table>
</div>
</div>

</div>