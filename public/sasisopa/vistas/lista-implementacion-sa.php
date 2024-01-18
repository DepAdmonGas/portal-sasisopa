<?php
require('../../../app/help.php');

$sql_implementacion = "SELECT * FROM tb_implementacionsa WHERE id_estacion = '".$Session_IDEstacion."' ";
$result_implementacion = mysqli_query($con, $sql_implementacion);
$numero_implementacion = mysqli_num_rows($result_implementacion);


function Nombreusuario($idusuario, $con)
{
$sql_usuario = "SELECT * FROM tb_usuarios WHERE id = '".$idusuario."' LIMIT 1 ";
$result_usuario = mysqli_query($con, $sql_usuario);
$numero_usuario = mysqli_num_rows($result_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nombre = $row_usuario['nombre'];
}

return $nombre;
}
?>

<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm mt-3" style="font-size: .9em;">
<thead>
<th class="text-center">#</th>	
<th>Responsable</th>
<th>Fecha</th>
<th width="100" class="text-center">Preguntas</th>
<th width="50" class="text-center">SI</th>
<th width="50" class="text-center">NO</th>
<th width="150" class="text-center">Resultado</th>
<th width="16" class="text-center"></th>
<th width="16" class="text-center"></th>
</thead>
<tbody>
<?php 
$numer = 1;
if ($numero_implementacion > 0) {
while($row_implementacion = mysqli_fetch_array($result_implementacion, MYSQLI_ASSOC)){
$id = $row_implementacion['id'];
$idusuario = $row_implementacion['id_usuario'];
$fecha = explode(" ", $row_implementacion['fecha']);
$Nombreusuario = Nombreusuario($idusuario, $con);

$preguntas = $row_implementacion['preguntas'];
$respuestas_si = $row_implementacion['respuestas'];
$respuestas_no = $preguntas - $row_implementacion['respuestas'];
$calificacion = $row_implementacion['puntos'];

if( $calificacion >= 60  && $calificacion <= 100){
$title = "<b class='text-success'>".$calificacion."% Excelente</b>";
                    
}else if($calificacion >= 0 && $calificacion <= 59){
$title = "<b class='text-warning'>".$calificacion."% Regular</b>";
                    
}


?>
<tr>
<td class="align-middle text-center"><?=$numer;?></td>
<td class="align-middle"><?=$Nombreusuario;?></td>
<td class="align-middle"><b><?=FormatoFecha($fecha[0]);?></b></td>
<td class="align-middle text-center"><b><?=$preguntas;?></b></td>
<td class="align-middle text-center text-success"><?=$respuestas_si;?></td>
<td class="align-middle text-center text-danger"><?=$respuestas_no;?></td>
<td class="align-middle text-center text-danger"><?=$title;?></td>
<td class="text-center align-middle" width="16" style="cursor: pointer" onclick="ModalDetalle(<?=$id;?>)"><a><img width="16" src="<?=RUTA_IMG_ICONOS;?>contenido.png"></a></td>
<td class="text-center align-middle" width="16" style="cursor: pointer" onclick="ModalEditar(<?=$id;?>)"><a><img width="16" src="<?=RUTA_IMG_ICONOS;?>edit-black-16.png"></a></td>
</tr>
<?php

$numer = $numer + 1;
}
}else{
echo "<tr><td colspan='8' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>	
</tbody>
</table>
</div>