<?php
require('../../../../app/help.php');

$sql_mantenimiento = "SELECT * FROM bi_mantenimiento_quincenal WHERE id_estacion = '".$Session_IDEstacion."' ";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);

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

?>
<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm table-hover mt-3 pb-0 mb-0">
	<thead>
		<tr>
			<th class="align-middle text-center" width="250px">Fecha </th>
			<th class="align-middle text-center">Folio</th>
			<th class="align-middle text-center">Formato de Mantenimiento PREVENTIVO</th>
			<th class="align-middle text-center">Pruebade sensores</th>
			<th class="align-middle text-center">CUMPLIMIENTO A LOS APARTADOS 8.9.1 AL 8.11.1</th>
			<th class="align-middle text-center">CUMPLIMIENTO A LOS APARTADOS 8.12 al 8.17.4</th>
			<th class="align-middle text-center">CUMPLIMIENTO A LOS APARTADOS 8.17.5 AL 8.19.5</th>
			<th class="align-middle text-center">REVISIÓN Y MANTENIMIENTO PLANTA DE LUZ</th>
			<th class="align-middle text-center">REVISIÓN AL COMPRESOR</th>
			<th class="align-middle text-center"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>

		</tr>
	</thead>
	<tbody>
		<?php 
	if ($numero_mantenimiento > 0) {
		while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){

if ($row_mantenimiento['formato1'] != "") {
$Formato1PDF = "<a target='_blank' href='".$row_mantenimiento['formato1']."' ><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$Formato1PDF = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";	
}

if ($row_mantenimiento['formato2'] != "") {
$Formato2PDF = "<a target='_blank' href='".$row_mantenimiento['formato2']."' ><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$Formato2PDF = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";	
}

if ($row_mantenimiento['formato3'] != "") {
$Formato3PDF = "<a target='_blank' href='".$row_mantenimiento['formato3']."' ><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$Formato3PDF = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";	
}

if ($row_mantenimiento['formato4'] != "") {
$Formato4PDF = "<a target='_blank' href='".$row_mantenimiento['formato4']."' ><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$Formato4PDF = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";	
}

if ($row_mantenimiento['formato5'] != "") {
$Formato5PDF = "<a target='_blank' href='".$row_mantenimiento['formato5']."' ><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$Formato5PDF = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";	
}

if ($row_mantenimiento['formato6'] != "") {
$Formato6PDF = "<a target='_blank' href='".$row_mantenimiento['formato6']."' ><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$Formato6PDF = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";	
}

if ($row_mantenimiento['formato7'] != "") {
$Formato7PDF = "<a target='_blank' href='".$row_mantenimiento['formato7']."' ><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$Formato7PDF = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";	
}


			echo "<tr>";
			echo '<td class="align-middle text-center">'.FormatoFecha($row_mantenimiento['fechacreacion']).'</td>';
			echo '<td class="align-middle text-center"><b>'.FormatFolio($row_mantenimiento['folio']).'</b></td>';
			echo '<td class="align-middle text-center">'.$Formato1PDF.'</td>';	
			echo '<td class="align-middle text-center">'.$Formato2PDF.'</td>';	
			echo '<td class="align-middle text-center">'.$Formato3PDF.'</td>';	
			echo '<td class="align-middle text-center">'.$Formato4PDF.'</td>';	
			echo '<td class="align-middle text-center">'.$Formato5PDF.'</td>';
			echo '<td class="align-middle text-center">'.$Formato6PDF.'</td>';
			echo '<td class="align-middle text-center">'.$Formato7PDF.'</td>';	
			echo '<td class="align-middle text-center" onclick="Eliminar('.$row_mantenimiento['id'].')"><img src="'.RUTA_IMG_ICONOS.'eliminar.png"></td>';			
			echo "</tr>";

		}
	}else{
   echo "<tr><td colspan='10' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
		?>
	</tbody>
</table>
</div>