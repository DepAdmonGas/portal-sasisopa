<?php
require('../../../app/help.php');

$idAtencion = $_GET['id'];

$sql = "SELECT * FROM tb_atencion_hallazgos_detalle WHERE id_atencion = '".$idAtencion."' ORDER BY id_sasisopa ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);


function Sasisopa($id,$con){
$sql = "SELECT * FROM sa_sasisopa WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Nombre = $row['nombre'];
} 
return $Nombre;
}

function Evidencia($id,$con){
$sql = "SELECT * FROM tb_atencion_hallazgos_evidencia WHERE id_hallazgo = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$archivo = $row['archivo'];
$contenido .= '<div><a href="'.RUTA_ARCHIVOS.'atencion-hallazgos/'.$archivo.'" download>'.$row['archivo'].'</a></div>';
} 
return $contenido;
}

function Cumplimiento($id,$con){
$sql = "SELECT * FROM tb_atencion_hallazgos_evidencia WHERE id_hallazgo = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);	

if($numero == 0){
$Result = '0%';
}else{
$Result = '100%';	
}

return $Result;
}

?>

<table class="table table-bordered table-striped table-hover table-sm mt-3" style="font-size: .9em;">
<thead>
<tr>
  <th class="align-middle">SASISOPA</th>
  <th class="align-middle">Hallazgos</th>
  <th class="align-middle">Acción preventiva por hallazgo</th>  
  <th class="align-middle">Fecha de implementación</th>
  <th class="align-middle">Evidencia</th>
  <th class="align-middle">% de cumplimiento</th>
  <th class="align-middle"></th>
  <th class="align-middle"></th>
  <th class="align-middle"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$id = $row['id'];

$Evidencia = Evidencia($id,$con);
$Cumplimiento = Cumplimiento($id,$con);

echo '<tr>';
echo '<td class="align-middle"><b>'.Sasisopa($row['id_sasisopa'],$con).'</b></td>';
echo '<td class="align-middle">'.$row['hallazgos'].'</td>';
echo '<td class="align-middle">'.$row['accion'].'</td>';
echo '<td class="align-middle">'.FormatoFecha($row['fecha_implementacion']).'</td>';
echo '<td class="align-middle">'.$Evidencia.'</td>';
echo '<td class="align-middle"><b>'.$Cumplimiento.'</b></td>';
echo '<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'documento.png" onclick="ModalEvidencia('.$idAtencion.','.$id.')"></td>';
echo '<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'editar.png" onclick="btnAgregar('.$idAtencion.','.$id.')"></td>';
echo '<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'eliminar.png" onclick="Eliminar('.$idAtencion.','.$id.')">';

echo '</tr>';

}
}else{
  echo "<tr><td colspan='9' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";		
}
?>
</tbody> 
</table>
