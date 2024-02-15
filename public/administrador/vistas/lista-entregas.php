<?php
require('../../../app/help.php');

function Estacion($idEstacion, $con){
$sql = "SELECT permisocre,razonsocial FROM tb_estaciones WHERE id = '".$idEstacion."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$razonsocial = $row['razonsocial'];
}
return $razonsocial;
}

$sql = "SELECT * FROM tb_entregas ORDER BY id DESC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>

<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="align-middle">Fecha</th>
  <th class="align-middle">Estación</th> 
  <th class="align-middle">Destinatario</th> 
  <th class="text-center align-middle" width="32"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></th>
  <th class="text-center align-middle" width="32"><img src="<?=RUTA_IMG_ICONOS;?>editar.png"></th>
  <th class="text-center align-middle" width="32"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero > 0) {
$i = 1;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Estacion = $row['estacion'];


if($row['estatus'] == 0){
$TbColor = 'table-danger';
$Editar = '<img src="'.RUTA_IMG_ICONOS.'editar.png" onclick="Editar('.$row['id'].')">';
$Eliminar = '<img src="'.RUTA_IMG_ICONOS.'eliminar.png" onclick="Eliminar('.$row['id'].')">';
}else if($row['estatus'] == 1){
$TbColor = 'table-warning';
$Editar = '<img src="'.RUTA_IMG_ICONOS.'editar.png" onclick="Editar('.$row['id'].')">';
$Eliminar = '<img src="'.RUTA_IMG_ICONOS.'eliminar.png" onclick="Eliminar('.$row['id'].')">';
}else if($row['estatus'] == 2){
$TbColor = 'table-success';
$Editar = '<img class="grayscale" src="'.RUTA_IMG_ICONOS.'editar.png">';
$Eliminar = '<img class="grayscale" src="'.RUTA_IMG_ICONOS.'eliminar.png">';
}

echo '<tr class="'.$TbColor.'">
<td class="text-center align-middle">'.$i.'</td>
<td>'.FormatoFecha($row['fecha']).'</td>
<td>'.$Estacion.'</td>
<td>'.$row['destinatario'].'</td>
<td class="text-center align-middle" onclick="Descargar('.$row['id'].')"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></td>
<td class="text-center align-middle">'.$Editar.'</td>
<td class="text-center align-middle">'.$Eliminar.'</td>
</tr>';

$i++;
}
}else{
echo "<tr><td colspan='8' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";		
}
?>
</tbody> 
</table>
