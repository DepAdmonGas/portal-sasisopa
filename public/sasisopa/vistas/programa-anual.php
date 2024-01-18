<?php
require('../../../app/help.php');

$sql_programa = "SELECT * FROM tb_programa_anual_simulacros WHERE id_estacion = '".$Session_IDEstacion."' ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);

function PersonalA($id, $con){
$sql_personal = "SELECT * FROM tb_programa_anual_simulacros_personal WHERE id_programa = '".$id."' ";
$result_personal = mysqli_query($con, $sql_personal);
$numero_personal = mysqli_num_rows($result_personal);
return $numero_personal;
}

function Resumen($id, $con){
$sql_resumen = "SELECT * FROM tb_programa_anual_simulacros_resumen WHERE id_programa = '".$id."' ";
$result_resumen = mysqli_query($con, $sql_resumen);
$numero_resumen = mysqli_num_rows($result_resumen);
return $numero_resumen;
}

function Evaluacion($id, $con){
$sql_evaluacion = "SELECT * FROM tb_programa_anual_simulacros_evaluacion WHERE id_programa = '".$id."' order by fechacreacion desc LIMIT 1";
$result_evaluacion = mysqli_query($con, $sql_evaluacion);
$numero_evaluacion = mysqli_num_rows($result_evaluacion);
while($row_evaluacion = mysqli_fetch_array($result_evaluacion, MYSQLI_ASSOC)){
$img_evaluacion = $row_evaluacion['archivo'];
}
return $img_evaluacion;
}

?>



<div style="overflow-y: hidden;">
<table class="table table-bordered table-sm mt-2 mb-2">
<tr>
<td class="text-center align-middle"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 200px;"></td>
<td colspan="2" class="text-center align-middle"><b>Programa anual de simulacros</b></td>
<td class="text-center align-middle">Fo.ADMONGAS.016</td>
</tr>
<tr>
<td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
<td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
<td class="text-center align-middle">Autorizado por: Tomas Tarno Quinzaños </td>
<td class="text-center align-middle">Fecha de autorizacion 01/10/2018</td>
</tr>
</table>
</div>



<div class="border mt-3 mb-3">
<div class="p-3">


<div class="text-right mt-2 mb-2">
<img class="mr-2" src="<?=RUTA_IMG_ICONOS;?>lupa.png" onclick="BuscarReporte()">
<button type="button" class="btn btn-success btn-sm rounded-0" onclick="ModalPrograma(0)">Nuevo programa anual</button>
</div>

<hr>


<div class="" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm mt-3">
<thead>
<th class="text-center align-middle">Nombre del simulacro</th>
<th class="text-center align-middle">Periodicidad</th>
<th class="text-center align-middle">Fecha</th>
<th colspan="2" class="text-center align-middle"><span class="badge badge-primary">1</span> Personal que asiste</th>
<th colspan="2" class="text-center align-middler"><span class="badge badge-primary">2</span> Resumen</th>
<th colspan="3" class="text-center align-middle"><span class="badge badge-primary">3</span> Evaluación (Fo.ADMONGAS.016a)</th>
<th class="text-center align-middle" width="24"><img src="<?=RUTA_IMG_ICONOS;?>editar.png"></th>
<th class="text-center align-middle" width="24"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>
</thead>	
<tbody>
<?php
if ($numero_programa > 0) {
while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
$id = $row_programa['id'];

$personal = PersonalA($id, $con);

if ($personal == 0) {
$PersonalA = "No se encontró personal";
}else{
$PersonalA = $personal." personas";
}

$Resumen = Resumen($id, $con);

if ($Resumen == 0) {
$ImgResumen = "<img width='18px' src='".RUTA_IMG_ICONOS."img-no.png'>";
}else{
$ImgResumen = "<img width='18px' src='".RUTA_IMG_ICONOS."correcto-16.png'>";
}

$Evaluacion = Evaluacion($id, $con);

if ($Evaluacion == "") {
$imgPDF = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";
}else{
$imgPDF = "<a target='_blank' href='".$Evaluacion."' ><img src='".RUTA_IMG_ICONOS."archivo.png'></a>";
}

 

echo "<tr>";
echo "<td class='align-middle text-center'>".$row_programa['nombre_simulacro']."</td>";
echo "<td class='text-center align-middle'>".$row_programa['periodicidad']."</td>";
echo "<td class='align-middle text-center'>".FormatoFecha($row_programa['fecha'])."</td>";
echo "<td class='text-center align-middle' style='cursor: pointer;' onclick='ModalPersonal(".$id.")'><img src='".RUTA_IMG_ICONOS."agregar.png'></td>";
echo "<td class='text-center align-middle'>".$PersonalA."</td>";
echo "<td class='text-center align-middle' style='cursor: pointer;' onclick='ModalResumen(".$id.")'><img width='18px' src='".RUTA_IMG_ICONOS."editar.png'></td>";
echo "<td class='text-center align-middle' >".$ImgResumen."</td>";
echo "<td class='text-center align-middle' style='cursor: pointer;' >
<a href='".RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.016a.doc' download><img src='".RUTA_IMG_ICONOS."descargar.png'></a></td>";
echo "<td class='text-center align-middle' style='cursor: pointer;' onclick='ModalArchivo(".$id.")'><img src='".RUTA_IMG_ICONOS."subir.png'></td>";
echo "<td class='text-center align-middle' style='cursor: pointer;' >".$imgPDF."</td>";
echo "<td class='text-center align-middle' style='cursor: pointer;' onclick='ModalPrograma(".$id.")'><img src='".RUTA_IMG_ICONOS."editar.png'></td>";
echo "<td class='text-center align-middle' style='cursor: pointer;' onclick='EliminarPAS(".$id.")'><img src='".RUTA_IMG_ICONOS."eliminar.png'></td>";
echo "</tr>";

}
}else{
echo "<tr><td colspan='12' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>	
</tbody>
</table>
</div>
</div>
</div>


<?php  
if ($numero_programa == 0) {
?>
<div class="alert alert-warning" role="alert">
  Recuerda programar tus simulacros en los próximos tres meses. 
</div>
<?php }else{} ?>