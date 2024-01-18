<?php
require('../../../app/help.php');
$idReporte = $_GET['idReporte'];

$sql = "SELECT * FROM tb_calibracion_tanques_documentos";
$query = mysqli_query($con, $sql);
$numero = mysqli_num_rows($query);

function Total($idDocumento,$idReporte,$con){
$sql = "SELECT * FROM tb_calibracion_tanques_detalle WHERE id_calibracion = '".$idReporte."' AND id_documento = '".$idDocumento."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
return $numero;
}
?>

<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<tr>
<th class="text-center">#</th>
<th class="">Documento</th>
<th class="text-center" width="24"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero > 0) {
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
$id = $row['id'];

$Total = Total($id,$idReporte,$con);
if($Total != 0){
$DocT = '<span class="badge badge-pill badge-primary position-absolute" style="margin-left: -15px;margin-top: 13px;font-size: .6em"><small>'.$Total.'</small></span>';	
}else{
$DocT = '';	
}

echo '<tr>
<td class="text-center align-middle">'.$row['id'].'</td>
<td class="align-middle">'.$row['nombre'].'</td>
<td class="text-center align-middle p-2" style="cursor: pointer;" onclick="ModalArchivos('.$row['id'].','.$idReporte.')">
<img src="'.RUTA_IMG_ICONOS.'subir.png">'.$DocT.'</td>
</tr>';

}
}else{
echo "<tr><td colspan='4' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";	
}
?>	

</tbody>
</table>