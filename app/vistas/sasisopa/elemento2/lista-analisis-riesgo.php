<?php
require('../../../../app/help.php');

$sql = "SELECT * FROM tb_analisis_riesgo WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY fecha DESC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>
<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<tr>
  <th class="text-center">#</th>
  <th class="">Fecha</th>
  <th class="">Descripción</th>  
  <th width="32"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></th>
  <th width="32">Anexos</th>
</tr>
</thead>
<tbody>
<?php 
$num = 1;
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$id = $row['id'];

echo '<tr>';
echo '<td class="text-center"><b>'.$num.'</b></td>';
echo '<td>'.FormatoFecha($row['fecha']).'</td>';
echo '<td>'.$row['descripcion'].'</td>';
echo '<td class="text-center"><a style="cursor: pointer;" href="archivos/analisis-riesgo/'.$row['documento'].'" download ><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></td>';
echo '<td class="text-center"><a onclick="ModalAnexos('.$id.')" style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'documento.png"></a></td>';

echo '</tr>';

$num = $num + 1;
}
}else{
  echo "<tr><td colspan='6' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";		
}
?>
</tbody> 
</table>
</div>