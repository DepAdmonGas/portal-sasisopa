<?php
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];

$sql = "SELECT * FROM tb_analisis_riesgo WHERE id_estacion = '".$idEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>

<div style="overflow-y: hidden;">

<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Fecha</th>
  <th class="text-center align-middle">Descripción</th>  
  <th width="32 text-center align-middle"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></th>
  <th width="32 text-center align-middle">Anexos</th>
  <th width="32 text-center align-middle"><img src="<?=RUTA_IMG_ICONOS;?>editar.png"></th>
  <th width="32 text-center align-middle"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$id = $row['id'];

echo '<tr>';
echo '<td class="text-center align-middle"><b>'.$row['id'].'</b></td>';
echo '<td class="text-center align-middle">'.FormatoFecha($row['fecha']).'</td>';
echo '<td class="text-center align-middle">'.$row['descripcion'].'</td>';
echo '<td class="text-center align-middle"><a style="cursor: pointer;" href="../archivos/analisis-riesgo/'.$row['documento'].'" download ><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></td>';
echo '<td class="text-center align-middle"><a onclick="ModalAnexos('.$idEstacion.','.$id.')" style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'documento.png"></a></td>';

echo '<td class="text-center align-middle"><a onclick="EditarAR('.$idEstacion.','.$id.')" style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'editar.png"></a></td>';
echo '<td class="text-center align-middle"><a onclick="EliminarAR('.$idEstacion.','.$id.')" style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></a></td>';
echo '</tr>';

}
}else{
  echo "<tr><td colspan='7' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";		
}
?>
</tbody> 
</table>

</div>