<?php
require('../../../../app/help.php');

$sql_lista = "SELECT * FROM tb_calibracion_equipos WHERE id_estacion = '".$Session_IDEstacion."' AND fecha <= '".$fecha_del_dia."' AND (estado = 1 OR estado = 0) ORDER BY id DESC ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);

?>
<script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  });
 </script>
 
	<div class="text-right">
	<a onclick="Descargar(<?=$fecha_year;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
	<img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
	</a>
	</div>

<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm pb-0 mb-0">
<thead>	
<tr>
<th class="text-center align-middle">Folio</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Equipo</th>
<th class="text-center align-middle" width="100px">Adjuntar resultados</th>
<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>ojo-black-16.png"></th>
<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>edit-black-16.png"></th>
</tr>
</thead>
<tbody>
<?php

if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];

if($row_lista['estado'] == 0){
$TrColor = 'table-danger';
$Editar = "<img src='".RUTA_IMG_ICONOS."ojo-black-16.png'>";
}else{
$TrColor = '';	
$Editar = "<img src='".RUTA_IMG_ICONOS."ojo-black-16.png' onclick='Detalle(".$id.")'>";
}

if($row_lista['fecha'] == '0000-00-00'){
$Fecha = 'Pendiente';
}else{
$Fecha = FormatoFecha($row_lista['fecha']);
}

$Equipo = $row_lista['equipo'];

if($row_lista['resultados'] == ""){
        $Adjuntar = '<img src="'.RUTA_IMG_ICONOS.'sin-archivo.png" onclick="Adjuntar('.$row_lista['id'].')">';
        }else{
        $Adjuntar = '<img src="'.RUTA_IMG_ICONOS.'descargar.png" onclick="Adjuntar('.$row_lista['id'].')">';
        }

echo '<tr class="'.$TrColor.'">';
echo '<td class="text-center align-middle"><b>00'.$row_lista['folio'].'</b></td>';
echo '<td class="text-center align-middle">'.$Fecha.'</td>';
echo '<td class="text-center align-middle">'.$row_lista['equipo'].'</td>';
echo '<td class="align-middle text-center">'.$Adjuntar.'</td>';
echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'>".$Editar."</td>";
echo '<td class="text-center align-middle" width="20px" style="cursor: pointer;"><img src="'.RUTA_IMG_ICONOS.'edit-black-16.png" onclick="Editar('.$id.',\''.$Equipo.'\')"></td>';
echo '</tr>';

}
}else{
echo "<td colspan='6' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>
</div>