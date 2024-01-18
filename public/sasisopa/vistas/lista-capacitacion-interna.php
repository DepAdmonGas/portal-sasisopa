<?php
require('../../../app/help.php');

$idTema = $_GET['idTema'];
$idUsuario = $_GET['idUsuario'];


$sql_modulo = "SELECT * FROM tb_cursos_calendario WHERE id_personal = '".$idUsuario."' AND id_tema = '".$idTema."' ORDER BY fecha_programada DESC";
$query_modulo = mysqli_query($con, $sql_modulo);
$numero_modulos = mysqli_num_rows($query_modulo);

$sql = "SELECT * FROM tb_cursos_temas  WHERE id = '".$idTema."' ";
$query = mysqli_query($con, $sql);
while($row_modulo = mysqli_fetch_array($query, MYSQLI_ASSOC)){
$tituloTema = $row_modulo['titulo'];
}

?>
<div class="modal-header">
   <h4 class="modal-title">CAPACITACIÓN INTERNA</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<h5 class="text-center"><?=$tituloTema;?></h5>
<hr>

<table class="table table-bordered table-striped table-hover table-sm" style="font-size: .9em;">
<thead>
<tr>
<th class="text-center">Fecha Programada</th>
<th class="text-center">Fecha Real</th>
<th class="text-center">Resultado</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero_modulos > 0) {

while($row_modulo = mysqli_fetch_array($query_modulo, MYSQLI_ASSOC)){

$id = $row_modulo['id'];
$fechaprogramada = $row_modulo['fecha_programada'];
$fechareal = $row_modulo['fecha_real'];
$iddetalle = $row_modulo['id_detalle'];

if ($fechareal != "0000-00-00") {
$FechaNew = FormatoFecha($fechareal);
}else{
$FechaNew = "S/I";
}


$estadoModulo = $row_modulo['estado'];
$puntos      =  $row_modulo['resultado'];

$calificacion = $puntos;

if($row_modulo['estado'] == 0){
$title = 'Pendiente';
$eliminar = '<a style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Eliminar"><img class="grayscale" src="'.RUTA_IMG_ICONOS.'eliminar.png" onclick="Eliminar('.$id.','.$idTema.','.$idUsuario.')"></a>';
$PDF = '<img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'img-no-24.png">';
}else{

if($calificacion >= 90 && $calificacion <= 100){
$title = "<b class='text-success'>".$calificacion."% Excelente</b>";
$eliminar = '<a style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Eliminar"><img class="grayscale" src="'.RUTA_IMG_ICONOS.'eliminar.png"></a>';
$PDF = '<a target="_BLANK" href="../descargar-reconocimiento/'.$row_modulo['id'].'"><img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
}else if($calificacion >= 80 && $calificacion <= 89){
$title = "<b class='text-primary'>".$calificacion."% Bueno</b>";
$eliminar = '<a style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Eliminar"><img class="grayscale" src="'.RUTA_IMG_ICONOS.'eliminar.png"></a>';   
$PDF = '<a target="_BLANK" href="../descargar-reconocimiento/'.$row_modulo['id'].'"><img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';              
}else if($calificacion >= 60 && $calificacion <= 79){
$title = "<b class='text-warning'>".$calificacion."% Regular</b>";
$eliminar = '<a style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Eliminar"><img class="grayscale" src="'.RUTA_IMG_ICONOS.'eliminar.png" onclick="Eliminar('.$id.','.$idTema.','.$idUsuario.')"></a>';
$PDF = '<a target="_BLANK" href="../descargar-reconocimiento/'.$row_modulo['id'].'"><img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
}else {
$title = "<b class='text-danger'>".$calificacion."% Malo</b>";
$eliminar = '<a style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Eliminar"><img class="grayscale" src="'.RUTA_IMG_ICONOS.'eliminar.png" onclick="Eliminar('.$id.','.$idTema.','.$idUsuario.')"></a>';
$PDF = '<img class="img-logo mt-2" src="'.RUTA_IMG_ICONOS.'img-no-24.png">';
}

}

echo "<tr>";
echo "<td class='text-center align-middle'><b>".FormatoFecha($fechaprogramada)."</b></td>";
echo "<td class='text-center align-middle'><b>".$FechaNew."</b></td>";
echo "<td class='text-center align-middle'>".$title."</td>";
echo '<td class="text-center align-middle">'.$PDF.'</td>';
echo '<td class="text-center align-middle">'.$eliminar.'</td>';
echo "</tr>";
}

}else{
  echo "<tr><td colspan='4' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";	
}
?>	

</tbody>
</table>

 </div>

